<?php

/**
 * SMS Blast Model
 * Created by : Karl Pandacan
 * 2021-04-19
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsBlast extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'status',
        'success_count',
        'error_count',
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
        'created_at',
        'updated_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    const PER_PAGE = 50;

    const STATUS_PENDING = 0;

    const STATUS_SENT = 1;
}
