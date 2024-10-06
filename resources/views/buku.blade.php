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
            <h1 class="text-3xl font-bold text-blue-400">Daftar Buku</h1>
        </div>

        <div class="mb-5">
            <button id="openModal"
                class="text-white bg-blue-400 p-2 rounded-md hover:bg-blue-500 transition duration-300">Tambah Buku</button>
        </div>

        {{-- Table --}}
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
            <thead>
                <tr>
                    <th class="py-2 text-center border-b">No</th>
                    <th class="py-2 text-center border-b">Judul Buku</th>
                    <th class="py-2 text-center border-b">Penerbit</th>
                    <th class="py-2 text-center border-b">Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($books as $a)
                <tr>
                    <td class="py-2 text-center border-b">{{ $loop->iteration }}</td>
                    <td class="py-2 text-center border-b">{{ $a->judul }}</td>
                    <td class="py-2 text-center border-b">{{ $a->penerbit }}</td>
                    <td class="py-2 text-center border-b">
                        <button id="openModalEdit{{$a->id}}"
                        class="text-white bg-blue-400 p-2 rounded-md hover:bg-blue-500 transition duration-300"
                        onclick="openEditModal('{{ $a->id }}', '{{ $a->judul }}', '{{ $a->penerbit }}')">Edit</button>

                        <form action="/buku/delete/{{$a->id}}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-white bg-red-400 p-2 rounded-md hover:bg-red-500 transition duration-300">Hapus</button>
                        </form>
                    </td>
                </tr>

                   {{-- ModalEdit --}}
                <div id="modalEdit" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center">
                    <div class="modal-content bg-white rounded-lg shadow-lg p-6 w-1/3">
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl text-center font-bold text-blue-400">Edit Buku</h2>
                            <span id="closeModalEdit" class="cursor-pointer text-gray-500 hover:text-gray-700 text-2xl">&times;</span>
                        </div>
                        <div class="modal-body mt-4">
                            <form id="editForm" action="/buku/update/{{$a->id}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" id="editId">
                                <div class="mb-4">
                                    <label for="editJudul" class="block text-sm font-medium text-gray-700">Judul Buku</label>
                                    <input type="text" name="judul" id="editJudul"
                                        class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div class="mb-4">
                                    <label for="editPenerbit" class="block text-sm font-medium text-gray-700">Penerbit</label>
                                    <input type="text" name="penerbit" id="editPenerbit"
                                        class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div class="mb-4">
                                    <button type="submit"
                                        class="text-white bg-blue-400 p-2 rounded-md hover:bg-blue-500 transition duration-300">Update</button>
                                </div>
                            </form>
                        </div>
                    </div
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Modal --}}
    <div id="modalAdd" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex justify-center items-center">
        <div class="modal-content bg-white rounded-lg shadow-lg p-6 w-1/3">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl text-center font-bold text-blue-400">Tambah Buku</h2>
                <span id="closeModalAdd" class="cursor-pointer text-gray-500 hover:text-gray-700 text-2xl">&times;</span>
            </div>
            <div class="modal-body mt-4">
                <form action="/buku/create" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="judul" class="block text-sm font-medium text-gray-700">Judul Buku</label>
                        <input type="text" name="judul" id="judul"
                            class="mt-1 p-2 block w-full rounded-md border border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="penerbit" class="block text-sm font-medium text-gray-700">Penerbit</label>
                        <input type="text" name="penerbit" id="penerbit"
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

 >
    </div>

    <script>
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

        function openEditModal(id, judul, penerbit) {
            document.getElementById('editId').value = id;
            document.getElementById('editJudul').value = judul;
            document.getElementById('editPenerbit').value = penerbit;
            modalEdit.classList.remove('hidden');
        }
    </script>
</body>

</html>
