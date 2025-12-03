<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Kontak extends Component {
    public function render() {
        return view( 'livewire.kontak' )
        ->layout( 'components.layouts.app' );
    }

    public $title;
    public $price;

public function save()
{
    $validated = $this->validate([
        'title' => 'required|unique:products,title',
        'price' => 'required|numeric',
    ]);

    Product::create($validated);

    // // reset input setelah save
    $this->reset(['title', 'price']);

    session()->flash('success', 'Produk berhasil ditambahkan!');
}


}
