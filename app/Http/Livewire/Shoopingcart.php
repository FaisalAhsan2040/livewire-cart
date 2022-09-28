<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ShoppingCart as cart;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class Shoopingcart extends Component
{
    public $cartitems; public $total=0; public $sub_total=0; public $tax=0;

    public function render()
    {
        $this->cartitems = cart::with('product')
        ->where(['user_id'=>auth()->user()->id])
        ->where('status', '!=', cart::STATUS['success'] )
        ->get();

        $this->total = 0; $this->sub_total=0; $this->tax=0;

        foreach($this->cartitems  as $items)
        {
            $this->sub_total += $items->product->price * $items->quantity;
        }

        $this->total = $this->sub_total - $this->tax;

        return view('livewire.shoopingcart');
    }

    public function incrementQty($id)
    {
        $cart = cart::whereId($id)->first();
        $cart->quantity +=1;
        $cart->save();
        session()->flash('suceess','Product Increment');
    }

    public function decrementQty($id)
    {
        $cart = cart::whereId($id)->first();
        $cart->quantity -=1;
        $cart->save();
        session()->flash('suceess','Product Increment');
    }

    public function removeItem($id)
    {
        $cart = cart::whereId($id)->first();
        if($cart)
        {
            $cart->delete();
            $this->emit('updateCartCount');
        }
    }

    public function checkout()
    {

        $provider = new PayPalClient([]);
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        $order =  $provider->createOrder([
            'intent' => 'CAPTURE',
            "purchase_units" => [
                [
                    'amount' =>[
                        'currency_code' => 'USD',
                        'value' => $this->total
                    ]
                ]
            ],
            'application_context' => [
                'cancel_url' => route('payment.cancel'),
                'return_url' => route('payment.success')
            ]

        ]);

        if($order['status'] == 'CREATED')
        {
            foreach($this->cartitems  as $item)
            {
                $item->status = cart::STATUS['in_process'];
                $item->payment_id = $order['id'];
                $item->save();
            }
            return redirect($order['links'][1]['href']);
        }else{

            session()->flash('error','something went wrong');
        }

    }
}
