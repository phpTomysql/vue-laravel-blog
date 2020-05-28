<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'fname', 'email', 'lname','user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
