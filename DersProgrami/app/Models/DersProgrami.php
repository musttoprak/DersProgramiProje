<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DersProgrami extends Model
{
    use HasFactory;

    protected $table = 'ders_programi'; // Veritabanı tablo adı

    protected $fillable = [
        'kullaniciId', 'dersId', 'sinifId', 'gun', 'baslangisSaat'
    ];

    public $timestamps = false;

    // Ders ilişkisi
    public function ders()
    {
        return $this->belongsTo(Ders::class, 'dersId');
    }

    // Kullanıcı ilişkisi
    public function kullanici()
    {
        return $this->belongsTo(Kullanici::class, 'kullaniciId');
    }

    // Sınıf ilişkisi
    public function sinif()
    {
        return $this->belongsTo(Sinif::class, 'sinifId');
    }
}
