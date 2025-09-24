<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background: white;
            margin: 10% auto;
            padding: 20px;
            width: 90%;
            max-width: 500px;
            border-radius: 10px;
        }

        .modal.show {
            display: block;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Manajemen Produk</h2>

        <div class="flex space-x-2 mb-4">
            <button id="btnOpenTambah" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah
                Produk</button>
            <button id="btnBulkTambah" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tambah
                Banyak Produk (Dummy)</button>
        </div>

        <table class="w-full border bg-white shadow">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Nama</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Harga</th>
                    <th class="border p-2">Stok</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                    <tr data-id="{{ $p->id }}" class="text-center">
                        <td class="border p-2">{{ $p->id }}</td>
                        <td class="border p-2">{{ $p->nama_produk }}</td>
                        <td class="border p-2">{{ $p->kategori }}</td>
                        <td class="border p-2">{{ $p->harga }}</td>
                        <td class="border p-2">{{ $p->stok }}</td>
                        <td class="border p-2">{{ $p->status }}</td>
                        <td class="border p-2">
                            <button class="btnEdit bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600"
                                data-id="{{ $p->id }}">Edit</button>
                            <button class="btnHapus bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                                data-id="{{ $p->id }}">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div id="modalTambah" class="modal">
        <div class="modal-content">
            <h3 class="text-lg font-bold mb-2">Tambah Produk</h3>
            <form id="formTambah" enctype="multipart/form-data">
                @csrf
                <input type="text" name="nama_produk" class="w-full border p-2 mb-2" placeholder="Nama Produk"
                    required>
                <input type="text" name="kategori" class="w-full border p-2 mb-2" placeholder="Kategori" required>
                <input type="number" name="harga" class="w-full border p-2 mb-2" placeholder="Harga" required>
                <input type="number" name="stok" class="w-full border p-2 mb-2" placeholder="Stok" required>
                <input type="file" name="gambar" class="w-full border p-2 mb-2">
                <div class="flex justify-end space-x-2">
                    <button type="button" class="btnClose bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modalEdit" class="modal">
        <div class="modal-content">
            <h3 class="text-lg font-bold mb-2">Edit Produk</h3>
            <form id="formEdit" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editId">
                <input type="text" name="nama_produk" id="editNama" class="w-full border p-2 mb-2" required>
                <input type="text" name="kategori" id="editKategori" class="w-full border p-2 mb-2" required>
                <input type="number" name="harga" id="editHarga" class="w-full border p-2 mb-2" required>
                <input type="number" name="stok" id="editStok" class="w-full border p-2 mb-2" required>
                <input type="file" name="gambar" class="w-full border p-2 mb-2">
                <div class="flex justify-end space-x-2">
                    <button type="button" class="btnClose bg-gray-400 text-white px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Modal
        function openModal(id) {
            document.getElementById(id).classList.add('show');
        }

        function closeModal() {
            document.querySelectorAll('.modal').forEach(m => m.classList.remove('show'));
        }

        $('#btnOpenTambah').on('click', () => openModal('modalTambah'));
        $('.btnClose').on('click', closeModal);

        // Tambah Produk (single)
        $('#formTambah').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "{{ route('produk.store') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: res => {
                    alert(res.message);
                    location.reload();
                },
                error: err => {
                    alert("Gagal tambah produk");
                }
            });
        });

        // Bulk Insert Produk Dummy
        $('#btnBulkTambah').on('click', function() {
            let products = [{
                    nama_produk: "Padi IR64",
                    harga: 50000,
                    stok: 100,
                    kategori: "Padi"
                },
                {
                    nama_produk: "Jagung Hibrida",
                    harga: 30000,
                    stok: 50,
                    kategori: "Jagung"
                },
                {
                    nama_produk: "Bayam Segar",
                    harga: 10000,
                    stok: 200,
                    kategori: "Sayuran"
                }
            ];
            $.ajax({
                url: "{{ route('produk.bulkStore') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    products
                },
                success: res => {
                    alert(res.message);
                    location.reload();
                },
                error: err => {
                    alert("Gagal tambah produk banyak");
                }
            });
        });

        // Edit Produk
        $('.btnEdit').on('click', function() {
            let id = $(this).data('id');
            let row = $('tr[data-id="' + id + '"]');
            $('#editId').val(id);
            $('#editNama').val(row.find('td:eq(1)').text());
            $('#editKategori').val(row.find('td:eq(2)').text());
            $('#editHarga').val(row.find('td:eq(3)').text());
            $('#editStok').val(row.find('td:eq(4)').text());
            openModal('modalEdit');
        });

        // Update Produk
        $('#formEdit').on('submit', function(e) {
            e.preventDefault();
            let id = $('#editId').val();
            let formData = new FormData(this);
            $.ajax({
                url: "/produk/" + id,
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: res => {
                    alert(res.message);
                    location.reload();
                },
                error: err => {
                    alert("Gagal update produk");
                }
            });
        });

        // Hapus Produk
        $('.btnHapus').on('click', function() {
            if (confirm("Yakin mau hapus produk ini?")) {
                let id = $(this).data('id');
                $.ajax({
                    url: "/produk/" + id,
                    method: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: res => {
                        alert(res.message);
                        location.reload();
                    },
                    error: err => {
                        alert("Gagal hapus produk");
                    }
                });
            }
        });
    </script>
</body>

</html>
