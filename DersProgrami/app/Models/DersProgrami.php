<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DersProgrami extends Model
{
    use HasFactory;

    protected $table = 'dersprogram'; // Veritabanı tablo adı
    protected $primaryKey = 'dersProgramId';
    protected $fillable = [
        'sinifId', 'birimId', 'ogretimUyeId', 'bolumId', 'dersId', 'gun', 'baslangicSaati', 'bitisSaati'
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
        return $this->belongsTo(Kullanici::class, 'ogretimUyeId');
    }

    // Sınıf ilişkisi
    public function sinif()
    {
        return $this->belongsTo(Sinif::class, 'sinifId');
    }

    // Birim ilişkisi
    public function birim()
    {
        return $this->belongsTo(Birim::class, 'birimId');
    }

    // Bölüm ilişkisi
    public function bolum()
    {
        return $this->belongsTo(Bolum::class, 'bolumId');
    }
}
