<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCheckBookingRequest;
use App\Http\Requests\StoreCustomerDataRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Models\ProductTransaction;
use App\Models\Shoe;
use App\Services\OrderService;
use App\Services\LocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function saveOrder(StoreOrderRequest $request, Shoe $shoe)
    {
        $validated = $request->validated();
        $validated['shoe_id'] = $shoe->id;

        $this->orderService->beginOrder($validated);

        return redirect()->route('front.booking', $shoe->slug);
    }

    public function booking()
    {
        $data = $this->orderService->getOrderDetails();
        return view('order.order', $data);
    }

    public function customerData()
    {
        $data = $this->orderService->getOrderDetails();
        $locationService = new LocationService();
        $data['provinces'] = $locationService->getProvinces();
        return view('order.customer_data', $data);
    }

    public function saveCustomerData(StoreCustomerDataRequest $request)
    {
        $validated = $request->validated();
        $this->orderService->updateCustomerData($validated);

        return redirect()->route('front.payment');
    }

    public function payment()
    {
        $data = $this->orderService->getOrderDetails();
        return view('order.payment', $data);
    }

    public function paymentConfirm(StorePaymentRequest $request)
    {
        $validated = $request->validated();
        $productTransactionId = $this->orderService->paymentConfirm($validated);

        if ($productTransactionId) {
            $order = \App\Models\ProductTransaction::find($productTransactionId);
            return redirect()->route('order.finished', ['bookingId' => $order->booking_trx_id]);
        }

        return redirect()->route('front.index')->withErrors(['error' => 'Payment failed. Please try again.']);
    }

    public function checkBooking()
    {
        return view('order.my_order');
    }

    public function checkBookingDetails(StoreCheckBookingRequest $request)
    {
        $validated = $request->validated();

        $orderDetails = $this->orderService->getMyOrderDetails($validated);

        if ($orderDetails) {
            return view('order.my_order_details', compact('orderDetails'));
        }

        return redirect()->route('front.check_booking')->withErrors(['error' => 'Transaction not found']);
    }

    public function orderFinished($bookingId)
    {
        $order = \App\Models\ProductTransaction::with(['shoe.photos'])->where('booking_trx_id', $bookingId)->firstOrFail();
        return view('order.order_finished', compact('order'));
    }

    public function form()
    {
        return view('order.form');
    }

    /**
     * Get cities by province ID via AJAX
     */
    public function getCities(Request $request)
    {
        $provinceId = $request->input('province_id');
        $locationService = new LocationService();
        $cities = $locationService->getCities($provinceId);
        
        return response()->json($cities);
    }

    /**
     * Search cities by keyword via AJAX
     */
    public function searchCities(Request $request)
    {
        $keyword = $request->input('keyword');
        $locationService = new LocationService();
        $cities = $locationService->searchCities($keyword);
        
        return response()->json($cities);
    }

    /**
     * Get postal codes by city ID via AJAX
     */
    public function getPostalCodes(Request $request)
    {
        $cityId = $request->input('city_id');
        $locationService = new LocationService();
        $postalCodes = $locationService->getPostalCodes($cityId);
        
        return response()->json($postalCodes);
    }
}
