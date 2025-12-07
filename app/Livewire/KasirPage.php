<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class KasirPage extends Component
{
    public $products = [];
    public $cart = [];

    public function mount()
    {
        $this->products = Product::orderBy('id')->get()->toArray();
        $this->cart = session('cart', []);
    }

    private function saveCart($cart)
    {
        $this->cart = $cart;
        session(['cart' => $cart]);
    }

    public function addToCart($id)
    {
        if (! $product = Product::find((int) $id)) return;

        $cart = $this->cart;
        $cart[$id] = [
            'id'    => $product->id,
            'title' => $product->title,
            'price' => (int) $product->price,
            'qty'   => ($cart[$id]['qty'] ?? 0) + 1,
        ];

        $this->saveCart($cart);
    }

    public function updateQty($id, $delta)
    {
        $cart = $this->cart;
        if (isset($cart[$id])) {
            $cart[$id]['qty'] += $delta;
            if ($cart[$id]['qty'] <= 0) unset($cart[$id]);
            $this->saveCart($cart);
        }
    }

    public function remove($id)
    {
        $cart = $this->cart;
        unset($cart[$id]);
        $this->saveCart($cart);
    }

    public function clearCart()
    {
        $this->cart = [];
        session()->forget('cart');
    }

    public function getTotalProperty()
    {
        return collect($this->cart)->sum(fn($it) => $it['price'] * $it['qty']);
    }

    public function render()
    {
        return view('livewire.kasir-page')->layout('components.layouts.app');
    }
}
