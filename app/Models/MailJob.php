<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailJob extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'template',
        'email',
        'data',
        'status',
        'created_at',
        'send_by',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'send_at',
    ];

    public $timestamps = false;

    const PER_PAGES = 15;
    const PENDING = 0;
    const SENT = 1;
    const SENDING = 3;
    const FAILED = 4;
}
