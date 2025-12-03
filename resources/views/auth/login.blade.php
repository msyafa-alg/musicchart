<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - MusicChart</title>

    <!-- Tailwind & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite alternate;
        }

        @keyframes pulse-glow {
            from {
                box-shadow: 0 0 20px rgba(96, 165, 250, 0.3);
            }
            to {
                box-shadow: 0 0 30px rgba(192, 132, 252, 0.4);
            }
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        .back-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .back-btn:hover {
            transform: translateX(-3px) scale(1.05);
        }

        /* Notification Styles */
        .notification-shake {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }

        .fa-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4 relative overflow-hidden">
    <!-- Background Floating Elements -->
    <div class="floating-element absolute -top-20 -left-20 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>
    <div class="floating-element absolute -bottom-20 -right-20 w-48 h-48 bg-purple-500/10 rounded-full blur-3xl" style="animation-delay: 2s;"></div>
    <div class="floating-element absolute top-1/2 left-1/4 w-32 h-32 bg-pink-500/10 rounded-full blur-3xl" style="animation-delay: 4s;"></div>

    <div class="glass-card rounded-2xl w-full max-w-md overflow-hidden relative z-10">
        <!-- Header -->
        <div class="relative p-8 text-center overflow-hidden">
            <!-- Gradient Background -->
            <div class="absolute inset-0 gradient-bg opacity-90"></div>

            <!-- Pattern Overlay -->
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\"20\" height=\"20\" viewBox=\"0 0 20 20\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.1\"%3E%3Cpath d=\"M0 0h20L0 20z\"/%3E%3C/g%3E%3C/svg%3E');"></div>

            <!-- Back Button -->
            <a href="{{ url('/') }}"
               class="back-btn absolute left-6 top-6 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center group transition-all duration-300 backdrop-blur-sm border border-white/10">
                <i class="fas fa-arrow-left text-white text-lg group-hover:text-blue-200 transition-colors"></i>
            </a>

            <!-- Logo -->
            <div class="relative z-10">
                <div class="w-20 h-20 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4 pulse-glow backdrop-blur-sm border border-white/10">
                    <i class="fas fa-wave-square text-3xl gradient-text"></i>
                </div>
                <h1 class="text-4xl font-black text-white mb-2">LOGIN PAGE</h1>
                <p class="text-blue-200 font-medium">Welcome back to MusicChart</p>
            </div>
        </div>

        <!-- Login Form -->
        <div class="p-8">
            <form id="login-form" action="{{ route('login.submit') }}" method="POST">
                @csrf

                <!-- Email Input -->
                <div class="mb-6">
                    <label class="block text-gray-300 text-sm font-semibold mb-3 uppercase tracking-wide" for="email">
                        <i class="fas fa-envelope text-blue-400 mr-2"></i>Email Address
                    </label>
                    <div class="relative">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="input-field w-full px-4 py-4 text-white placeholder-gray-500"
                            placeholder="admin@musicchart.com"
                            required
                            value="{{ old('email') }}"
                        >
                        <i class="fas fa-check-circle text-green-400 absolute right-4 top-4 opacity-0 transition-opacity duration-300" id="email-check"></i>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="mb-8">
                    <label class="block text-gray-300 text-sm font-semibold mb-3 uppercase tracking-wide" for="password">
                        <i class="fas fa-lock text-blue-400 mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="input-field w-full px-4 py-4 text-white placeholder-gray-500 pr-12"
                            placeholder="Enter your password"
                            required
                        >
                        <i class="fas fa-eye-slash text-gray-400 absolute right-4 top-4 cursor-pointer hover:text-white transition-colors" id="toggle-password"></i>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex space-x-4 mb-6">
                    <!-- Back to Home Button -->
                    <a href="{{ url('/') }}"
                       class="flex-1 btn-secondary py-4 px-4 rounded-xl font-semibold text-center transition-all duration-300 flex items-center justify-center space-x-2">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>

                    <!-- Login Button -->
                    <button
                        type="submit"
                        id="login-button"
                        class="flex-1 btn-primary py-4 px-4 rounded-xl font-semibold transition-all duration-300 flex items-center justify-center space-x-2"
                    >
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                    </button>
                </div>

                <!-- Error / Success Message -->
                <div id="form-message" class="text-center text-sm font-medium py-3 px-4 rounded-lg bg-white/5 border border-white/10 hidden"></div>
            </form>

            <!-- Admin Contact -->
            <div class="text-center mt-6 pt-6 border-t border-white/10">
                <p class="text-gray-400 text-sm mb-3">
                    Not a Register?
                </p>
                <a href="https://wa.me/6285716826379"
                   class="inline-flex items-center space-x-2 text-blue-400 hover:text-blue-300 font-semibold transition-colors duration-300 group">
                    <i class="fas fa-headset"></i>
                    <span>Contact Support</span>
                    <i class="fas fa-external-link-alt text-xs group-hover:translate-x-1 transition-transform"></i>
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

    <!-- JavaScript for interactivity -->
    <script>
        // Toggle password visibility
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this;

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
                icon.classList.add('text-blue-400');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.remove('text-blue-400');
                icon.classList.add('fa-eye-slash');
            }
        });

        // Email validation check
        document.getElementById('email').addEventListener('input', function() {
            const emailCheck = document.getElementById('email-check');
            const email = this.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (emailRegex.test(email)) {
                emailCheck.classList.remove('opacity-0');
                emailCheck.classList.add('opacity-100');
            } else {
                emailCheck.classList.remove('opacity-100');
                emailCheck.classList.add('opacity-0');
            }
        });

        // Add input focus effects
        document.querySelectorAll('.input-field').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-500/20', 'rounded-xl');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-blue-500/20', 'rounded-xl');
            });
        });

        // Handle login errors and show notifications
        document.addEventListener('DOMContentLoaded', function() {
            const formMessage = document.getElementById('form-message');

            // Check if there are error messages from server
            @if($errors->any())
                @if(session('error_type') == 'unregistered_email')
                    showNotification('❌ Email tidak terdaftar! Silakan hubungi admin untuk membuat akun.', 'error');
                @elseif(session('error_type') == 'wrong_password')
                    showNotification('❌ Password yang Anda masukkan salah!', 'error');
                @elseif(session('error_type') == 'server_error')
                    showNotification('⚠️ Server sedang mengalami masalah. Silakan coba lagi nanti.', 'error');
                @else
                    showNotification('❌ Terjadi kesalahan saat login. Silakan coba lagi.', 'error');
                @endif
            @endif

            function showNotification(message, type = 'error') {
                formMessage.innerHTML = message;
                formMessage.classList.remove('hidden');

                // Set styles based on type
                if (type === 'error') {
                    formMessage.className = 'text-center text-sm font-medium py-3 px-4 rounded-lg bg-red-500/20 border border-red-500/30 text-red-200 notification-shake';
                } else {
                    formMessage.className = 'text-center text-sm font-medium py-3 px-4 rounded-lg bg-green-500/20 border border-green-500/30 text-green-200';
                }

                // Auto hide after 5 seconds
                setTimeout(() => {
                    formMessage.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                    setTimeout(() => {
                        formMessage.classList.add('hidden');
                        formMessage.classList.remove('opacity-0');
                    }, 300);
                }, 5000);
            }

            // Form submission animation
            const loginForm = document.getElementById('login-form');
            const loginButton = document.getElementById('login-button');

            loginForm.addEventListener('submit', function(e) {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                // Basic client-side validation
                if (!email || !password) {
                    e.preventDefault();
                    showNotification('❌ Harap isi semua field yang diperlukan!', 'error');
                    return;
                }

                // Show loading state
                loginButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Memproses...</span>';
                loginButton.disabled = true;
            });
        });
    </script>
</body>
</html>
