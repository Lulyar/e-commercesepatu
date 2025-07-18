<?php

namespace App\Livewire;

use App\Models\Shoe;
use Livewire\Component;
use App\Services\OrderService;

class OrderForm extends Component
{
    public Shoe $shoe;
    public $orderData;
    public $subTotalAmount;
    public $promoCode = null;
    public $promoCodeId = null;
    public $quantity = 1;
    public $discount = 0;
    public $totalDiscountAmount = 0;
    public $grandTotalAmount;
    public $name;
    public $email;

    protected $orderService;

    public function boot(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function mount(Shoe $shoe, $orderData = [])
    {
        $this->shoe = $shoe;
        
        // Get order data from session if not provided
        if (empty($orderData)) {
            $this->orderData = $this->orderService->getOrderDetails()['orderData'] ?? [];
        } else {
            $this->orderData = $orderData;
        }

        $this->subTotalAmount = $shoe->price;
        $this->grandTotalAmount = $shoe->price;

        $this->quantity = $this->orderData['quantity'] ?? 1;
        $this->promoCode = $this->orderData['promo_code'] ?? null;
        $this->promoCodeId = $this->orderData['promo_code_id'] ?? null;
        $this->discount = $this->orderData['discount'] ?? 0;
        $this->totalDiscountAmount = $this->orderData['total_discount_amount'] ?? 0;
        $this->name = $this->orderData['name'] ?? null;
        $this->email = $this->orderData['email'] ?? null;

        $this->calculateTotal();
    }
     public function updatedQuantity()
{
    $this->validateOnly('quantity', [
        'quantity' => 'required|integer|min:1|max:' . $this->shoe->stock,
    ], [
        'quantity.max' => 'Stock tidak tersedia!',
    ]);

    $this->calculateTotal();
}

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'required|integer|min:1|max:' . $this->shoe->stock,
        ];
    }




    protected function calculateTotal(): void
    {
        $this->subTotalAmount = $this->shoe->price * $this->quantity;
        $this->grandTotalAmount = $this->subTotalAmount - $this->discount;
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->shoe->stock) {
            $this->quantity++;
            $this->calculateTotal();
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->calculateTotal();
        }
    }

    public function updatedPromoCode()
    {
        $this->applyPromoCode();
    }

    public function applyPromoCode()
    {
        if (empty($this->promoCode)) {
            $this->resetDiscount();
            return;
        }

        $result = $this->orderService->applyPromoCode($this->promoCode, $this->subTotalAmount);

        if (isset($result['error'])) {
            session()->flash('error', $result['error']);
            $this->resetDiscount();
        } else {
            session()->flash('message', 'Kode promo tersedia, yay!');
            $this->discount = $result['discount'];
            $this->calculateTotal();
            $this->promoCodeId = $result['promoCodeId'];
            $this->totalDiscountAmount = $result['discount'];
        }
    }

    protected function resetDiscount()
    {
        $this->discount = 0;
        $this->calculateTotal();
        $this->promoCodeId = null;
        $this->totalDiscountAmount = 0;
    }

   protected function gatherBookingData(array $validatedData): array
{
    // Get the latest order data from session
    $sessionOrderData = $this->orderService->getOrderDetails()['orderData'] ?? [];
    
    return [
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'grand_total_amount' => $this->grandTotalAmount,
        'sub_total_amount' => $this->subTotalAmount,
        'total_discount_amount' => $this->totalDiscountAmount,
        'discount' => $this->discount,
        'promo_code' => $this->promoCode,
        'promo_code_id' => $this->promoCodeId,
        'quantity' => $this->quantity,
        'shoe_size' => $sessionOrderData['shoe_size'] ?? $this->orderData['shoe_size'] ?? '',
        'size_id' => $sessionOrderData['size_id'] ?? $this->orderData['size_id'] ?? '',
        'shoe_id' => $this->shoe->id,
    ];
}


    public function submit()
    {
        $validatedData = $this->validate();
        $bookingData = $this->gatherBookingData($validatedData);

        // Simpan ke session lewat beginOrder agar terstruktur
        $this->orderService->beginOrder($bookingData);

        return redirect()->route('front.customer_data');
    }

    public function render()
    {
        return view('livewire.order-form');
    }
}
