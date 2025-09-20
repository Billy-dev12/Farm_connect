<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alamat Pengiriman - Sistem Pertanian</title>
    <meta name="csrf-token" content="">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --primary: #4a7c59;
            --primary-dark: #3a6249;
            --secondary: #e74c3c;
            --background: #f8f9fa;
            --surface: #ffffff;
            --text-primary: #333333;
            --text-secondary: #666666;
            --border: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background);
            color: var(--text-primary);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .scale-in {
            animation: scaleIn 0.3s ease-out forwards;
        }

        /* Card Styles */
        .address-card {
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .address-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .default-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--primary);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            z-index: 10;
        }

        /* Button Styles */
        .btn-primary {
            background-color: var(--primary);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 124, 89, 0.3);
        }

        .btn-danger {
            background-color: var(--secondary);
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--primary);
            color: var(--primary);
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: var(--primary);
            color: white;
        }

        /* Header Styles */
        .header {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), #6fa071);
        }

        /* Empty State Styles */
        .empty-state {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            width: 90%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: scaleIn 0.3s ease-out forwards;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(74, 124, 89, 0.2);
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-primary);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
            }

            .address-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="header p-6 mb-8 fade-in">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-map-marker-alt text-green-700 mr-3"></i>
                    <span>Alamat Pengiriman</span>
                </h1>
                <div class="flex flex-col sm:flex-row gap-3 mt-4 md:mt-0">
                    <a href="{{ route('konsumen.dashboard') }}"
                        class="btn-outline px-6 py-3 rounded-full font-medium flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali ke Dashboard</span>
                    </a>
                    <button onclick="openAddModal()"
                        class="btn-primary text-white px-6 py-3 rounded-full font-medium flex items-center justify-center">
                        <i class="fas fa-plus mr-2"></i>
                        <span>Tambah Alamat</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Notification -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded fade-in">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded fade-in">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Addresses Grid -->
        @if ($addresses->count() > 0)
            <div class="address-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach ($addresses as $address)
                    <div class="address-card bg-white rounded-2xl overflow-hidden shadow-lg scale-in relative"
                        style="animation-delay: 0.{{ $loop->index }}s">
                        @if ($address->is_default)
                            <div class="default-badge">
                                <i class="fas fa-star mr-1"></i>
                                <span>Utama</span>
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-gray-800">{{ $address->label }}</h3>
                                <div class="flex gap-2">
                                    <button onclick="openEditModal({{ $address->id }})"
                                        class="text-blue-500 hover:text-blue-700 transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('konsumen.addresses.delete', $address->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus alamat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:text-red-700 transition-colors">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-user w-5 text-green-600 mr-2"></i>
                                    <span>{{ $address->penerima }}</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-phone w-5 text-green-600 mr-2"></i>
                                    <span>{{ $address->no_hp }}</span>
                                </div>
                                <div class="flex items-start text-gray-700">
                                    <i class="fas fa-map-marker-alt w-5 text-green-600 mr-2 mt-1"></i>
                                    <span>{{ $address->alamat_lengkap }}</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-city w-5 text-green-600 mr-2"></i>
                                    <span>{{ $address->kecamatan }}, {{ $address->kota }}</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-flag w-5 text-green-600 mr-2"></i>
                                    <span>{{ $address->provinsi }}</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-mail-bulk w-5 text-green-600 mr-2"></i>
                                    <span>{{ $address->kode_pos }}</span>
                                </div>
                            </div>

                            @if (!$address->is_default)
                                <form action="{{ route('konsumen.addresses.set-default', $address->id) }}"
                                    method="POST" class="mt-4">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg transition-colors">
                                        <i class="fas fa-star mr-2"></i>
                                        Jadikan Alamat Utama
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state p-12 text-center fade-in">
                <i class="fas fa-map-marked-alt text-6xl text-gray-300 mb-5"></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-3">Belum Ada Alamat Pengiriman</h3>
                <p class="text-gray-600 max-w-md mx-auto mb-6">Anda belum menambahkan alamat pengiriman. Silakan
                    tambahkan alamat terlebih dahulu.</p>
                <button onclick="openAddModal()"
                    class="btn-primary text-white px-6 py-3 rounded-full font-medium flex items-center justify-center mx-auto">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Tambah Alamat Baru</span>
                </button>
            </div>
        @endif

        <!-- Add/Edit Address Modal -->
        <div id="addressModal" class="modal">
            <div class="modal-content">
                <div class="p-6 border-b">
                    <div class="flex justify-between items-center">
                        <h2 id="modalTitle" class="text-2xl font-bold text-gray-800">Tambah Alamat Baru</h2>
                        <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>

                <form id="addressForm" action="{{ route('konsumen.addresses.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="addressId" name="address_id" value="">
                    <input type="hidden" id="formMethod" name="_method" value="POST">

                    <div class="p-6">
                        <div class="form-group">
                            <label class="form-label" for="label">Label Alamat</label>
                            <input type="text" id="label" name="label" class="form-control"
                                placeholder="Rumah, Kantor, dll." required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="penerima">Nama Penerima</label>
                            <input type="text" id="penerima" name="penerima" class="form-control"
                                placeholder="Nama penerima paket" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="no_hp">Nomor HP</label>
                            <input type="text" id="no_hp" name="no_hp" class="form-control"
                                placeholder="08xxxxxxxxxx" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="alamat_lengkap">Alamat Lengkap</label>
                            <textarea id="alamat_lengkap" name="alamat_lengkap" class="form-control" rows="3"
                                placeholder="Jalan, nomor rumah, RT/RW" required></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label" for="provinsi">Provinsi</label>
                                <input type="text" id="provinsi" name="provinsi" class="form-control"
                                    placeholder="Provinsi" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="kota">Kota/Kabupaten</label>
                                <input type="text" id="kota" name="kota" class="form-control"
                                    placeholder="Kota atau kabupaten" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label" for="kecamatan">Kecamatan</label>
                                <input type="text" id="kecamatan" name="kecamatan" class="form-control"
                                    placeholder="Kecamatan" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="kode_pos">Kode Pos</label>
                                <input type="text" id="kode_pos" name="kode_pos" class="form-control"
                                    placeholder="Kode pos" required>
                            </div>
                        </div>

                        <div class="form-group flex items-center">
                            <input type="checkbox" id="is_default" name="is_default" class="mr-2">
                            <label for="is_default" class="text-gray-700">Jadikan sebagai alamat utama</label>
                        </div>
                    </div>

                    <div class="p-6 border-t bg-gray-50 flex justify-end gap-3">
                        <button type="button" onclick="closeModal()"
                            class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                            Simpan Alamat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Modal functions
        function openAddModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Alamat Baru';
            document.getElementById('addressForm').action = "{{ route('konsumen.addresses.store') }}";
            document.getElementById('formMethod').value = "POST";
            document.getElementById('addressId').value = "";
            document.getElementById('addressForm').reset();
            document.getElementById('addressModal').classList.add('active');
        }

        function openEditModal(id) {
            // Fetch address data via AJAX
            fetch(`/konsumen/alamat/get/${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('modalTitle').textContent = 'Edit Alamat';
                    document.getElementById('addressForm').action = `/konsumen/alamat/${id}`;
                    document.getElementById('formMethod').value = "PUT";
                    document.getElementById('addressId').value = data.id;

                    // Fill form with data
                    document.getElementById('label').value = data.label;
                    document.getElementById('penerima').value = data.penerima;
                    document.getElementById('no_hp').value = data.no_hp;
                    document.getElementById('alamat_lengkap').value = data.alamat_lengkap;
                    document.getElementById('provinsi').value = data.provinsi;
                    document.getElementById('kota').value = data.kota;
                    document.getElementById('kecamatan').value = data.kecamatan;
                    document.getElementById('kode_pos').value = data.kode_pos;
                    document.getElementById('is_default').checked = data.is_default;

                    document.getElementById('addressModal').classList.add('active');
                })
                .catch(error => {
                    console.error('Error fetching address data:', error);
                    alert('Gagal memuat data alamat. Silakan coba lagi.');
                });
        }

        function closeModal() {
            document.getElementById('addressModal').classList.remove('active');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('addressModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        // Form submission handler
        document.getElementById('addressForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const submitButton = this.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.innerHTML;

            // Disable button and show loading state
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';

            const formData = new FormData(this);
            const url = this.action;
            const method = document.getElementById('formMethod').value;

            // Debug: Log data yang akan dikirim
            console.log('Submitting form to:', url);
            console.log('Method:', method);
            console.log('Form data:');
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            fetch(url, {
                    method: method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status);

                    if (response.redirected) {
                        window.location.href = response.url;
                        return;
                    }

                    if (!response.ok) {
                        throw new Error('Network response was not ok: ' + response.statusText);
                    }

                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);

                    if (data && data.success) {
                        alert(data.message);
                        window.location.reload();
                    } else {
                        // Show error message if available
                        const errorMessage = data.message || 'Terjadi kesalahan. Silakan coba lagi.';
                        alert(errorMessage);

                        // Re-enable button
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalButtonText;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);

                    // Show error message
                    alert('Terjadi kesalahan: ' + error.message);

                    // Re-enable button
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalButtonText;
                });
        });
    </script>
</body>

</html>
