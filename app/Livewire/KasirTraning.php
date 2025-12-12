<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class KasirTraning extends Component {

    public $cart = [];
    public $products = [];

    public function mount(){
        $this->products = Product::all();
        $this->cart = session('cart', []);
    }

    private function getCart(){
       return session('cart', $this->cart);
    }

    private function savecart($cart){
        $this->cart = $cart;
        session(['cart' =>$cart]);
    }

    public function add($id){
        if(! $product = Product::find($id)) return;

        $cart = $this->getCart();
        
        $cart[ $id ] = [
            
           'id' => $product->id,
           'title' => $product->title,
           'price' => $product->price,
           'qty' => ($cart[$id] ['qty'] ?? 0) + 1, 
        ];
 
        $this->saveCart( $cart );

    }


    // update qty ( +1 atau -1 )

    public function updateQty( $id, $delta ) {
        $cart = $this->getCart();
        if ( isset( $cart[ $id ] ) ) {
            $cart[ $id ][ 'qty' ] += $delta;
            if ( $cart[ $id ][ 'qty' ] <= 0 ) unset( $cart[ $id ] );
            $this->saveCart( $cart );
        }
    }

    // hapus item

    public function remove( $id ) {
        $cart = $this->getCart();
        unset( $cart[ $id ] );
        $this->saveCart( $cart );
    }

    // kosongkan cart

    public function clearCart() {
        $this->cart = [];
        session()->forget( 'cart' );
    }

    // total harga

    public function getTotalProperty() {
        return collect( $this->cart )->sum( fn( $it ) => $it[ 'price' ] * $it[ 'qty' ] );
    }

    public function render() {
        return view( 'livewire.kasir-traning', [
            'cart' => $this->cart,
        ] )
        ->layout( 'components.layouts.app' );
    }
}

