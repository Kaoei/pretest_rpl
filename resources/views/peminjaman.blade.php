<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Buku</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="h-screen bg-gray-100">
        <div class="mx-12 my-12">
            <div class="title text-center">
                <h1 class="text-3xl font-bold text-blue-400">Daftar Peminjaman</h1>
            </div>
    
            <div class="mb-5">
                <button id="openModal"
                    class="text-white bg-blue-400 p-2 rounded-md hover:bg-blue-500 transition duration-300">Tambah
                    Peminjaman</button>
            </div>
    
            {{-- Table --}}
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                <thead>
                    <tr>
                        <th class="text-center py-1 border-b">No</th>
                        <th class="text-center py-1 border-b">Nama Peminjam</th>
                        <th class="text-center py-1 border-b">Judul Buku</th>
                        <th class="text-center py-1 border-b">Tgl Pinjam</th>
                        <th class="text-center py-1 border-b">Tgl Balik</th>
                        <th class="text-center py-1 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjaman as $b)
                    <tr>
                        <td class="text-center py-1 border-b">{{ $loop->iteration }}</td>
                        <td class="text-center py-1 border-b">{{ $b->nama_peminjam }}</td>
                        <td class="text-center py-1 border-b">{{ $b->book->judul }}</td>
                        <td class="text-center py-1 border-b">{{ $b->tanggal_peminjaman }}</td>
                        <td class="text-center py-1 border-b">{{ $b->tanggal_pengembalian }}</td>
                        <td class="text-center py-1 border-b">
                            <button 
                                class="edit-button text-white bg-blue-400 p-2 rounded-md hover:bg-blue-500 transition duration-300"
                                data-id="{{ $b->id }}"
                                data-nama_peminjam="{{ $b->nama_peminjam }}"
                                data-book_id="{{ $b->book_id }}"
                                data-tanggal_peminjaman="{{ $b->tanggal_peminjaman }}"
                                data-tanggal_pengembalian="{{ $b->tanggal_pengembalian }}"
                            >
                                Edit
                            </button>
    
                            <form action="/peminjaman/delete/{{$b->id}}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-red-400 p-2 rounded-md hover:bg-red-500 transition duration-300">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        {{-- Modal Add --}}
        <div id="modalAdd" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center">
            <div class="modal-content bg-white rounded-lg shadow-lg p-6 w-1/3">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl text-center font-bold text-blue-400">Tambah Peminjam</h2>
                    <span id="closeModalAdd" class="cursor-pointer text-gray-500 hover:text-gray-700 text-2xl">&times;</span>
                </div>
                <div class="modal-body mt-4">
                    <form action="/peminjaman/create" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama_peminjam" class="block text-sm font-medium text-gray-700">Nama Peminjam</label>
                            <input type="text" name="nama_peminjam" id="nama_peminjam"
                                class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
    
                        <div class="mb-4">
                            <label for="book_id" class="block text-sm font-medium text-gray-700">Judul Buku</label>
                            <select name="book_id" id="book_id_add" 
                                class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                @foreach ($books as $book)
                                <option value="{{ $book->id }}">{{ $book->judul }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="mb-4">
                            <label for="tanggal_peminjaman_add" class="block text-sm font-medium text-gray-700">Tanggal
                                Peminjaman</label>
                            <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman_add"
                                class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_pengembalian_add" class="block text-sm font-medium text-gray-700">Tanggal
                                Pengembalian</label>
                            <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian_add"
                                class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <button type="submit"
                                class="text-white bg-blue-400 p-2 rounded-md hover:bg-blue-500 transition duration-300">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
        {{-- Modal Edit (Satu Saja, di luar loop) --}}
        <div id="modalEdit" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center">
            <div class="modal-content bg-white rounded-lg shadow-lg p-6 w-1/3">
                <div class="flex justify-between items-center">
                    <h2 class="text-2xl text-center font-bold text-blue-400">Edit Peminjam</h2>
                    <span id="closeModalEdit" class="cursor-pointer text-gray-500 hover:text-gray-700 text-2xl">&times;</span>
                </div>
                <div class="modal-body mt-4">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editId">
                        <div class="mb-4">
                            <label for="nama_peminjam_edit" class="block text-sm font-medium text-gray-700">Nama
                                Peminjam</label>
                            <input type="text" name="nama_peminjam" id="nama_peminjam_edit"
                                class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
    
                        <div class="mb-4">
                            <label for="book_id_edit" class="block text-sm font-medium text-gray-700">Judul Buku</label>
                            <select name="book_id" id="book_id_edit" 
                                class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                @foreach ($books as $book)
                                <option value="{{ $book->id }}">{{ $book->judul }}</option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="mb-4">
                            <label for="tanggal_peminjaman_edit" class="block text-sm font-medium text-gray-700">Tanggal
                                Peminjaman</label>
                            <input type="date" name="tanggal_peminjaman" id="tanggal_peminjaman_edit"
                                class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_pengembalian_edit" class="block text-sm font-medium text-gray-700">Tanggal
                                Pengembalian</label>
                            <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian_edit"
                                class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div class="mb-4">
                            <button type="submit"
                                class="text-white bg-blue-400 p-2 rounded-md hover:bg-blue-500 transition duration-300">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
        {{-- JavaScript --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modalAdd = document.getElementById('modalAdd');
                const modalEdit = document.getElementById('modalEdit');
                const closeModalAdd = document.getElementById('closeModalAdd');
                const closeModalEdit = document.getElementById('closeModalEdit');
                const openModalButton = document.getElementById('openModal');
    
                openModalButton.onclick = function () {
                    modalAdd.classList.remove('hidden');
                }
    
                closeModalAdd.onclick = function () {
                    modalAdd.classList.add('hidden');
                }
                closeModalEdit.onclick = function () {
                    modalEdit.classList.add('hidden');
                }
    
                window.onclick = function (event) {
                    if (event.target == modalAdd) {
                        modalAdd.classList.add('hidden');
                    } else if (event.target == modalEdit) {
                        modalEdit.classList.add('hidden');
                    }
                }
    
                const editButtons = document.querySelectorAll('.edit-button');
                editButtons.forEach(button => {
                    button.addEventListener('click', () => {
                        const id = button.getAttribute('data-id');
                        const nama_peminjam = button.getAttribute('data-nama_peminjam');
                        const book_id = button.getAttribute('data-book_id');
                        const tanggal_peminjaman = button.getAttribute('data-tanggal_peminjaman');
                        const tanggal_pengembalian = button.getAttribute('data-tanggal_pengembalian');
    
                        document.getElementById('editId').value = id;
                        document.getElementById('nama_peminjam_edit').value = nama_peminjam;
                        document.getElementById('book_id_edit').value = book_id;
                        document.getElementById('tanggal_peminjaman_edit').value = tanggal_peminjaman;
                        document.getElementById('tanggal_pengembalian_edit').value = tanggal_pengembalian;
    
                        document.getElementById('editForm').action = `/peminjaman/update/${id}`;
    
                        modalEdit.classList.remove('hidden');
                    });
                });
            });
        </script>
    
    
</body>

</html>
