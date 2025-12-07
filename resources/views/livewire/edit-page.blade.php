<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Produk</h1>

    @if(session('success'))
        <div class="p-3 bg-green-200 text-green-800 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="update" class="space-y-4">

        <div>
            <label class="block font-semibold">Nama Produk</label>
            <input type="text" wire:model="title" class="border p-2 w-full rounded">
            @error('title') 
                <div class="text-red-500 text-sm">{{ $message }}</div> 
            @enderror
        </div>

        <div>
            <label class="block font-semibold">Harga</label>
            <input type="number" wire:model="price" class="border p-2 w-full rounded">
            @error('price') 
                <div class="text-red-500 text-sm">{{ $message }}</div> 
            @enderror
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>

    </form>
</div>
