<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alamat Pengiriman - Sistem Pertanian</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            --error: #ef4444;
            --success: #10b981;
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

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .scale-in {
            animation: scaleIn 0.3s ease-out forwards;
        }

        .shake {
            animation: shake 0.5s ease-in-out;
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

        .form-control.error {
            border-color: var(--error);
            animation: shake 0.5s ease-in-out;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .form-hint {
            display: block;
            margin-top: 5px;
            font-size: 13px;
            color: var(--text-secondary);
        }

        .form-error {
            display: none;
            margin-top: 5px;
            font-size: 13px;
            color: var(--error);
        }

        .form-error.show {
            display: block;
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 16px 24px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            z-index: 2000;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        .toast.success {
            background-color: var(--success);
        }

        .toast.error {
            background-color: var(--error);
        }

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
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

        <!-- Notification Toast -->
        <div id="toast" class="toast"></div>

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
                                    <button onclick="confirmDelete({{ $address->id }})"
                                        class="text-red-500 hover:text-red-700 transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </button>
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
                                <button onclick="setDefaultAddress({{ $address->id }})"
                                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg transition-colors">
                                    <i class="fas fa-star mr-2"></i>
                                    Jadikan Alamat Utama
                                </button>
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
                        <!-- Tombol Tutup (X) -->
                        <button onclick="closeModalById('addressModal')" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times text-xl"></i>
                        </button>

                    </div>
                </div>

                <form id="addressForm" action="{{ route('konsumen.addresses.store') }}" method="POST" novalidate>
                    @csrf
                    <input type="hidden" id="addressId" name="address_id" value="">
                    <input type="hidden" id="formMethod" name="_method" value="POST">

                    <div class="p-6">
                        <div class="form-group">
                            <label class="form-label" for="label">Label Alamat <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="label" name="label" class="form-control"
                                placeholder="Rumah, Kantor, dll." required>
                            <span class="form-hint">Contoh: Rumah, Kantor, Apartemen</span>
                            <div class="form-error" id="label-error"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="penerima">Nama Penerima <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="penerima" name="penerima" class="form-control"
                                placeholder="Nama penerima paket" required>
                            <span class="form-hint">Masukkan nama lengkap penerima paket</span>
                            <div class="form-error" id="penerima-error"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="no_hp">Nomor HP <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" id="no_hp" name="no_hp" class="form-control"
                                placeholder="08xxxxxxxxxx" required>
                            <span class="form-hint">Contoh: 081234567890 (minimal 10 digit, hanya angka)</span>
                            <div class="form-error" id="no_hp-error"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="alamat_lengkap">Alamat Lengkap <span
                                    class="text-red-500">*</span></label>
                            <textarea id="alamat_lengkap" name="alamat_lengkap" class="form-control" rows="3"
                                placeholder="Jalan, nomor rumah, RT/RW" required></textarea>
                            <span class="form-hint">Masukkan alamat lengkap termasuk jalan, nomor rumah, RT/RW</span>
                            <div class="form-error" id="alamat_lengkap-error"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label" for="provinsi">Provinsi <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="provinsi" name="provinsi" class="form-control"
                                    placeholder="Provinsi" required>
                                <span class="form-hint">Contoh: Jawa Barat, DKI Jakarta</span>
                                <div class="form-error" id="provinsi-error"></div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="kota">Kota/Kabupaten <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="kota" name="kota" class="form-control"
                                    placeholder="Kota atau kabupaten" required>
                                <span class="form-hint">Contoh: Bandung, Jakarta Selatan</span>
                                <div class="form-error" id="kota-error"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-group">
                                <label class="form-label" for="kecamatan">Kecamatan <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="kecamatan" name="kecamatan" class="form-control"
                                    placeholder="Kecamatan" required>
                                <span class="form-hint">Contoh: Coblong, Menteng</span>
                                <div class="form-error" id="kecamatan-error"></div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="kode_pos">Kode Pos <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="kode_pos" name="kode_pos" class="form-control"
                                    placeholder="Kode pos" required>
                                <span class="form-hint">5 digit angka (contoh: 40132)</span>
                                <div class="form-error" id="kode_pos-error"></div>
                            </div>
                        </div>

                        <div class="form-group flex items-center">
                            <input type="checkbox" id="is_default" name="is_default" class="mr-2">
                            <label for="is_default" class="text-gray-700">Jadikan sebagai alamat utama</label>
                        </div>
                    </div>

                    <div class="p-6 border-t bg-gray-50 flex justify-end gap-3">
                        <button type="button" onclick="closeModalById('addressModal')"
                            class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                            Batal
                        </button>


                        <button type="submit" id="submitBtn"
                            class="btn-primary text-white px-6 py-3 rounded-lg font-medium">
                            Simpan Alamat
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="modal">
            <div class="modal-content" style="max-width: 500px;">
                <div class="p-6 border-b">
                    <h2 class="text-2xl font-bold text-gray-800">Konfirmasi Hapus</h2>
                </div>
                <div class="p-6">
                    <p class="mb-6">Apakah Anda yakin ingin menghapus alamat ini? Tindakan ini tidak dapat
                        dibatalkan.</p>
                    <div class="flex justify-end gap-3">
                        <button onclick="closeDeleteModal()"
                            class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                            Batal
                        </button>
                        <button id="confirmDeleteBtn" class="btn-danger text-white px-6 py-3 rounded-lg font-medium">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Constants / Selectors
            const toastEl = document.getElementById('toast');
            const addressModalEl = document.getElementById('addressModal');
            const deleteModalEl = document.getElementById('deleteModal');
            const addressFormEl = document.getElementById('addressForm');
            const submitBtnEl = document.getElementById('submitBtn');
            const confirmDeleteBtnEl = document.getElementById('confirmDeleteBtn');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            let deleteId = null;

            // ========== Toast Notification ==========
            function showToast(message, type = 'success') {
                const prefix = {
                    success: '✅ ',
                    error: '❌ ',
                    info: 'ℹ️ ',
                    warning: '⚠️ '
                } [type] || '';

                toastEl.textContent = prefix + message;
                toastEl.className = `toast ${type} show`;

                // Bisa tambahkan animasi fade in/out via CSS
                setTimeout(() => {
                    toastEl.classList.remove('show');
                }, 3000);
            }

            // ========== Modal Helpers ==========
            function openAddModal() {
                setModalTitle('Tambah Alamat Baru');
                addressFormEl.action = "{{ route('konsumen.addresses.store') }}";
                setFormMethod('POST');
                setAddressFormValues({}); // reset
                clearFormErrors();
                showModal(addressModalEl);
            }

            function openEditModal(id) {
                setModalTitle('Edit Alamat');
                showToast('Memuat data alamat...', 'info');

                const getUrl = `{{ route('konsumen.addresses.get', ['id' => ':id']) }}`.replace(':id', id);
                fetch(getUrl, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Gagal menghubungi server');
                        return response.json();
                    })
                    .then(data => {
                        // Set action URL for update
                        const updateUrl = `{{ route('konsumen.addresses.update', ['id' => ':id']) }}`.replace(
                            ':id', id);
                        addressFormEl.action = updateUrl;
                        setFormMethod('PUT');

                        // Fill form fields
                        setAddressFormValues(data);

                        clearFormErrors();
                        showModal(addressModalEl);
                    })
                    .catch(error => {
                        console.error('Error fetching address data:', error);
                        showToast('Tidak dapat memuat alamat. Silakan coba lagi nanti.', 'error');
                    });
            }

            function closeModalById(id) {
                const modalEl = document.getElementById(id);
                if (modalEl) {
                    modalEl.classList.remove('active');
                }
            }
            window.closeModalById = closeModalById;


            function closeModal(modalEl) {
                modalEl.classList.remove('active');
            }

            function showModal(modalEl) {
                modalEl.classList.add('active');
            }

            function setModalTitle(titleText) {
                document.getElementById('modalTitle').textContent = titleText;
            }

            function setFormMethod(method) {
                document.getElementById('formMethod').value = method.toUpperCase(); // 'POST' atau 'PUT'
            }

            function setAddressFormValues(data = {}) {
                // data bisa kosong objek, maka fallback ke ''
                document.getElementById('addressId').value = data.id || '';
                document.getElementById('label').value = data.label || '';
                document.getElementById('penerima').value = data.penerima || '';
                document.getElementById('no_hp').value = data.no_hp || '';
                document.getElementById('alamat_lengkap').value = data.alamat_lengkap || '';
                document.getElementById('provinsi').value = data.provinsi || '';
                document.getElementById('kota').value = data.kota || '';
                document.getElementById('kecamatan').value = data.kecamatan || '';
                document.getElementById('kode_pos').value = data.kode_pos || '';
                document.getElementById('is_default').checked = data.is_default || false;
            }

            // ========== Delete Modal ==========
            function confirmDelete(id) {
                deleteId = id;
                showModal(deleteModalEl);
            }

            function closeDeleteModal() {
                deleteId = null;
                closeModal(deleteModalEl);
            }

            confirmDeleteBtnEl.addEventListener('click', () => {
                if (deleteId) {
                    deleteAddress(deleteId);
                }
            });

            // Close modals when click outside
            window.addEventListener('click', (event) => {
                if (event.target === addressModalEl) {
                    closeModal(addressModalEl);
                }
                if (event.target === deleteModalEl) {
                    closeDeleteModal();
                }
            });

            // ========== Form Validation ==========
            const validationRules = {
                label: {
                    required: true,
                    minLength: 2,
                    messages: {
                        required: 'Label alamat tidak boleh kosong.',
                        minLength: 'Label alamat minimal 2 karakter.'
                    }
                },
                penerima: {
                    required: true,
                    minLength: 3,
                    messages: {
                        required: 'Nama penerima tidak boleh kosong.',
                        minLength: 'Nama penerima minimal 3 karakter.'
                    }
                },
                no_hp: {
                    required: true,
                    pattern: /^[0-9]{10,15}$/,
                    messages: {
                        required: 'Nomor HP tidak boleh kosong.',
                        pattern: 'Nomor HP harus berupa 10‑15 digit angka.'
                    }
                },
                alamat_lengkap: {
                    required: true,
                    minLength: 10,
                    messages: {
                        required: 'Alamat lengkap tidak boleh kosong.',
                        minLength: 'Alamat lengkap minimal 10 karakter.'
                    }
                },
                provinsi: {
                    required: true,
                    messages: {
                        required: 'Provinsi tidak boleh kosong.'
                    }
                },
                kota: {
                    required: true,
                    messages: {
                        required: 'Kota/Kabupaten tidak boleh kosong.'
                    }
                },
                kecamatan: {
                    required: true,
                    messages: {
                        required: 'Kecamatan tidak boleh kosong.'
                    }
                },
                kode_pos: {
                    required: true,
                    pattern: /^[0-9]{5}$/,
                    messages: {
                        required: 'Kode pos tidak boleh kosong.',
                        pattern: 'Kode pos harus 5 digit angka.'
                    }
                }
            };

            function validateField(fieldName) {
                const rule = validationRules[fieldName];
                const fieldEl = document.getElementById(fieldName);
                const errorEl = document.getElementById(`${fieldName}-error`);
                let value = fieldEl.value.trim();
                let isValid = true;
                let message = '';

                if (rule.required && !value) {
                    isValid = false;
                    message = rule.messages.required;
                } else if (rule.minLength && value.length < rule.minLength) {
                    isValid = false;
                    message = rule.messages.minLength;
                } else if (rule.pattern && !rule.pattern.test(value)) {
                    isValid = false;
                    message = rule.messages.pattern;
                }

                if (!isValid) {
                    showFieldError(fieldEl, errorEl, message);
                } else {
                    hideFieldError(fieldEl, errorEl);
                }

                return isValid;
            }

            function validateForm() {
                let allValid = true;
                Object.keys(validationRules).forEach(fieldName => {
                    const valid = validateField(fieldName);
                    if (!valid) allValid = false;
                });
                return allValid;
            }

            function showFieldError(fieldEl, errorEl, message) {
                fieldEl.classList.add('error');
                errorEl.textContent = message;
                errorEl.classList.add('show');
            }

            function hideFieldError(fieldEl, errorEl) {
                fieldEl.classList.remove('error');
                errorEl.classList.remove('show');
            }

            function clearFormErrors() {
                Object.keys(validationRules).forEach(fieldName => {
                    const fieldEl = document.getElementById(fieldName);
                    const errorEl = document.getElementById(`${fieldName}-error`);
                    hideFieldError(fieldEl, errorEl);
                });
            }

            // Real‐time validation on blur & input
            Object.keys(validationRules).forEach(fieldName => {
                const fieldEl = document.getElementById(fieldName);
                if (!fieldEl) return;
                const errorEl = document.getElementById(`${fieldName}-error`);

                fieldEl.addEventListener('blur', () => validateField(fieldName));
                fieldEl.addEventListener('input', () => {
                    if (fieldEl.classList.contains('error')) {
                        validateField(fieldName);
                    }
                });
            });

            // ========== Form Submission ==========
            addressFormEl.addEventListener('submit', (e) => {
                e.preventDefault();

                if (!validateForm()) {
                    showToast('Form belum lengkap. Silakan diperiksa kembali.', 'error');
                    return;
                }

                const originalBtnHtml = submitBtnEl.innerHTML;
                disableButtonWithSpinner(submitBtnEl, 'Menyimpan');

                const formData = new FormData(addressFormEl);
                const method = document.getElementById('formMethod').value.toUpperCase();
                const url = addressFormEl.action;

                if (method === 'PUT') {
                    formData.append('_method', 'PUT');
                }

                fetch(url, {
                        method: 'POST', // Laravel expects POST + _method override
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    })
                    .then(async (response) => {
                        if (!response.ok) {
                            const text = await response.text();
                            try {
                                const json = JSON.parse(text);
                                const error = new Error(json.message || 'Terjadi kesalahan server');
                                error.errors = json.errors || {};
                                throw error;
                            } catch (errParse) {
                                throw new Error(
                                    'Terjadi kesalahan yang tidak terduga. Silakan coba lagi.');
                            }
                        }
                        const contentType = response.headers.get('content-type') || '';
                        if (!contentType.includes('application/json')) {
                            throw new Error('Respon dari server tidak valid.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data && data.success) {
                            showToast(data.message || 'Alamat berhasil disimpan.', 'success');
                            closeModal(addressModalEl);
                            setTimeout(() => {
                                window.location.reload();
                            }, 1200);
                        } else {
                            showToast(data.message || 'Gagal menyimpan data. Silakan coba lagi.',
                                'error');
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        if (error.errors) {
                            // Tampilkan validasi dari server
                            for (const [field, msgs] of Object.entries(error.errors)) {
                                const fieldEl = document.getElementById(field);
                                const errorEl = document.getElementById(`${field}-error`);
                                if (fieldEl && errorEl && Array.isArray(msgs)) {
                                    showFieldError(fieldEl, errorEl, msgs[0]);
                                }
                            }
                            showToast('Periksa kembali data yang diisi.', 'warning');
                        } else {
                            showToast(error.message || 'Terjadi kesalahan. Silakan coba lagi nanti.',
                                'error');
                        }
                    })
                    .finally(() => {
                        restoreButton(submitBtnEl, originalBtnHtml);
                    });
            });

            // ========== Set Default Address ==========
            function setDefaultAddress(id) {
                const url = `{{ route('konsumen.addresses.set-default', ['id' => ':id']) }}`.replace(':id', id);
                disableButtonWithSpinner(document.getElementById(`defaultBtn-${id}`), 'Mengatur');

                fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(json => {
                                throw new Error(json.message || 'Gagal mengatur alamat utama.');
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        showToast(data.message || 'Alamat utama berhasil diperbarui.', 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    })
                    .catch(error => {
                        console.error(error);
                        showToast(error.message || 'Gagal mengatur alamat utama. Silakan coba lagi.', 'error');
                    })
                    .finally(() => {
                        restoreButton(document.getElementById(`defaultBtn-${id}`), 'Jadikan Utama');
                    });
            }

            // ========== Delete Address ==========
            function deleteAddress(id) {
                const url = `{{ route('konsumen.addresses.delete', ['id' => ':id']) }}`.replace(':id', id);
                disableButtonWithSpinner(confirmDeleteBtnEl, 'Menghapus');

                fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(json => {
                                throw new Error(json.message || 'Gagal menghapus alamat.');
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        closeDeleteModal();
                        showToast(data.message || 'Alamat berhasil dihapus.', 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    })
                    .catch(error => {
                        console.error(error);
                        showToast(error.message || 'Gagal menghapus alamat. Silakan coba lagi.', 'error');
                    })
                    .finally(() => {
                        restoreButton(confirmDeleteBtnEl, 'Ya, Hapus');
                    });
            }

            // ========== Util Functions ==========
            function disableButtonWithSpinner(buttonEl, actionText = 'Memproses') {
                if (!buttonEl) return;
                buttonEl.disabled = true;
                buttonEl.dataset.origText = buttonEl.innerHTML;
                buttonEl.innerHTML = `<span class="spinner mr-2"></span>${actionText}...`;
            }

            function restoreButton(buttonEl, text) {
                if (!buttonEl) return;
                buttonEl.disabled = false;
                buttonEl.innerHTML = text;
            }

            // Exposure to global (optional, jika kamu panggil dari HTML inline)
            window.openAddModal = openAddModal;
            window.openEditModal = openEditModal;
            window.confirmDelete = confirmDelete;
            window.setDefaultAddress = setDefaultAddress;
        });
    </script>


</body>

</html>
