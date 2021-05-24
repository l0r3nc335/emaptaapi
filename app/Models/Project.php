<?php

/**
 * Project Model
 * Created by : Karl Pandacan
 * 2021-04-07
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
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

    public function configuration()
    {
        return $this->hasOne(Configuration::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, "project_id", "id");
    }

}
