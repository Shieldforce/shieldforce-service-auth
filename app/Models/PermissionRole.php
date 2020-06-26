<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionRole
 * @package App\Models
 */
class PermissionRole extends Model
{
    /**
     * @var string
     */
    protected $table = 'permission_role';

    /**
     * @var array
     */
    protected $fillable = [
        'permission_id',
        'role_id',
    ];

    /*
     *
     * Relations ------------
     *
     */
}
