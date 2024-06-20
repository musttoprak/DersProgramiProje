<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bolum extends Model
{
    use HasFactory;

    protected $table = 'bolumler'; // Bölümler tablo adı

    protected $fillable = [
        'bolumAd','bolumId','bolumKodu','birimId'
    ];

    public $timestamps = false;

    // Kullanıcılar ilişkisi (Bir bölümde birden fazla kullanıcı olabilir)
    public function kullanicilar()
    {
        return $this->hasMany(Kullanici::class, 'bolumId');
    }

    // Birim ilişkisi (Bir bölüm birime ait olabilir)
    public function birim()
    {
        return $this->belongsTo(Birim::class, 'birimId');
    }
}
