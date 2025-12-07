<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Sederhana</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    @livewireStyles
</head>
<body class="bg-gray-100">

    <!-- Navbar sederhana -->
    <nav class="bg-white shadow p-4 flex gap-6 text-lg">
        <a href="/" class="text-blue-600">Home</a>
        <a href="/about" class="text-blue-600">About</a>
        <a href="/kontak" class="text-blue-600">Form</a>
        <a href="/kasir-traning" class="text-blue-600">traning kasir" an</a>
    </nav>

<div>
    {{ $slot }}
</div>

    @livewireScripts
</body>
</html>

