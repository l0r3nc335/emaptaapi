<?php

/**
 * SMS Blast Number Model
 * Created by : Karl Pandacan
 * 2021-04-19
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsBlastNumber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mobile_number',
        'status',
        'error_message',
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

    const STATUS_FAILED = 0;

    const STATUS_SENT = 1;
}
