<?php

namespace App\Http\Controllers;

use Stripe;
use Session;

use Exception;

use App\Models\User;

use App\Models\Order;

use App\Models\Business;

use App\Mail\OrderPlaced;

use App\Models\DeliveryCart;

use Illuminate\Http\Request;

use App\Models\DispensaryCart;

use App\Models\DeliveryProducts;
use App\Models\DispenseryProduct;
use Illuminate\Support\Facades\Mail;

class StripeController extends Controller {

    public function checkout() {
        return view('checkout');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request) {

       // $checkDelivery = DeliveryCart::where('customer_id', session('customer_id'))->get();

       // $checkDispensery = DispensaryCart::where('customer_id', session('customer_id'))->get();

        // if($request->payment_platform == '1') {
        // $validated = $request->validate([
        //     'payment_method' => 'required',
        // ]);
        // }

        // session()->put('formRequest', request()->input());
        // session()->put('paymentPlatformId', $request->payment_platform);
        // $totalPrice = $this->calcTotalProductsPrice();
        // if($request->payment_platform == '1') {
        //     $stripeService = resolve(StripeService::class);
        //     return $stripeService->handlePayment($validated['payment_method'], $totalPrice, 'USD');
        // } else {
        //     $paypalService = resolve(PayPalService::class);
        //     return $paypalService->handlePayment($totalPrice, 'USD');
        // }

        $this->addOrder($request);

        return redirect()->route('orderhistory')->with("info", "Your Order has been Received Successfully. Please Check Your Email.");

    }

    private function addOrder($request)
    {

    $checkDelivery = DeliveryCart::where('customer_id', session('customer_id'))->get();

    $products = DeliveryCart::where('customer_id', session('customer_id'))
    ->join('delivery_products', 'delivery_products.id', '=', 'delivery_carts.product_id')
    ->get();

    $customerDetail = User::where('id', session('customer_id'))->first();

    $countorders = Order::count();
    $tracking_number = 1000 + $countorders + 1;
    // $retailer_ids = [];

    $retailerId = "";

    foreach ($checkDelivery as $key => $delivery) {

            $product = DeliveryProducts::where('id', $delivery->product_id)->first();

            $retailerId = $product->delivery_id;

           // $ids = array_push($retailer_ids, $product->delivery_id);

            // Saving in Orders Table
            $order = new Order;

            $order->tracking_number = $tracking_number;

            $order->retailer_id = $product->delivery_id;

            $order->customer_id = session('customer_id');

            $order->product_id = $delivery->product_id;

            $order->price = $product->price;

            $order->customer_address = $customerDetail->delivery_address;

            $order->qty = $delivery->product_id;

            $order->order_date = date('Y-m-d');

            $order->customer_name = $customerDetail->name;

            $order->customer_email = $customerDetail->email;

            $order->customer_phone = $customerDetail->phone;

            $order->nameonorder = $request['nameonorder'];
            $order->delivery_address = $request['delivery_address'];
            $order->nameonid = $request['nameonid'];
            $order->id_type = $request['id_type'];
            $order->id_number = $request['id_number'];
            $order->read = 1;
            $order->save();

        }

    try {
        $customer = [
            'customer' => $customerDetail
        ];

        $retailerDetail = Business::find($retailerId);

        Mail::to($customerDetail->email)->send(new OrderPlaced($customer, $products, $retailerDetail, $tracking_number, $order));

        $retailer = [
            'business' => $retailerDetail,
        ];

        Mail::to($retailerDetail->email)->send(new OrderPlaced($retailer, $products, $customerDetail, $tracking_number, $order));

        $admin = [
        'admin' => '',
        'retailerDetail' => $retailerDetail
        ];

        Mail::to('support@finder420.com')->send(new OrderPlaced($admin, $products, $customerDetail, $tracking_number, $order));

        $emptyCart = DeliveryCart::where('customer_id', session('customer_id'))->delete();

        } catch (Exception $e) {
            Order::where('tracking_number', $tracking_number)->delete();
            abort(501);
        }
    }

    public function stripeApproval() {

        if (session()->has('paymentPlatformId')) {
            $paymentPlatformId = session()->get('paymentPlatformId');
            if($paymentPlatformId == 1) {
                $stripeService = resolve(StripeService::class);
                return $stripeService->handleApproval();
            } else {
                $paypalService = resolve(PayPalService::class);
                return $paypalService->handleApproval();
            }
        }

        return redirect()
            ->route('cart')
            ->with('error','We cannot retrieve your payment platform. Try again, please.');

    }

    public function paypalCancelled()
    {
        return redirect()
        ->route('cart')
        ->with('error', 'You cancelled the payment.');
    }

    private function calcTotalProductsPrice()
    {
        $totalprice = 0;
        $checkDelivery = DeliveryCart::where('customer_id', session('customer_id'))->get();

        foreach ($checkDelivery as $key => $value) {

            $product = DeliveryProducts::where('id', $value->product_id)->first();

            $totalprice = $totalprice + $product->price;

        }

        return $totalprice;
    }

}
