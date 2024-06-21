<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kullanici extends Model
{
    use HasFactory;

    protected $table = 'kullanicilar'; // Veritabanı tablo adı

    protected $fillable = [
        'ad', 'soyad', 'mail', 'sifre', 'bolumId', 'unvanId', 'yetkiId', 'olusturmaTarihi'
    ];

    public $timestamps = false;

    // Bölüm ilişkisi (Kullanıcı bir bölüme ait olabilir)
    public function bolum()
    {
        return $this->belongsTo(Bolum::class, 'bolumId');
    }

    // Unvan ilişkisi (Kullanıcı bir unvana ait olabilir)
    public function unvan()
    {
        return $this->belongsTo(Unvan::class, 'unvanId');
    }

    // Yetki ilişkisi (Kullanıcı bir yetkiye ait olabilir)
    public function yetki()
    {
        return $this->belongsTo(Yetki::class, 'yetkiId');
    }
}
