<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yetki extends Model
{
    use HasFactory;

    protected $table = 'yetkiler'; // Yetkiler tablo adı
    protected $primaryKey = 'yetkiId';
    protected $fillable = [
        'yetkiAd'
    ];

    public $timestamps = false;

    // Kullanıcılar ilişkisi (Bir yetkide birden fazla kullanıcı olabilir)
    public function kullanicilar()
    {
        return $this->hasMany(Kullanici::class, 'yetkiId');
    }
}
