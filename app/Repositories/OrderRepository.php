<?php

namespace App\Repositories;

use App\Models\ProductTransaction;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\Session;

class OrderRepository implements OrderRepositoryInterface
{
    /* -------------------------------------------------------------- */
    /* Buat transaksi baru                                            */
    /* -------------------------------------------------------------- */
    public function createTransaction(array $data)
    {
        return ProductTransaction::create($data);
    }

    public function findByTrxIdAndPhoneNumber($bookingTrxId, $phone)
    {
        return ProductTransaction::with(['shoe.photos', 'shoe.brand', 'shoeSize'])
                                 ->where('booking_trx_id', $bookingTrxId)
                                 ->where('phone', $phone) // kolom di DB: phone
                                 ->first();
    }

    /* ------------------- Session helpers ------------------------- */
    public function saveToSession(array $data)
    {
        Session::put('orderData', array_merge(Session::get('orderData', []), $data));
    }

    public function getOrderDataFromSession()
    {
        return Session::get('orderData', []);
    }

    public function updateSessionData(array $data)
    {
        $this->saveToSession($data);
    }

    /** Bersihkan semua data order dari session */
    public function clearOrderSession(): void
    {
        Session::forget('orderData');
    }
}
