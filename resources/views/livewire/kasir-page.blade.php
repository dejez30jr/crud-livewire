<div class="max-w-6xl mx-auto p-6">
    <div class="flex gap-6 flex-col md:flex-row">

        <!-- Daftar Produk -->
        <div class="md:flex-1">
            <h2 class="text-xl font-semibold mb-4">Daftar Produk</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($products as $p)
                    <div class="border rounded p-3 shadow cursor-pointer hover:shadow-md"
                         wire:click="addToCart({{ $p['id'] }})">
                        <div class="h-36 bg-gray-100 rounded mb-2 flex items-center justify-center">
                            @if(!empty($p['image']))
                                <img src="" alt="" class="h-full object-cover">
                            @else
                                <span class="text-gray-400">No Image</span>
                            @endif
                        </div>
                        <div class="font-semibold">{{ $p['title'] }}</div>
                        <div class="text-sm text-gray-600">Rp {{ number_format($p['price'],0,',','.') }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Summary / Cart -->
        <div class="w-full md:w-96 border rounded p-4 bg-white shadow">
            <h3 class="text-lg font-semibold mb-3">Ringkasan Keranjang</h3>

            @if(empty($cart))
                <p class="text-gray-500">Keranjang kosong</p>
            @else
                <div class="space-y-3">
                    @foreach($cart as $item)
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="font-semibold">{{ $item['title'] }}</div>
                                <div class="text-sm text-gray-600">Rp {{ number_format($item['price'],0,',','.') }}</div>
                                <div class="text-sm mt-1 flex items-center gap-2">
                                    <button wire:click.prevent="decrease({{ $item['id'] }})"
                                            class="px-2 py-1 border rounded">-</button>
                                    <span class="px-2">{{ $item['qty'] }}</span>
                                    <button wire:click.prevent="increase({{ $item['id'] }})"
                                            class="px-2 py-1 border rounded">+</button>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-semibold">Rp {{ number_format($item['price'] * $item['qty'],0,',','.') }}</div>
                                <button wire:click.prevent="remove({{ $item['id'] }})"
                                        class="mt-2 text-sm text-red-600">Hapus</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="border-t mt-4 pt-3">
                    <div class="flex justify-between items-center">
                        <div class="font-semibold">Total</div>
                        <div class="text-lg font-bold">Rp {{ number_format($this->total,0,',','.') }}</div>
                    </div>

                    <div class="mt-3 flex gap-2">
                        <button wire:click="clearCart" class="flex-1 bg-gray-200 px-3 py-2 rounded">Bersihkan</button>
                        <button class="flex-1 bg-green-600 text-white px-3 py-2 rounded">Bayar</button>
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>
