<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Platform Pertanian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #10B981;
            --primary-dark: #059669;
            --secondary: #3B82F6;
            --background: #F9FAFB;
            --surface: #FFFFFF;
            --text-primary: #1F2937;
            --text-secondary: #6B7280;
            --border: #E5E7EB;
            --hover: #F3F4F6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            color: var(--text-primary);
            overflow-x: hidden;
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

        @keyframes slideIn {
            from {
                transform: translateX(-20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .slide-in {
            animation: slideIn 0.3s ease-out forwards;
        }

        .hover-scale {
            transition: transform 0.2s ease;
        }

        .hover-scale:hover {
            transform: scale(1.02);
        }

        .notification-pulse {
            animation: pulse 2s infinite;
        }

        /* Glass morphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Table row animation */
        .table-row {
            transition: all 0.3s ease;
        }

        .table-row:hover {
            background-color: rgba(16, 185, 129, 0.05);
            transform: translateX(5px);
        }

        /* Tab styles */
        .tab {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .tab::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background-color: var(--primary);
            transition: width 0.3s ease;
        }

        .tab.active::after {
            width: 100%;
        }

        /* Button styles */
        .btn-primary {
            background-color: var(--primary);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3);
        }

        .btn-success {
            background-color: #4CAF50;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background-color: #45a049;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: #f44336;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #d32f2f;
            transform: translateY(-2px);
        }

        /* Sidebar item styles */
        .sidebar-item {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: var(--primary);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .sidebar-item:hover::before,
        .sidebar-item.active::before {
            transform: translateX(0);
        }

        /* Status badge styles */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-pending {
            background-color: rgba(245, 158, 11, 0.1);
            color: #F59E0B;
        }

        .status-confirmed {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--primary);
        }

        .status-rejected {
            background-color: rgba(239, 68, 68, 0.1);
            color: #EF4444;
        }

        /* Card styles */
        .card {
            background-color: var(--surface);
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Search box styles */
        .search-box {
            transition: all 0.3s ease;
        }

        .search-box:focus-within {
            transform: scale(1.02);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }

        /* Alert styles */
        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .alert-success {
            background-color: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
            border-left: 4px solid #4CAF50;
        }

        .reject-form {
            margin-top: 10px;
        }

        .reject-form input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        /* Loading animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg z-10 slide-in">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div
                        class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center text-white font-bold mr-3">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">PERTANIAN</h1>
                        <span class="text-xs font-medium text-green-500">ADMIN PANEL</span>
                    </div>
                </div>
            </div>

            <nav class="p-4">
                <ul>
                    <li
                        class="sidebar-item active mb-1 p-3 rounded-lg cursor-pointer flex items-center text-gray-700 hover:bg-green-50">
                        <i class="fas fa-tachometer-alt w-5 mr-3 text-green-500"></i>
                        <span class="font-medium">Dashboard</span>
                    </li>
                    <li
                        class="sidebar-item mb-1 p-3 rounded-lg cursor-pointer flex items-center text-gray-700 hover:bg-green-50">
                        <i class="fas fa-users w-5 mr-3 text-gray-500"></i>
                        <span class="font-medium">Petani</span>
                    </li>
                    <li
                        class="sidebar-item mb-1 p-3 rounded-lg cursor-pointer flex items-center text-gray-700 hover:bg-green-50">
                        <i class="fas fa-shopping-cart w-5 mr-3 text-gray-500"></i>
                        <span class="font-medium">Konsumen</span>
                    </li>
                    <li
                        class="sidebar-item mb-1 p-3 rounded-lg cursor-pointer flex items-center text-gray-700 hover:bg-green-50">
                        <i class="fas fa-carrot w-5 mr-3 text-gray-500"></i>
                        <span class="font-medium">Produk</span>
                    </li>
                    <li
                        class="sidebar-item mb-1 p-3 rounded-lg cursor-pointer flex items-center text-gray-700 hover:bg-green-50">
                        <i class="fas fa-shopping-bag w-5 mr-3 text-gray-500"></i>
                        <span class="font-medium">Pesanan</span>
                    </li>
                    <li
                        class="sidebar-item mb-1 p-3 rounded-lg cursor-pointer flex items-center text-gray-700 hover:bg-green-50">
                        <i class="fas fa-chart-line w-5 mr-3 text-gray-500"></i>
                        <span class="font-medium">Laporan</span>
                    </li>
                    <li
                        class="sidebar-item mb-1 p-3 rounded-lg cursor-pointer flex items-center text-gray-700 hover:bg-green-50">
                        <i class="fas fa-cog w-5 mr-3 text-gray-500"></i>
                        <span class="font-medium">Pengaturan</span>
                    </li>
                </ul>
            </nav>

            <div class="absolute bottom-0 w-full p-4 border-t border-gray-200">
                <div class="flex items-center">
                    <img src="https://picsum.photos/seed/admin123/40/40.jpg" alt="Avatar"
                        class="w-10 h-10 rounded-full mr-3">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm z-10 fade-in">
                <div class="flex items-center justify-between p-4">
                    <h2 class="text-2xl font-bold text-gray-800">Verifikasi Petani</h2>

                    <div class="flex items-center space-x-4">
                        <div class="relative search-box">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text"
                                class="block w-64 pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="Cari petani...">
                        </div>

                        <div class="relative">
                            <button class="p-2 rounded-full hover:bg-gray-100 relative">
                                <i class="fas fa-bell text-gray-600"></i>
                                @if ($pendingFarmers->count() > 0)
                                    <span
                                        class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full notification-pulse"></span>
                                @endif
                            </button>
                        </div>

                        <div class="flex items-center">
                            <img src="https://picsum.photos/seed/admin456/40/40.jpg" alt="Avatar"
                                class="w-10 h-10 rounded-full">
                        </div>
                    </div>
                </div>
            </header>

            <!-- Alert Message -->
            @if (session('success'))
                <div class="alert alert-success mx-6 mt-4 fade-in">
                    <span><i class="fas fa-check-circle mr-2"></i> {{ session('success') }}</span>
                </div>
            @endif

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto p-6 fade-in" style="animation-delay: 0.2s">
                <div class="card overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Daftar Petani Menunggu Verifikasi</h3>
                        <p class="mt-1 text-sm text-gray-500">Verifikasi petani yang baru mendaftar di platform</p>
                    </div>

                    @if ($pendingFarmers->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Petani
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Informasi
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Proposal
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($pendingFarmers as $farmer)
                                        <tr class="table-row">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full"
                                                            src="https://picsum.photos/seed/{{ $farmer->name }}/40/40.jpg"
                                                            alt="{{ $farmer->name }}">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $farmer->name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $farmer->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $farmer->jenis_tanaman }}</div>
                                                <div class="text-sm text-gray-500">{{ $farmer->lokasi_pertanian }},
                                                    {{ $farmer->luas_lahan }} Ha</div>
                                                <div class="text-sm text-gray-500">{{ $farmer->no_hp }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($farmer->hasProposal())
                                                    <a href="{{ route('admin.download-proposal', $farmer) }}"
                                                        target="_blank"
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 hover:bg-blue-200">
                                                        <i class="fas fa-file-pdf mr-1"></i> Lihat Proposal
                                                    </a>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        <i class="fas fa-times-circle mr-1"></i> Tidak ada proposal
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="status-badge status-pending">
                                                    <i class="fas fa-clock mr-1"></i> Menunggu
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <!-- Form Approve -->
                                                <form action="{{ route('admin.verify.farmer', $farmer) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    <input type="hidden" name="action" value="approve">
                                                    <button type="submit" class="btn-success">
                                                        <i class="fas fa-check mr-1"></i> Setujui
                                                    </button>
                                                </form>

                                                <!-- Form Reject -->
                                                <button type="button" class="btn-danger ml-2"
                                                    onclick="toggleRejectForm({{ $farmer->id }})">
                                                    <i class="fas fa-times mr-1"></i> Tolak
                                                </button>

                                                <!-- Hidden Reject Form -->
                                                <div id="reject-form-{{ $farmer->id }}" class="reject-form hidden">
                                                    <form action="{{ route('admin.verify.farmer', $farmer) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="action" value="reject">
                                                        <input type="text" name="alasan_penolakan"
                                                            placeholder="Alasan penolakan" required
                                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                                                        <div class="mt-2 flex space-x-2">
                                                            <button type="submit" class="btn-danger">
                                                                <i class="fas fa-save mr-1"></i> Simpan
                                                            </button>
                                                            <button type="button"
                                                                class="px-3 py-1 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300"
                                                                onclick="toggleRejectForm({{ $farmer->id }})">
                                                                Batal
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-full bg-green-100">
                                <i class="fas fa-check text-green-600 text-2xl"></i>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak Ada Petani Menunggu Verifikasi
                            </h3>
                            <p class="mt-2 text-sm text-gray-500">Semua petani telah diverifikasi</p>
                        </div>
                    @endif

                    <!-- Pagination -->
                    <div class="bg-white px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Menampilkan <span class="font-medium">1</span> hingga <span
                                class="font-medium">{{ $pendingFarmers->count() }}</span> dari <span
                                class="font-medium">{{ $pendingFarmers->count() }}</span> hasil
                        </div>
                        <div class="flex space-x-2">
                            <button
                                class="px-3 py-1 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 disabled:opacity-50"
                                disabled>
                                Sebelumnya
                            </button>
                            <button
                                class="px-3 py-1 rounded-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Selanjutnya
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Logout Form (Hidden) -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        // Function to toggle reject form
        function toggleRejectForm(farmerId) {
            const form = document.getElementById(`reject-form-${farmerId}`);
            form.classList.toggle('hidden');
        }

        // Add event listeners to sidebar items
        document.querySelectorAll('.sidebar-item').forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all items
                document.querySelectorAll('.sidebar-item').forEach(i => {
                    i.classList.remove('active');
                });

                // Add active class to clicked item
                this.classList.add('active');
            });
        });

        // Notification bell click handler
        document.querySelector('.fa-bell').parentElement.addEventListener('click', function() {
            // Create a notification
            const notification = document.createElement('div');
            notification.className =
                'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 fade-in';
            notification.innerHTML = '<i class="fas fa-bell mr-2"></i> Anda memiliki ' +
                {{ $pendingFarmers->count() }} + ' petani yang menunggu verifikasi';
            document.body.appendChild(notification);

            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        });

        // Logout handler
        document.querySelector('.sidebar-item:last-child').addEventListener('click', function(e) {
            if (e.target.textContent.includes('Logout')) {
                e.preventDefault();
                document.getElementById('logout-form').submit();
            }
        });
    </script>
</body>

</html>
