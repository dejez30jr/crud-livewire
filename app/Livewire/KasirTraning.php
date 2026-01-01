<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class KasirTraning extends Component {

    // wada buat nyimoen data
    public $cart = [];
    public $products = [];
    public $receipt = null;

    public function mount () {
        $this->products = Product::all();
        $this->cart = session( 'cart', [] );

    }

    // method private untuk mendapatkan cart dari session
    public function getCart() {
        return session( 'cart', $this->cart );
    }

    public function saveCart( $cart ) {
        $this->cart = $cart;
        session( [ 'cart'=>$cart ] );
    }
    // end method private

    // tambahin ke keranjang cart
    public function add( $id ) {
        if ( ! $product = Product::find( $id ) ) return;

        $cart = $this->getCart();

        $cart[ $id ] = [
            'id'=>$product->id,
            'title'=>$product->title,
            'price'=>$product->price,
            'qty' => ( [ $id ] [ 'qty' ] ?? 0 ) + 1,
        ];

        $this->saveCart( $cart );
    }

    // update qty
    public function updateQty ( $id, $delta ) {
      $cart = $this->getCart();
      $cart[$id] ['qty'] += $delta;
      $this->saveCart($cart);
    }

    // hapus item di cart
    public function remove ( $id ) {
        $cart = $this->getCart();
        unset( $cart[ $id ] );
        $this->saveCart( $cart );
    }

    // total harga
    public function getTotalProperty() {
        return collect( $this->cart )->sum( fn( $it ) => $it[ 'price' ] * $it[ 'qty' ] );
    }

    // bayar dan munculkan struk popup
    public function buy() {
        if ( empty( $this->cart ) ) {
            return;
        }

        $this->receipt = [
            'items' => $this->cart,
            'total' => $this->total,
            'time'  => now()->format( 'd/m/Y H:i' ),
        ];

        $cart = [];
        $this->saveCart( $cart );
    }

    public function render() {
        return view( 'livewire.kasir-traning', [
            'cart' => $this->cart,
        ] );
    }
}

