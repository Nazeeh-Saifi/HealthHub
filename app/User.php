<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

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

    public function sent()
    {
        return $this->hasMany(Message::class, 'sent_by');
    }

    public function receive()
    {
        return $this->hasMany(Message::class, 'received_by');
    }

    public function sendMessageTo($recipient, $subject, $body, $status, $reply_on, $phone_num, $sex, $age)
    {
        return $this->sent()->create([
            'received_by' => $recipient,
            'subject' => $subject,
            'body' => $body,
            'status' => $status,
            'reply_on' => $reply_on,
            'phone_num' => $phone_num,
            'sex' => $sex,
            'age' => $age,
        ]);
    }
}
