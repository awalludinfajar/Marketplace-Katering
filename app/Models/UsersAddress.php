<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersAddress extends Model
{
    use HasFactory;

    protected $table = 'users_address';

    protected $fillable = [
        'user_id',
        'type_address',
        'province',
        'city',
        'address',
        'post_code',
        'primary'
    ];

    public function user() {
        return $this->hasMany(User::class);
    }
}
