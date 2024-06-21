<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ders extends Model
{
    use HasFactory;

    protected $table = 'dersler'; // Veritabanı tablo adı
    protected $primaryKey = 'dersId';
    protected $fillable = [
        'bolumId', 'dersKodu', 'dersAdi', 'dersSaati'
    ];

    public $timestamps = false;

    // Bölüm ilişkisi (Bir ders bir bölüme ait olabilir)
    public function bolum()
    {
        return $this->belongsTo(Bolum::class, 'bolumId');
    }
}
