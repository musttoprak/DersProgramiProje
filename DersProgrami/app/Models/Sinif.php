<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinif extends Model
{
    use HasFactory;

    protected $table = 'siniflar'; // Veritabanı tablo adı

    protected $fillable = [
        'sinifAd', 'kapasite'
    ];

    public $timestamps = false;
}
