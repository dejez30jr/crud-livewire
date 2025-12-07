<div class="flex flex-col md:flex-row w-full">
    <!-- box card -->
    <div class="md:w-3/4 w-full grid grid-cols-2 md:grid-cols-3 gap-2 p-4 bg-red-400">
        @foreach ($products as $p)
        <div class="p-2 bg-white rounded shadow" wire:click="add({{ $p->id }})">
            <img src="" alt="example image" class="w-full h-32 object-cover">
            <h1>{{ $p->title }}</h1>
            <span>Rp{{ number_format($p->price) }}</span>
        </div>
        @endforeach
    </div>

    <!-- Keranjang -->
    <div class="md:w-1/4 w-full p-4 bg-blue-400">
        <h1 class="font-bold">Keranjang</h1>
        @foreach($cart as $item)
            <div>{{ $item['title'] }} ({{ $item['qty'] }}) - Rp{{ number_format($item['price']) }}</div>
        @endforeach

           <div class="mt-4 font-bold">
        Total: Rp{{ number_format($this->total) }}
    </div>

    </div>
</div>
