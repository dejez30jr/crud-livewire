<div class="max-w-6xl mx-auto p-6 bg-white shadow rounded mt-10">
    <div class="flex gap-6 flex-col md:flex-row">

        <!-- Daftar Produk -->
        <div class="md:flex-1">
            <h2 class="text-xl font-semibold mb-4">Daftar Produk</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($products as $p)
                <div class="border rounded p-3 shadow cursor-pointer hover:shadow-md" wire:click="add({{ $p['id'] }})">
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
                            <button wire:click="updateQty({{ $item['id'] }}, -1)"
                                class="px-2 py-1 border rounded">-</button>
                            <span class="px-2">{{ $item['qty'] }}</span>
                            <button wire:click="updateQty({{ $item['id'] }}, 1)"
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

            </div>
            <div class="mt-3 flex gap-2">
                <button class="flex-1 bg-green-600 text-white px-3 py-2 rounded" wire:click="buy">Bayar</button>
            </div>
            @endif
        </div>

    </div>

    <!-- cetak struk -->
    @if($receipt)
    <div class="overlay fixed top-0 left-0 w-full h-full bg-white flex justify-center items- flex-col p-4">
        <div class="max-w-6xl mx-auto mt-6 border rounded bg-white shadow p-4">
            <h3 class="text-lg font-semibold text-center mb-2">STRUK PEMBELIAN</h3>
            <p class="text-center text-sm text-gray-500 mb-3">
                {{ $receipt['time'] }}
            </p>

            <div class="space-y-2">
                @foreach($receipt['items'] as $item)
                <div class="flex justify-between text-sm">
                    <div>
                        {{ $item['title'] }}
                        <span class="text-gray-500">x{{ $item['qty'] }}</span>
                    </div>
                    <div>
                        Rp {{ number_format($item['price'] * $item['qty'],0,',','.') }}
                    </div>
                </div>
                @endforeach
            </div>

            <div class="border-t mt-3 pt-2 flex justify-between font-semibold">
                <span>Total</span>
                <span>Rp {{ number_format($receipt['total'],0,',','.') }}</span>
            </div>

            @if(!empty($receipt['pesann']))
            <div class="mt-4 p-3 bg-gray-100 rounded text-center text-sm text-gray-700">
                {{ $receipt['pesann'] }}
            </div>
            @endif

        </div>

        <!-- button refrsh halaman -->
        <button onclick="location.reload()" class="mx-auto mt-2 bg-gray-300 p-2 px-4">close</button>
        <!-- tombol cetak print -->
        <div class="mx-auto mt-2">
            <button onclick="window.print()" class="bg-blue-600 text-white p-2 px-4">Cetak Struk</button>
        </div>
        @endif

    </div>