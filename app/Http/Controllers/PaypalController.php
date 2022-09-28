<?php

namespace App\Http\Controllers;

use App\Events\verifyOrder;
use App\Models\Order;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function cancel(Request $request)
    {
        if($request->token)
        {
            (new ShoppingCart)->where('payment_id',$request->token)
                ->update([
                    'payment_id' => '',
                    'status' => ShoppingCart::STATUS['pending']
                ]);

                return redirect()->route('shooping-cart')->with('error','your transaction has been cancel');
        }
    }

    public function success(Request $request)
    {

        $provider = new PaypalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if(isset($response['status']) && $response['status'] == 'COMPLETED')
        {

            $items = ShoppingCart::where([
                'user_id' => auth()->user()->id,
                'payment_id' => $response['id']
            ])->with('product')->get();

            foreach($items as $item)
            {

                $order =new Order();
                $order->user_id = auth()->user()->id;
                $order->payment_id = $item->payment_id;
                $order->product_id = $item->product_id;
                $order->amount = $item->product->price * $item->quantity;
                $order->save();

                $item->status = ShoppingCart::STATUS['success'];
                $item->save();
            }
            $data=['users_id'=>auth()->user()->id,'msg'=>'your oder has been place'];
            event(new verifyOrder($data));
            return redirect(route('home'))->with('success','Transaction competed');
        }else{
            return redirect(route('shooping-cart'))->with('error','Transaction failed');
        }

    }
}
