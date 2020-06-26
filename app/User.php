<?php

namespace App;

use App\Models\Institutions;
use App\Models\Permission;
use App\Observers\InterceptObserversInstitution;
use App\Observers\InterceptObserversModel;
use App\Response\Error;
use App\Scopes\InstitutionScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'system',
        'institution_id'
    ];

    /**
     * Start validations ===============================================================================================
     */
    /**
     * Start Observers
     */
    protected static function boot()
    {
        parent::boot();
        self::observe(new InterceptObserversInstitution);
        static::addGlobalScope(new InstitutionScope);
        self::observe(new InterceptObserversModel);
    }

    /**
     * The attributes in validations.
     *
     * @var array
     */
    public static $rules =
        [
            "creating"                     =>
                [
                    'model'                => ['required'],
                    'first_name'           => ['required', 'string', 'max:255'],
                    'last_name'            => ['required', 'string', 'max:255'],
                    'email'                => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password'             => ['required', 'string', 'min:4'],
                    'roles_ids'            => ['required']
                ],

            "updating"                     =>
                [
                    'model'                => ['required'],
                ],

            "saving"                       =>
                [
                    'model'                => ['required'],
                ]
        ];
    /**
     * End validations =================================================================================================
     */
    /**

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @param Permission $permission
     * @return bool
     */
    public function hasPermission(Permission $permission)
    {
        return $this->hasAnyRoles($permission->roles);
    }

    /**
     * @param $roles
     * @return bool
     */
    public function hasAnyRoles($roles)
    {
        if( is_array($roles) || is_object($roles) ) {
            return !! $roles->intersect($this->roles)->count();
        }
        return $this->roles->contains('name', $roles);
    }

    /**
     *
     * Escopes Locais
     *
     */

    /**
     * @param User $user
     * @param Request $request
     * @return Request
     */
    public static function scopeUpdatePassword(User $user, Request $request)
    {
        if( $request['password']!=$user->password )
            $request['password'] = Hash::make($request['password']);
        return $request;
    }

    /*
     *
     * Relations ------------
     *
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'role_user', 'user_id', 'role_id')->withoutGlobalScopes();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function institution()
    {
        return $this->hasOne(\App\Models\Institutions::class, 'id', 'institution_id');
    }

}
