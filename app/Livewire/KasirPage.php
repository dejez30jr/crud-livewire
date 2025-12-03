<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class KasirPage extends Component {

    public function render() {
        return view( 'livewire.kasir-page' )
                ->layout('components.layouts.app');
    }


}
