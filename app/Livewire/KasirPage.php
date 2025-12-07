<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class KasirPage extends Component {

    public $products = [];
    public $cart = [];

    public function mount()
    {
        // ambil produk
        $this->products = Product::orderBy('id')->get()->toArray();

        // load cart dari session jika ada
        $this->cart = session('cart', []);
    }

    // tambahkan produk ke cart
    public function addToCart($id)
    {
        $id = (int) $id;
        $product = Product::find($id);
        if (! $product) return;
        

        $cart = session('cart', $this->cart);

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'title' => $product->title,
                'price' => (int) $product->price,
                'qty' => 1,
            ];
        }

        $this->cart = $cart;
        session(['cart' => $cart]);
    }

    public function increase($id)
    {
        $id = (int) $id;
        $cart = session('cart', $this->cart);
        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
            $this->cart = $cart;
            session(['cart' => $cart]);
        }
    }

    public function decrease($id)
    {
        $id = (int) $id;
        $cart = session('cart', $this->cart);
        if (isset($cart[$id])) {
            $cart[$id]['qty']--;
            if ($cart[$id]['qty'] <= 0) {
                unset($cart[$id]);
            }
            $this->cart = $cart;
            session(['cart' => $cart]);
        }
    }

    public function remove($id)
    {
        $id = (int) $id;
        $cart = session('cart', $this->cart);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->cart = $cart;
            session(['cart' => $cart]);
        }
    }

    public function clearCart()
    {
        $this->cart = [];
        session()->forget('cart');
    }

    // computed property untuk total
    public function getTotalProperty()
    {
        $total = 0;
        foreach ($this->cart as $it) {
            $total += $it['price'] * $it['qty'];
        }
        return $total;
    }

    public function render()
    {
        return view('livewire.kasir-page')
            ->layout('components.layouts.app');
    }

}
