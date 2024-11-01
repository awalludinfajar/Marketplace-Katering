<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'kota',
        'no_telpon',
        'decription'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function menuKatering() {
        return $this->hasMany(MenuKatering::class);
    }
}
