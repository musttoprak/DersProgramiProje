<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Birim extends Model
{
    use HasFactory;

    protected $table = 'birimler';
    protected $primaryKey = 'birimId';

    protected $fillable = [
        'birimKodu', 'birimAd'
    ];

    public $timestamps = false;

}
