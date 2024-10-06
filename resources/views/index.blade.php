<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Peminjaman Buku</title>
    @vite('resources/css/app.css')
</head>
<body class="h-screen flex items-center justify-center bg-gray-100">
    <div class="container mx-auto flex flex-col items-center gap-4">
        <div class="text-center">
            <h1 class="text-blue-400 text-4xl font-bold">Selamat Datang di aplikasi Peminjaman Buku</h1>
        </div>
        <div class="button-nav flex items-center gap-5 text-xl">
            <a href="/peminjaman" class="text-white bg-blue-400 p-1 rounded-md hover:bg-blue-500 transition duration-300">Peminjaman</a>
            <a href="/buku" class="text-white bg-blue-400 p-1 rounded-md hover:bg-blue-500 transition duration-300">Buku</a>
        </div>
    </div>
</body>
</html>
