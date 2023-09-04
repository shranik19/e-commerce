<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\PaymentGateway;
use App\Models\Payments;
use Illuminate\Http\Request;
use Jackiedo\Cart\Facades\Cart;

class CheckoutController extends Controller
{
    public function show(){
        $shoppingCart=Cart::name('shopping');
        $items=$shoppingCart->getItems();
        $total=$shoppingCart->getTotal();
        $subtotal=$shoppingCart->getSubtotal();
        return view('checkout',[
            'items'=>$items,
            'total'=>$total,
            'subtotal'=>$subtotal
        ]);
    }
    public function store(Request $request){
        $shoppingCart=Cart::name('shopping');
        $items=$shoppingCart->getItems();
        $total=$shoppingCart->getTotal();

        $data= $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'country'=>'required',
            'provience'=>'required',
            'district'=>'required',
            'zip'=>'required',
            'address'=>'required',
            'payment_gateway'=>'required'
        ]);
        //create order
        $address=Address::create([
            'country'=>$data['country'],
            'provience'=>$data['provience'],
            'district'=>$data['district'],
            'street_address'=>$data['address'],
            'Zipcode'=>$data['zip']
        ]);
        $paymentGateway=PaymentGateway::where('code',$data['payment_gateway'])->first();
        //create payment
        $payment=Payments::create([
            'payment_gateway_id'=>$paymentGateway->id,
            'payment_status'=>'NOT_PAID',
            'price_paid'=>0
        ]);
        //create order
        $order=Orders::create([
            'tracking_id'=>"ORG-".uniqid(),
            'total'=>$total*100,
            'full_name'=>$data['first_name']." ".$data["last_name"],
            'email'=>$data['email'],
            'phone_number'=>$data['phone'],
            'billing_id'=>$address->id,
            'shipping_id'=>$address->id,
            'payment_id'=>$payment->id
        ]);
        
        //create order items
        foreach($items as $item){
            $orderItems=OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>$item->getId(),
                'name'=>$item->getTitle(),
                'quantity'=>$item->getQuantity(),
                'price'=>$item->getPrice()*100,
            ]); 

        }
        $shoppingCart->destroy();
        return redirect()->route('payment.show',['paymentGateways'=>$data['payment_gateway']])->with([
            'orderId'=>$order->tracking_id
        ]);   

    }
}
