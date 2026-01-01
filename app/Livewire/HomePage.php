<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class HomePage extends Component {
    public function render() {
        return view( 'livewire.home-page', [
            'produk' => Product::all()
        ] );
    }

    
public function move($id){
    $data = Product::FindOrfail($id);
    $data->delete();
    session()->flash('success', 'Produk berhasil ditambahkan!');
}
}
