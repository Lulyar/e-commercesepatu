<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    'name',
    'phone',
    'email',
    'booking_trx_id',
    'city',
    'post_code',
    'address',
    'quantity',
    'sub_total_amount',
    'grand_total_amount',
    'discount_amount',
    'is_paid',
    'shoe_id',
    'shoe_size',
    // 'size_id',     // ← DIHAPUS
    'promo_code_id',
    'proof',
    'customer_id',
];

    protected $casts = [
        'is_paid' => 'boolean',
    ];

    /**
     * Generate unique booking_trx_id
     */
    public static function generateUniqueTrxId($prefix = 'SSBWA')
{
    do {
        $randomString = $prefix . mt_rand(1000, 9999); // Generate random number
    } while (self::where('booking_trx_id', $randomString)->exists());

    return $randomString . mt_rand(0, 9); // Concatenate with a random digit
}

public function shoe(): BelongsTo
{
    return $this->belongsTo(Shoe::class, 'shoe_id');
}

public function shoeSize(): BelongsTo
{
    return $this->belongsTo(ShoeSize::class, 'shoe_size');
}

public function promoCode(): BelongsTo
{
    return $this->belongsTo(PromoCode::class, 'promo_code_id');
}

public function customer(): BelongsTo
{
    return $this->belongsTo(Customer::class, 'customer_id');
}

}
