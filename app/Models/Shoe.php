<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str; // Untuk mengisi data otomatis dari nama

class Shoe extends Model
{
    use HasFactory, SoftDeletes;

    // Atribut yang dapat diisi secara massal
    protected $fillable = [
        'name',
        'slug', // Unique karakter untuk menampilkan detail data
        'thumbnail',
        'about',
        'price',
        'stock',
        'is_popular',
        'category_id', // FK untuk kategori
        'brand_id', // FK untuk brand
    ];

    // Menetapkan nilai slug berdasarkan nama sepatu
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Relasi dengan Brand (Shoe belongs to Brand)
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    // Relasi dengan Category (Shoe belongs to Category)
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relasi dengan ShoePhoto (Shoe has many ShoePhotos)
    public function photos(): HasMany
    {
        return $this->hasMany(ShoePhoto::class);
    }

    // Relasi dengan ShoeSize (Shoe has many ShoeSizes)
    public function sizes()
{
    return $this->hasMany(ShoeSize::class);
}
    // Menggunakan 'slug' untuk routing
    public function getRouteKeyName()
    {
        return 'slug'; // Memberitahu Laravel untuk menggunakan 'slug' dalam URL
    }
}
