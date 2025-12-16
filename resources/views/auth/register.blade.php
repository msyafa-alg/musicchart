<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MusicChart</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-blue: #1e40af;
            --primary-purple: #7c3aed;
            --accent-green: #10b981;
            --accent-orange: #f59e0b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #000000 100%);
            background-attachment: fixed;
            color: #f8fafc;
            min-height: 100vh;
            overflow-x: hidden; /* Tambahkan ini */
        }

        .glass-card {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.05);
        }

        .gradient-text {
            background: linear-gradient(135deg, #60a5fa 0%, #c084fc 50%, #f472b6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1e40af 0%, #7c3aed 50%, #dc2626 100%);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-green) 0%, #059669 100%);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .input-field {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: white;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            width: 100%;
        }

        .input-field:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
            outline: none;
        }

        .input-field::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        /* FIX: Membuat form container bisa di-scroll */
        .form-container {
            max-height: 70vh; /* Batasi tinggi maksimal */
            overflow-y: auto; /* Aktifkan scroll vertikal */
            padding-right: 10px; /* Ruang untuk scrollbar */
        }

        /* Styling scrollbar */
        .form-container::-webkit-scrollbar {
            width: 8px;
        }

        .form-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 4px;
        }

        .form-container::-webkit-scrollbar-thumb {
            background: rgba(96, 165, 250, 0.5);
            border-radius: 4px;
        }

        .form-container::-webkit-scrollbar-thumb:hover {
            background: rgba(96, 165, 250, 0.7);
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }

        @keyframes pulse-glow {
            from { box-shadow: 0 0 20px rgba(96, 165, 250, 0.3); }
            to { box-shadow: 0 0 30px rgba(192, 132, 252, 0.4); }
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        .back-btn:hover {
            transform: translateX(-3px) scale(1.05);
        }

        .notification-shake {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }

        .terms-link {
            color: #60a5fa;
            text-decoration: underline;
            cursor: pointer;
        }

        .terms-link:hover {
            color: #93c5fd;
        }

        /* FIX: Pastikan checkbox terlihat */
        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #3b82f6;
        }

        /* FIX: Spacing yang lebih baik untuk form */
        .form-group {
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4 relative overflow-hidden">
    <!-- Background elements -->
    <div class="floating-element absolute -top-20 -left-20 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>
    <div class="floating-element absolute -bottom-20 -right-20 w-48 h-48 bg-purple-500/10 rounded-full blur-3xl" style="animation-delay: 2s;"></div>
    <div class="floating-element absolute top-1/2 left-1/4 w-32 h-32 bg-green-500/10 rounded-full blur-3xl" style="animation-delay: 4s;"></div>

    <!-- Main register container -->
    <div class="glass-card rounded-2xl w-full max-w-md overflow-hidden relative z-10">
        <!-- Header section -->
        <div class="relative p-8 text-center overflow-hidden">
            <div class="absolute inset-0 gradient-bg opacity-90"></div>

            <!-- Back to home button -->
            <a href="{{ url('/') }}"
               class="back-btn absolute left-6 top-6 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center group transition-all duration-300 backdrop-blur-sm border border-white/10"
               aria-label="Kembali ke homepage">
                <i class="fas fa-arrow-left text-white text-lg group-hover:text-blue-200"></i>
            </a>

            <!-- Logo and title -->
            <div class="relative z-10">
                <div class="w-20 h-20 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4 pulse-glow backdrop-blur-sm border border-white/10">
                    <i class="fas fa-user-plus text-3xl gradient-text"></i>
                </div>
                <h1 class="text-4xl font-black text-white mb-2">Buat Akun Baru</h1>
                <p class="text-blue-200 font-medium">Bergabunglah dengan komunitas MusicChart</p>
            </div>
        </div>

        <!-- Register form section - FIX: Tambahkan container untuk scroll -->
        <div class="p-8 form-container">
            <form id="register-form" action="{{ route('register.submit') }}" method="POST">
                @csrf

                <!-- Username -->
                <div class="form-group">
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="username">
                        <i class="fas fa-user text-blue-400 mr-2"></i>Username
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="input-field px-4 py-3 text-white placeholder-gray-500"
                            placeholder="Pilih username unik"
                            required
                            value="{{ old('username') }}"
                            autocomplete="username"
                        >
                        <i class="fas fa-check-circle text-green-400 absolute right-4 top-3.5 opacity-0 transition-opacity" id="username-check"></i>
                    </div>
                    @error('username')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="email">
                        <i class="fas fa-envelope text-blue-400 mr-2"></i>Email
                    </label>
                    <div class="relative">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="input-field px-4 py-3 text-white placeholder-gray-500"
                            placeholder="email@contoh.com"
                            required
                            value="{{ old('email') }}"
                            autocomplete="email"
                        >
                        <i class="fas fa-check-circle text-green-400 absolute right-4 top-3.5 opacity-0" id="email-check"></i>
                    </div>
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="password">
                        <i class="fas fa-lock text-blue-400 mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="input-field px-4 py-3 text-white placeholder-gray-500 pr-12"
                            placeholder="Minimal 8 karakter"
                            required
                            autocomplete="new-password"
                        >
                        <button type="button" class="absolute right-4 top-3 text-gray-400 hover:text-white" id="toggle-password">
                            <i class="fas fa-eye-slash" id="password-icon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="password_confirmation">
                        <i class="fas fa-lock text-blue-400 mr-2"></i>Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="input-field px-4 py-3 text-white placeholder-gray-500 pr-12"
                            placeholder="Ketik ulang password"
                            required
                            autocomplete="new-password"
                        >
                        <button type="button" class="absolute right-4 top-3 text-gray-400 hover:text-white" id="toggle-confirm-password">
                            <i class="fas fa-eye-slash" id="confirm-password-icon"></i>
                        </button>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="form-group">
                    <div class="flex items-start">
                        <input
                            type="checkbox"
                            id="terms"
                            name="terms"
                            class="mt-1 mr-3"
                            required
                        >
                        <label for="terms" class="text-gray-300 text-sm">
                            Saya setuju dengan
                            <a href="#" class="terms-link" onclick="showTerms()">Syarat dan Ketentuan</a>
                            serta
                            <a href="#" class="terms-link" onclick="showPrivacy()">Kebijakan Privasi</a>
                        </label>
                    </div>
                    @error('terms')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bonus Points Info -->
                <div class="form-group bg-blue-500/10 border border-blue-500/30 rounded-xl p-4">
                    <div class="flex items-center">
                        <i class="fas fa-gift text-blue-400 text-xl mr-3"></i>
                        <div>
                            <h4 class="font-bold text-blue-300 text-sm">🎉 BONUS PENDAFTARAN!</h4>
                            <p class="text-blue-200 text-sm mt-1">Dapatkan <span class="font-bold">1000 poin gratis</span> untuk donasi kepada artis favorit Anda!</p>
                        </div>
                    </div>
                </div>

                <!-- Action buttons -->
                <div class="form-group">
                    <div class="flex space-x-4">
                        <!-- Login button -->
                        <a href="{{ route('login') }}"
                           class="flex-1 btn-secondary py-3 px-4 rounded-xl font-semibold text-center transition-all duration-300 flex items-center justify-center space-x-2">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Login</span>
                        </a>

                        <!-- Register submit button -->
                        <button
                            type="submit"
                            id="register-button"
                            class="flex-1 btn-primary py-3 px-4 rounded-xl font-semibold transition-all duration-300 flex items-center justify-center space-x-2">
                            <i class="fas fa-user-plus"></i>
                            <span>Daftar</span>
                        </button>
                    </div>
                </div>

                <!-- Form message display -->
                <div id="form-message" class="text-center text-sm font-medium py-3 px-4 rounded-lg border hidden"></div>
            </form>

            <!-- Login link -->
            <div class="text-center mt-6 pt-6 border-t border-white/10">
                <p class="text-gray-400 text-sm">Sudah punya akun?</p>
                <a href="{{ route('login') }}"
                   class="inline-flex items-center space-x-2 text-blue-400 hover:text-blue-300 font-semibold transition-colors duration-300 mt-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login di sini</span>
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-white/5 px-8 py-4 text-center border-t border-white/10">
            <p class="text-gray-400 text-sm">
                &copy; {{ date('Y') }} <span class="gradient-text font-bold">MusicChart</span>. All rights reserved.
            </p>
        </div>
    </div>

    <!-- Terms Modal -->
    <div id="termsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="glass-card rounded-2xl p-8 max-w-2xl w-full max-h-[80vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-black text-white">Syarat dan Ketentuan</h3>
                <button onclick="closeTerms()" class="text-gray-400 hover:text-white">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <div class="text-gray-300 space-y-4">
                <p>Dengan mendaftar di MusicChart, Anda menyetujui:</p>
                <ul class="list-disc pl-5 space-y-2">
                    <li>Akun Anda adalah milik pribadi dan tidak boleh dibagikan</li>
                    <li>Poin yang diberikan dapat digunakan untuk donasi kepada artis</li>
                    <li>Kami berhak menonaktifkan akun yang melanggar aturan</li>
                    <li>Data pribadi Anda akan dilindungi sesuai kebijakan privasi</li>
                </ul>
                <button onclick="closeTerms()" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl font-semibold mt-6">
                    Saya Mengerti
                </button>
            </div>
        </div>
    </div>

    <!-- Privacy Modal -->
    <div id="privacyModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="glass-card rounded-2xl p-8 max-w-2xl w-full max-h-[80vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-black text-white">Kebijakan Privasi</h3>
                <button onclick="closePrivacy()" class="text-gray-400 hover:text-white">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <div class="text-gray-300 space-y-4">
                <p>Kami menghargai privasi Anda:</p>
                <ul class="list-disc pl-5 space-y-2">
                    <li>Email hanya digunakan untuk keperluan autentikasi</li>
                    <li>Username akan ditampilkan secara publik di donasi</li>
                    <li>Poin dan aktivitas donasi bersifat pribadi</li>
                    <li>Kami tidak membagikan data Anda ke pihak ketiga</li>
                </ul>
                <button onclick="closePrivacy()" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl font-semibold mt-6">
                    Saya Mengerti
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const formMessage = document.getElementById('form-message');
            const registerForm = document.getElementById('register-form');
            const registerButton = document.getElementById('register-button');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');

            // Toggle password visibility
            document.getElementById('toggle-password').addEventListener('click', function() {
                const icon = document.getElementById('password-icon');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });

            // Toggle confirm password visibility
            document.getElementById('toggle-confirm-password').addEventListener('click', function() {
                const icon = document.getElementById('confirm-password-icon');
                if (confirmPasswordInput.type === 'password') {
                    confirmPasswordInput.type = 'text';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    confirmPasswordInput.type = 'password';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });

            // Form submission
            registerForm.addEventListener('submit', function(e) {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (password !== confirmPassword) {
                    e.preventDefault();
                    showNotification('❌ Password dan konfirmasi password tidak cocok!', 'error');
                    return;
                }

                if (password.length < 8) {
                    e.preventDefault();
                    showNotification('❌ Password harus minimal 8 karakter!', 'error');
                    return;
                }

                // Loading state
                registerButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Mendaftarkan...</span>';
                registerButton.disabled = true;
            });

            function showNotification(message, type = 'error') {
                formMessage.textContent = message;
                formMessage.classList.remove('hidden');
                formMessage.className = 'text-center text-sm font-medium py-3 px-4 rounded-lg ' +
                    (type === 'error' ? 'bg-red-500/20 border border-red-500/30 text-red-200 notification-shake' :
                     'bg-green-500/20 border border-green-500/30 text-green-200');

                setTimeout(() => {
                    formMessage.classList.add('hidden');
                }, 5000);
            }

            // Modal functions
            window.showTerms = function() {
                document.getElementById('termsModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            };

            window.closeTerms = function() {
                document.getElementById('termsModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            };

            window.showPrivacy = function() {
                document.getElementById('privacyModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            };

            window.closePrivacy = function() {
                document.getElementById('privacyModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            };

            // Display server-side errors
            @if($errors->any())
                const firstError = document.querySelector('.text-red-400');
                if (firstError) {
                    showNotification('❌ ' + firstError.textContent, 'error');
                }
            @endif
        });
    </script>
</body>
</html>
