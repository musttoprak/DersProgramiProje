<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Birim extends Model
{
    use HasFactory;

    protected $table = 'birimler'; // Birimler tablo adı

    protected $fillable = [
        'birimAd', 'birimId', 'birimKodu'
    ];

    public $timestamps = false;

    // Bölümler ilişkisi (Bir birimde birden fazla bölüm olabilir)
    public function bolumler()
    {
        return $this->hasMany(Bolum::class, 'birimId');
    }
}
