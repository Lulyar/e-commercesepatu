<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    // Atribut yang dapat diisi secara massal
    protected $fillable = [
        'name',
        'slug',
        'logo',
    ];

    // Menetapkan nama dan slug otomatis berdasarkan nama
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Relasi dengan Shoe (Satu Brand bisa memiliki banyak Shoe)
    public function shoes()
    {
        return $this->hasMany(Shoe::class);
    }

    // Menggunakan 'slug' untuk routing (bukan id)
    public function getRouteKeyName()
    {
        return 'slug'; // Menggunakan slug sebagai kunci pencarian di URL
    }
}
