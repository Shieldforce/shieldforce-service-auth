<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Institutions
 * @package App\Models
 */
class Institutions extends Model
{
    /**
     * @var string
     */
    protected $table = 'institutions';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'cpf',
        'whatsapp',
        'phone_two',
        'tag',
        'uuid'
    ];

    /*
     *
     * Relations ------------
     *
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(\App\User::class, 'institution_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->hasMany(\App\Models\Role::class, 'institution_id', 'id');
    }

}
