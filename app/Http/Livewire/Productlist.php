<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Productlist extends Component
{
    public $products;

    public function render()
    {
        $this->products = Product::get();
        return view('livewire.productlist');
    }

    public function addToCart($id)
    {
        if(Auth::user())
        {
            ShoppingCart::create([
                'product_id' => $id,
                'user_id' => Auth::user()->id,
            ]);

            $this->emit('updateCartCount');
            session()->flash('success','Add to cart');
        }
        else
        {
            return redirect(route('login'));
        }
    }
}
