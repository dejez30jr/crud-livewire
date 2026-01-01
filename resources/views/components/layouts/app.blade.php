<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Sederhana</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @livewireStyles
</head>
<script>
    window.addEventListener('swal:success', event => {
        Swal.fire({
            icon: 'success',
            title: event.detail.title,
            text: event.detail.text,
            timer: event.detail.timer,
            showConfirmButton: false
        });
    });
</script>
<body class="bg-gray-100 scrollbar-hide">

    <!-- Navbar sederhana -->
    <nav class="bg-white shadow p-4 md:px-6 flex justify-between gap-2 text-lg flex-wrap mt-2">
        <h1>Created by Dz</h1>
        <div>
        <a href="/" class="bg-gray-200 p-2 rounded-xl">Home</a>
        <a href="/kasir-traning" class="bg-gray-200 p-2 rounded-xl">kasir</a>
        </div>
    </nav>

<div class="scrollbar-hide p-2">
    {{ $slot }}
</div>

    @livewireScripts
</body>
</html>

