<?php

/**
 * User Model
 * Created by : Karl Pandacan
 * 2020-07-30
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'name',
        'username',
        'email',
        'password',
        'token',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    const PER_PAGE = 15;

    public function scopeLogin($query, $username, $password)
    {
        return $query->where('username', $username)
            ->where('password', md5($password));
    }

    public function project(){
        return $this->hasOne(Project::class, 'id', 'project_id');
    }
}
