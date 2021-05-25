<?php

/**
 * Ticket Conversation Model
 * Created by : Jovic
 * 2021-04-19
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketConversation extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id',
        'message',
        'is_sent',
        'user_id',
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
        'updated_at',
    ];
    protected $dateFormat = 'Y-m-d';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    
    protected $casts = [
        'created_at'  => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];

    const PER_PAGE = 15;
    const FROM_MOBILE = 0;
    const FROM_SYSTEM = 1;


    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
