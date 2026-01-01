<div class="max-w-4xl mx-auto mt-10 bg-white shadow-md rounded-lg p-6">

    <h1 class="text-3xl font-bold mb-2">Home Page</h1>
    <p class="text-gray-600 mb-6">
        Selamat traning kasir livewire sederhana dz
    </p>

    <a href="/create"
       class="inline-block mb-6 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        buat data produk
    </a>

    {{-- TABLE DATA --}}
    <div class="overflow-hidden border rounded-lg shadow-sm">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="py-3 px-4 font-semibold text-gray-700">Title</th>
                    <th class="py-3 px-4 font-semibold text-gray-700">Price</th>
                    <th class="py-3 px-4 font-semibold text-gray-700">aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($produk as $p)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $p->title }}</td>
                    <td class="py-3 px-4">Rp {{ number_format($p->price) }}</td>
                    <td>
                        <a wire:click="move({{ $p->id }})">apus</a>
                        <a wire:navigate href="{{ route('product.edit', $p->id) }}">Edit</a>
                    </td>
                </tr>
                @endforeach

                @if($produk->isEmpty())
                <tr>
                    <td colspan="2" class="py-4 text-center text-gray-500">
                        Data belum ada
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>
