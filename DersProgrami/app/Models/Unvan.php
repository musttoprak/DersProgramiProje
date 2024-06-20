<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unvan extends Model
{
    use HasFactory;

    protected $table = 'unvanlar'; // Ünvanlar tablo adı

    protected $fillable = [
        'unvanId','unvanAd'
    ];

    public $timestamps = false;

    // Kullanıcılar ilişkisi (Bir unvanda birden fazla kullanıcı olabilir)
    public function kullanicilar()
    {
        return $this->hasMany(Kullanici::class, 'unvanId');
    }
}
