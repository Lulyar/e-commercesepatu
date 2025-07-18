<?php

namespace App\Services;

use App\Models\ProductTransaction;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PromoCodeRepositoryInterface;
use App\Repositories\Contracts\ShoeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    protected $categoryRepository;
    protected $promoCodeRepository;
    protected $orderRepository;
    protected $shoeRepository;

    public function __construct(
        PromoCodeRepositoryInterface $promoCodeRepository,
        CategoryRepositoryInterface  $categoryRepository,
        OrderRepositoryInterface     $orderRepository,
        ShoeRepositoryInterface      $shoeRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->promoCodeRepository = $promoCodeRepository;
        $this->orderRepository = $orderRepository;
        $this->shoeRepository = $shoeRepository;
    }
    public function beginOrder(array $data)
{
    $this->orderRepository->saveToSession($data);
}
public function getOrderDetails()
{
    $orderData = $this->orderRepository->getOrderDataFromSession();
    $shoe = $this->shoeRepository->find($orderData['shoe_id']);

    $quantity = isset($orderData['quantity']) ? $orderData['quantity'] : 1;
    $subTotalAmount = $shoe->price * $quantity;

    $taxRate = 0.11;
    $totalTax = $subTotalAmount * $taxRate;
    $grandTotalAmount = $subTotalAmount + $totalTax;

    $orderData['quantity'] = $quantity;
    $orderData['sub_total_amount'] = $subTotalAmount;
    $orderData['total_tax'] = $totalTax;
    $orderData['grand_total_amount'] = $grandTotalAmount;

    return compact('orderData', 'shoe');
}
public function applyPromoCode(string $code, int $subTotalAmount)
{
    $promo = $this->promoCodeRepository->findByCode($code);

    if ($promo) {
        $discount = $promo->discount_amount;
        $grandTotalAmount = $subTotalAmount - $discount;
        $promoCodeId = $promo->id;

        return [
            'discount' => $discount,
            'grandTotalAmount' => $grandTotalAmount,
            'promoCodeId' => $promoCodeId
        ];
    }

    return ['error' => 'Kode promo tidak tersedia!'];
}
public function saveBookingTransaction(array $data)
{
    $this->orderRepository->saveToSession($data);
}

public function updateCustomerData(array $data)
{
    $this->orderRepository->updateSessionData($data);
}

public function getMyOrderDetails(array $data)
{
    return $this->orderRepository->findByTrxIdAndPhoneNumber($data['booking_trx_id'], $data['phone']);
}

public function paymentConfirm(array $validated)
{
    $orderData = $this->orderRepository->getOrderDataFromSession();
    $productTransactionId = null;

    try {
        DB::transaction(function () use (&$validated, &$productTransactionId, $orderData) {
            if (isset($validated['proof'])) {
                $proofPath = $validated['proof']->store('proofs', 'public');
                $validated['proof'] = $proofPath;
            }

            $validated['name'] = $orderData['name'];
            $validated['email'] = $orderData['email'];
            $validated['phone'] = $orderData['phone'];
            $validated['address'] = $orderData['address'];
            $validated['post_code'] = $orderData['post_code'];
            $validated['city'] = $orderData['city'];
            $validated['quantity'] = $orderData['quantity'];
            $validated['sub_total_amount'] = $orderData['sub_total_amount'];
            $validated['grand_total_amount'] = $orderData['grand_total_amount'];
            $validated['discount_amount'] = $orderData['total_discount_amount'];
            $validated['promo_code_id'] = $orderData['promo_code_id'];
            $validated['shoe_id'] = $orderData['shoe_id'];
            $validated['shoe_size'] = $orderData['size_id'];
            $validated['is_paid'] = false;
            $validated['booking_trx_id'] = ProductTransaction::generateUniqueTrxId();
            $validated['customer_id'] = Auth::guard('customer')->id();

            $newTransaction = $this->orderRepository->createTransaction($validated);
            $productTransactionId = $newTransaction->id;
        });
    } catch (\Exception $e) {
        Log::error('Error in payment confirmation: ' . $e->getMessage());
        session()->flash('error', $e->getMessage());
        return null;
    }
    return $productTransactionId;
}


}
