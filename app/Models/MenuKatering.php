<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuKatering extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_profile_id',
        'category_menu_id',
        'nama',
        'deskripsi',
        'price',
        'gambar',
        'qty'
    ];

    public function merchantProfile() {
        return $this->belongsTo(MerchantProfile::class);
    }

    public function categoryMenu() {
        return $this->hasMany(CategoryMenu::class);
    }
}
