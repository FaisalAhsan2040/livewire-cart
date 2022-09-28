<?php

namespace App\Http\Livewire;

use App\Models\ShoppingCart as cart;
use Livewire\Component;

class Cartcounter extends Component
{
    public $total=0;

    protected $listeners = ['updateCartCount'=>'getTotalCartitem'];

    public function render()
    {
        $this->getTotalCartitem();
        return view('livewire.cartcounter');
    }

    public function getTotalCartitem()
    {
        $this->total = cart::where('status',cart::STATUS['success'])->whereUserId(auth()->user()->id)->count();
    }
}
