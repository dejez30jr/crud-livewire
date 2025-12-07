<?php

namespace App\Livewire;

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class EditPage extends Component
{
    public $productId;
    public $title;
    public $price;

        public function mount($id)
        {
            $product = Product::findOrFail($id);

            $this->productId = $product->id;
            $this->title = $product->title;
            $this->price = $product->price;
        }

        public function update()
        {
            $this->validate([
                'title' => 'required|unique:products,title,' . $this->productId,
                'price' => 'required|numeric',
            ]);

            $product = Product::find($this->productId);

            $product->update([
                'title' => $this->title,
                'price' => $this->price
            ]);

            session()->flash('success', 'Data berhasil diperbarui!');
        }

        public function render()
        {
            return view('livewire.edit-page')->layout('components.layouts.app');
        }
}
