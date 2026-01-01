
<div class="max-w-xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">

    <h1 class="text-3xl font-bold mb-2">Form</h1>
    <p class="text-gray-600 mb-6">
       tambah data produk melalui form dibawah ini
    </p>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-700 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM --}}
    <form wire:submit.prevent="save" class="space-y-4">

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Nama Produk</label>
            <input type="text"
                   wire:model="title"
                   class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   placeholder="Masukkan nama produk...">
            @error('title') 
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Harga Produk</label>
            <input type="number"
                   wire:model="price"
                   class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   placeholder="Masukkan harga...">
            @error('price') 
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg hover:bg-blue-700 transition">
            Simpan Data
        </button>

    </form>

    <a href="/"
       class="mt-6 block text-center px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800 transition">
        Kembali ke Halaman Home
    </a>

</div>
