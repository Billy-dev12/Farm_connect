<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Petani - Sistem Pertanian</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #4a7c59 0%, #6fa071 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 800px;
            max-width: 90vw;
            height: auto;
            display: flex;
        }

        .register-form {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .visual-section {
            flex: 1;
            background-image: url('https://sfile.chatglm.cn/images-ppt/33f97a506311.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .visual-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(74, 124, 89, 0.8) 0%, rgba(111, 160, 113, 0.6) 100%);
            z-index: 1;
        }

        .visual-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: white;
            text-align: center;
        }

        .welcome-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 25px;
        }

        .welcome-text {
            font-size: 24px;
            font-weight: 600;
            color: #4a7c59;
            margin-bottom: 10px;
        }

        .sub-text {
            font-size: 14px;
            color: #666;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            font-size: 16px;
            z-index: 2;
        }

        .form-input {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
        }

        .form-input:focus {
            outline: none;
            border-color: #4a7c59;
            box-shadow: 0 0 0 3px rgba(74, 124, 89, 0.1);
            background-color: white;
        }

        /* File Upload Styles */
        .file-upload-container {
            margin-bottom: 20px;
        }

        .file-upload-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .proposal-info {
            background: #f0f8f0;
            border: 1px solid #4a7c59;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .proposal-info h4 {
            color: #4a7c59;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .proposal-info p {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .proposal-info a {
            color: #4a7c59;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .proposal-info a:hover {
            text-decoration: underline;
        }

        .file-upload-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-upload-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 3;
        }

        .file-upload-display {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            border: 2px dashed #ddd;
            border-radius: 8px;
            background: #f9f9f9;
            transition: all 0.3s ease;
            min-height: 50px;
        }

        .file-upload-display.has-file {
            border-color: #4a7c59;
            background: #f0f8f0;
        }

        .file-upload-display.uploading {
            border-color: #ffc107;
            background: #fffbf0;
        }

        .file-upload-display.success {
            border-color: #28a745;
            background: #f8fff8;
        }

        .file-info {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
        }

        .file-icon {
            font-size: 20px;
            color: #666;
        }

        .file-icon.success {
            color: #28a745;
        }

        .file-icon.uploading {
            color: #ffc107;
        }

        .file-name {
            font-size: 14px;
            color: #333;
            word-break: break-all;
        }

        .file-size {
            font-size: 12px;
            color: #666;
        }

        .file-actions {
            display: flex;
            gap: 10px;
        }

        .file-remove-btn {
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 5px 8px;
            cursor: pointer;
            font-size: 12px;
        }

        .file-remove-btn:hover {
            background: #c82333;
        }

        .upload-progress {
            display: none;
            align-items: center;
            gap: 10px;
            margin-top: 8px;
        }

        .upload-progress.active {
            display: flex;
        }

        .progress-bar {
            flex: 1;
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #4a7c59;
            width: 0%;
            transition: width 0.3s ease;
        }

        .progress-text {
            font-size: 12px;
            color: #666;
            min-width: 40px;
        }

        .register-button {
            background-color: #4a7c59;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .register-button:hover {
            background-color: #6fa071;
        }

        .register-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .register-button.loading {
            color: transparent;
        }

        .register-button.loading::after {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            border: 2px solid transparent;
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spinner 0.8s linear infinite;
        }

        @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }

        .success-message {
            color: #28a745;
            font-size: 12px;
            margin-top: 5px;
        }

        .loading-spinner {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #4a7c59;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
                height: auto;
            }

            .visual-section {
                min-height: 200px;
                order: -1;
            }

            .visual-content {
                padding: 25px;
            }

            .visual-title {
                font-size: 22px;
            }

            .visual-description {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    <div class="register-container">
        <!-- Register Form Section -->
        <div class="register-form">
            <div class="welcome-container">
                <h1 class="welcome-text">Register Petani</h1>
            </div>
            <p class="sub-text">Bergabunglah sebagai petani untuk menjual hasil panen langsung ke konsumen.</p>

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form id="registerForm" method="POST" action="{{ route('register.farmer.post') }}"
                enctype="multipart/form-data">
                @csrf

                <!-- Name Input -->
                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="form-input" id="name" name="name"
                            placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                    </div>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" class="form-input" id="email" name="email" placeholder="Email"
                            value="{{ old('email') }}" required>
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-input" id="password" name="password" placeholder="Password"
                            required>
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Confirmation Input -->
                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-input" id="password_confirmation"
                            name="password_confirmation" placeholder="Konfirmasi Password" required>
                    </div>
                </div>

                <!-- No HP Input -->
                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-phone input-icon"></i>
                        <input type="text" class="form-input" id="no_hp" name="no_hp" placeholder="Nomor HP"
                            value="{{ old('no_hp') }}" required>
                    </div>
                    @error('no_hp')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jenis Tanaman Input -->
                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-seedling input-icon"></i>
                        <input type="text" class="form-input" id="jenis_tanaman" name="jenis_tanaman"
                            placeholder="Jenis Tanaman" value="{{ old('jenis_tanaman') }}" required>
                    </div>
                    @error('jenis_tanaman')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Lokasi Pertanian Input -->
                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-map-marker-alt input-icon"></i>
                        <input type="text" class="form-input" id="lokasi_pertanian" name="lokasi_pertanian"
                            placeholder="Lokasi Pertanian" value="{{ old('lokasi_pertanian') }}" required>
                    </div>
                    @error('lokasi_pertanian')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Luas Lahan Input -->
                <div class="form-group">
                    <div class="input-group">
                        <i class="fas fa-ruler-combined input-icon"></i>
                        <input type="number" class="form-input" id="luas_lahan" name="luas_lahan"
                            placeholder="Luas Lahan (Ha)" value="{{ old('luas_lahan') }}" step="0.1" required>
                    </div>
                    @error('luas_lahan')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Proposal Upload -->
                <div class="file-upload-container">
                    <label class="file-upload-label">
                        <i class="fas fa-file-pdf"></i> Proposal Pertanian (Wajib)
                    </label>

                    <div class="proposal-info">
                        <h4><i class="fas fa-info-circle"></i> Informasi Proposal</h4>
                        <p>Upload proposal usaha pertanian Anda dalam format PDF. Proposal akan digunakan untuk
                            verifikasi.</p>
                        <a href="{{ asset('template-proposal-pertanian.pdf') }}" target="_blank">
                            <i class="fas fa-download"></i> Download Template Proposal
                        </a>
                    </div>

                    <div class="file-upload-wrapper">
                        <input type="file" id="proposal" name="proposal" accept=".pdf" required
                            class="file-upload-input">

                        <div class="file-upload-display" id="fileDisplay">
                            <div class="file-info">
                                <i class="fas fa-cloud-upload-alt file-icon" id="fileIcon"></i>
                                <div>
                                    <div class="file-name" id="fileName">Pilih file PDF proposal</div>
                                    <div class="file-size" id="fileSize"></div>
                                </div>
                            </div>
                            <div class="file-actions">
                                <button type="button" class="file-remove-btn" id="removeFileBtn"
                                    style="display: none;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="upload-progress" id="uploadProgress">
                            <div class="progress-bar">
                                <div class="progress-fill" id="progressFill"></div>
                            </div>
                            <div class="progress-text" id="progressText">0%</div>
                        </div>
                    </div>

                    @error('proposal')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    <div class="success-message" id="uploadSuccess" style="display: none;">
                        <i class="fas fa-check-circle"></i> File berhasil diupload!
                    </div>
                </div>

                <!-- Register Button -->
                <button type="submit" class="register-button" id="registerButton">
                    <span id="buttonText">Register sebagai Petani</span>
                </button>
            </form>

            <div style="text-align: center; margin-top: 20px; font-size: 14px;">
                <p>Sudah punya akun? <a href="{{ route('login') }}"
                        style="color: #4a7c59; text-decoration: none;">Login di sini</a></p>
            </div>
        </div>

        <!-- Visual Section -->
        <div class="visual-section">
            <div class="visual-content">
                <h2 class="visual-title">Gabung sebagai Petani</h2>
                <p class="visual-description">
                    Jual hasil panen langsung ke konsumen tanpa perantara. Dapatkan harga yang lebih adil dan kendali
                    penuh atas produk Anda.
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('proposal');
            const fileDisplay = document.getElementById('fileDisplay');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            const fileIcon = document.getElementById('fileIcon');
            const removeFileBtn = document.getElementById('removeFileBtn');
            const uploadProgress = document.getElementById('uploadProgress');
            const progressFill = document.getElementById('progressFill');
            const progressText = document.getElementById('progressText');
            const uploadSuccess = document.getElementById('uploadSuccess');
            const registerForm = document.getElementById('registerForm');
            const registerButton = document.getElementById('registerButton');
            const buttonText = document.getElementById('buttonText');

            // File change handler
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];

                if (file) {
                    // Validate file type
                    if (file.type !== 'application/pdf') {
                        alert('Harap pilih file PDF!');
                        fileInput.value = '';
                        return;
                    }

                    // Validate file size (5MB)
                    if (file.size > 5 * 1024 * 1024) {
                        alert('Ukuran file maksimal 5MB!');
                        fileInput.value = '';
                        return;
                    }

                    // Update UI
                    fileDisplay.classList.add('has-file');
                    fileName.textContent = file.name;
                    fileSize.textContent = formatFileSize(file.size);
                    removeFileBtn.style.display = 'block';

                    // Show success message
                    uploadSuccess.style.display = 'block';

                    // Auto-hide after 3 seconds
                    setTimeout(() => {
                        uploadSuccess.style.display = 'none';
                    }, 3000);
                }
            });

            // Remove file handler
            removeFileBtn.addEventListener('click', function() {
                fileInput.value = '';
                fileDisplay.classList.remove('has-file', 'uploading', 'success');
                fileName.textContent = 'Pilih file PDF proposal';
                fileSize.textContent = '';
                removeFileBtn.style.display = 'none';
                uploadSuccess.style.display = 'none';
            });

            // Form submission handler
            registerForm.addEventListener('submit', function(e) {
                if (!fileInput.files[0]) {
                    e.preventDefault();
                    alert('Harap upload proposal pertanian!');
                    return;
                }

                // Show loading state
                registerButton.disabled = true;
                registerButton.classList.add('loading');
                buttonText.textContent = '';

                // Simulate upload progress
                fileDisplay.classList.add('uploading');
                fileIcon.className = 'fas fa-spinner fa-spin file-icon uploading';
                uploadProgress.classList.add('active');

                let progress = 0;
                const progressInterval = setInterval(() => {
                    progress += Math.random() * 30;
                    if (progress > 90) progress = 90;

                    progressFill.style.width = progress + '%';
                    progressText.textContent = Math.round(progress) + '%';

                    if (progress >= 90) {
                        clearInterval(progressInterval);

                        // Show success state
                        setTimeout(() => {
                            fileDisplay.classList.remove('uploading');
                            fileDisplay.classList.add('success');
                            fileIcon.className = 'fas fa-check-circle file-icon success';
                            uploadProgress.classList.remove('active');
                        }, 500);
                    }
                }, 200);
            });

            // Helper function to format file size
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';

                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));

                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }
        });
    </script>
</body>

</html>
