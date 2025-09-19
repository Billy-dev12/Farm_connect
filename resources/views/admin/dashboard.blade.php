<!-- resources/views/admin/dashboard.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <style>
        /* ... style sebelumnya ... */
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
    </style>
</head>

<body>
    <h1>Admin Dashboard</h1>

    <h2>Petani Menunggu Verifikasi</h2>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if ($pendingFarmers->count() > 0)
        <table border="1">
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Jenis Tanaman</th>
                <th>Lokasi</th>
                <th>Luas Lahan</th>
                <th>Aksi</th>
            </tr>
            @foreach ($pendingFarmers as $farmer)
                <tr>
                    <td>{{ $farmer->name }}</td>
                    <td>{{ $farmer->email }}</td>
                    <td>{{ $farmer->jenis_tanaman }}</td>
                    <td>
                        @if ($farmer->hasProposal())
                            <i class="fas fa-file-pdf" style="color: red;"></i>
                            <a href="{{ route('admin.download-proposal', $farmer) }}" target="_blank">
                                Lihat Proposal
                            </a>
                        @else
                            <span style="color: #999;">Tidak ada proposal</span>
                        @endif
                    </td>
                    <td>{{ $farmer->lokasi_pertanian }}</td>
                    <td>{{ $farmer->luas_lahan }} Ha</td>
                    <td>
                        <!-- Form Approve -->
                        <form action="{{ route('admin.verify.farmer', $farmer) }}" method="POST"
                            style="display: inline;">
                            @csrf
                            <input type="hidden" name="action" value="approve">
                            <button type="submit"
                                style="background: #4CAF50; color: white; padding: 5px 10px; border: none; border-radius: 3px;">Setujui</button>
                        </form>

                        <!-- Form Reject -->
                        <form action="{{ route('admin.verify.farmer', $farmer) }}" method="POST"
                            style="display: inline; margin-left: 10px;">
                            @csrf
                            <input type="hidden" name="action" value="reject">
                            <div class="reject-form">
                                <input type="text" name="alasan_penolakan" placeholder="Alasan penolakan" required>
                                <button type="submit"
                                    style="background: #f44336; color: white; padding: 5px 10px; border: none; border-radius: 3px;">Tolak</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Tidak ada petani yang menunggu verifikasi</p>
    @endif

    <!-- Yang BENAR -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>

</html>
