<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - MusicChart</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Color variables for consistent theming */
        :root {
            --primary-blue: #1e40af;
            --primary-purple: #7c3aed;
            --accent-green: #10b981;
            --accent-orange: #f59e0b;
            --accent-teal: #14b8a6;
        }

        /* Base body styling with gradient background */
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #000000 100%);
            background-attachment: fixed;
            color: #f8fafc;
            min-height: 100vh;
            overflow-y: auto; /* PERBAIKAN: Enable scrolling */
        }

        /* Glass morphism effect for cards */
        .glass-card {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.05);
        }

        /* Gradient text effect */
        .gradient-text {
            background: linear-gradient(135deg, #60a5fa 0%, #c084fc 50%, #f472b6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Gradient background for header */
        .gradient-bg {
            background: linear-gradient(135deg, #1e40af 0%, #7c3aed 50%, #dc2626 100%);
        }

        /* Primary button styling */
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

        /* Secondary button styling */
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

        /* Register button styling */
        .btn-register {
            background: linear-gradient(135deg, var(--accent-teal) 0%, #0d9488 100%);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(20, 184, 166, 0.4);
        }

        /* Form input field styling */
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

        /* Pulsing glow animation for visual elements */
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

        /* Floating animation for background elements */
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        /* Back button hover effect */
        .back-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .back-btn:hover {
            transform: translateX(-3px) scale(1.05);
        }

        /* Notification animation effects */
        .notification-shake {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }

        /* Spinner animation for loading states */
        .fa-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Custom pattern overlay */
        .pattern-overlay {
            background-image: url('data:image/svg+xml,%3Csvg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M0 0h20L0 20z"/%3E%3C/g%3E%3C/svg%3E');
        }

        /* Divider styling */
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #9ca3af;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4 relative">
    <!-- Background decorative elements with floating animation -->
    <div class="floating-element absolute -top-20 -left-20 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>
    <div class="floating-element absolute -bottom-20 -right-20 w-48 h-48 bg-purple-500/10 rounded-full blur-3xl" style="animation-delay: 2s;"></div>
    <div class="floating-element absolute top-1/2 left-1/4 w-32 h-32 bg-pink-500/10 rounded-full blur-3xl" style="animation-delay: 4s;"></div>

    <!-- Main login container - PERBAIKAN: Tambahkan overflow-y-auto -->
    <div class="glass-card rounded-2xl w-full max-w-md max-h-[90vh] overflow-y-auto relative z-10">
        <!-- Header section with gradient background -->
        <div class="relative p-8 text-center">
            <!-- Gradient background overlay -->
            <div class="absolute inset-0 gradient-bg opacity-90"></div>

            <!-- Subtle pattern overlay for texture -->
            <div class="absolute inset-0 opacity-10 pattern-overlay"></div>

            <!-- Back to home button -->
            <a href="{{ url('/') }}"
               class="back-btn absolute left-6 top-6 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center group transition-all duration-300 backdrop-blur-sm border border-white/10"
               aria-label="Go back to homepage">
                <i class="fas fa-arrow-left text-white text-lg group-hover:text-blue-200 transition-colors"></i>
            </a>

            <!-- Logo and title section -->
            <div class="relative z-10">
                <div class="w-20 h-20 bg-white/10 rounded-2xl flex items-center justify-center mx-auto mb-4 pulse-glow backdrop-blur-sm border border-white/10">
                    <i class="fas fa-wave-square text-3xl gradient-text"></i>
                </div>
                <h1 class="text-4xl font-black text-white mb-2">Welcome Back!</h1>
                <p class="text-blue-200 font-medium">Sign in to your MusicChart account</p>
            </div>
        </div>

        <!-- Login form section -->
        <div class="p-8">
            <form id="login-form" action="{{ route('login.submit') }}" method="POST">
                @csrf

                <!-- Email input field -->
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
                            placeholder="your.email@example.com"
                            required
                            value="{{ old('email') }}"
                            autocomplete="username"
                        >
                        <i class="fas fa-check-circle text-green-400 absolute right-4 top-4 opacity-0 transition-opacity duration-300" id="email-check"></i>
                    </div>
                </div>

                <!-- Password input field -->
                <div class="mb-6">
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
                            autocomplete="current-password"
                        >
                        <button type="button" class="absolute right-4 top-4 text-gray-400 hover:text-white transition-colors focus:outline-none" id="toggle-password" aria-label="Toggle password visibility">
                            <i class="fas fa-eye-slash" id="password-icon"></i>
                        </button>
                    </div>
                </div>

                <!-- Login button -->
                <div class="mb-6">
                    <button
                        type="submit"
                        id="login-button"
                        class="btn-primary w-full py-4 px-4 rounded-xl font-semibold transition-all duration-300 flex items-center justify-center space-x-2"
                        aria-label="Submit login credentials"
                    >
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Sign In</span>
                    </button>
                </div>

                <!-- Divider -->
                <div class="mb-6">
                    <div class="divider">OR</div>
                </div>

                <!-- Register button -->
                <div class="mb-6">
                    <a href="{{ route('register') }}"
                       class="btn-register w-full py-4 px-4 rounded-xl font-semibold text-center transition-all duration-300 flex items-center justify-center space-x-2"
                       aria-label="Create new account">
                        <i class="fas fa-user-plus"></i>
                        <span>Create New Account</span>
                    </a>
                </div>

                <!-- Alternative options -->
                <div class="flex space-x-4 mb-6">
                    <!-- Home button -->
                    <a href="{{ url('/') }}"
                       class="flex-1 btn-secondary py-4 px-4 rounded-xl font-semibold text-center transition-all duration-300 flex items-center justify-center space-x-2"
                       aria-label="Return to homepage">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>

                    <!-- Guest Access button -->
                    <a href="{{ route('user.dashboard') }}"
                       class="flex-1 btn-secondary py-4 px-4 rounded-xl font-semibold text-center transition-all duration-300 flex items-center justify-center space-x-2"
                       aria-label="Continue as guest">
                        <i class="fas fa-user-clock"></i>
                        <span>Guest</span>
                    </a>
                </div>

                <!-- Dynamic form message display -->
                <div id="form-message" class="text-center text-sm font-medium py-3 px-4 rounded-lg border hidden" role="alert" aria-live="assertive"></div>
            </form>

            <!-- Support information -->
            <div class="text-center mt-6 pt-6 border-t border-white/10">
                <p class="text-gray-400 text-sm mb-3">
                    Need assistance with your account?
                </p>
                <div class="flex flex-col space-y-2">
                    <a href="https://wa.me/6285716826379"
                       class="inline-flex items-center space-x-2 text-blue-400 hover:text-blue-300 font-semibold transition-colors duration-300 group"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Contact support via WhatsApp">
                        <i class="fas fa-headset"></i>
                        <span>Contact Support</span>
                        <i class="fas fa-external-link-alt text-xs group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center space-x-2 text-teal-400 hover:text-teal-300 font-semibold transition-colors duration-300 group"
                       aria-label="Don't have an account? Register">
                        <i class="fas fa-question-circle"></i>
                        <span>Don't have an account? Register here</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer section -->
        <div class="bg-white/5 px-8 py-4 text-center border-t border-white/10">
            <p class="text-gray-400 text-sm">
                &copy; {{ date('Y') }} <span class="gradient-text font-bold">MusicChart</span>. All rights reserved.
            </p>
            <p class="text-gray-500 text-xs mt-1">
                Forgot password? <a href="#" class="text-blue-400 hover:text-blue-300 transition-colors">Click here</a>
            </p>
        </div>
    </div>

    <!-- Interactive JavaScript functionality -->
    <script>
        // Initialize when document is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            const formMessage = document.getElementById('form-message');
            const loginForm = document.getElementById('login-form');
            const loginButton = document.getElementById('login-button');
            const togglePasswordBtn = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            const emailInput = document.getElementById('email');
            const emailCheckIcon = document.getElementById('email-check');

            // Toggle password visibility functionality
            togglePasswordBtn.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordIcon.classList.remove('fa-eye-slash');
                    passwordIcon.classList.add('fa-eye');
                    passwordIcon.classList.add('text-blue-400');
                    togglePasswordBtn.setAttribute('aria-label', 'Hide password');
                } else {
                    passwordInput.type = 'password';
                    passwordIcon.classList.remove('fa-eye');
                    passwordIcon.classList.remove('text-blue-400');
                    passwordIcon.classList.add('fa-eye-slash');
                    togglePasswordBtn.setAttribute('aria-label', 'Show password');
                }
            });

            // Real-time email validation with visual feedback
            emailInput.addEventListener('input', function() {
                const email = this.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (emailRegex.test(email)) {
                    emailCheckIcon.classList.remove('opacity-0');
                    emailCheckIcon.classList.add('opacity-100');
                } else {
                    emailCheckIcon.classList.remove('opacity-100');
                    emailCheckIcon.classList.add('opacity-0');
                }
            });

            // Add visual focus effects to input fields
            document.querySelectorAll('.input-field').forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-blue-500/20', 'rounded-xl');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-blue-500/20', 'rounded-xl');
                });
            });

            // Function to display notification messages
            function showNotification(message, type = 'error') {
                formMessage.textContent = message;
                formMessage.classList.remove('hidden');

                // Style based on notification type
                if (type === 'error') {
                    formMessage.className = 'text-center text-sm font-medium py-3 px-4 rounded-lg bg-red-500/20 border border-red-500/30 text-red-200 notification-shake';
                } else if (type === 'success') {
                    formMessage.className = 'text-center text-sm font-medium py-3 px-4 rounded-lg bg-green-500/20 border border-green-500/30 text-green-200';
                } else if (type === 'info') {
                    formMessage.className = 'text-center text-sm font-medium py-3 px-4 rounded-lg bg-blue-500/20 border border-blue-500/30 text-blue-200';
                } else if (type === 'warning') {
                    formMessage.className = 'text-center text-sm font-medium py-3 px-4 rounded-lg bg-yellow-500/20 border border-yellow-500/30 text-yellow-200';
                }

                formMessage.setAttribute('aria-live', 'assertive');

                // Auto-dismiss notification after 5 seconds
                setTimeout(() => {
                    formMessage.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                    setTimeout(() => {
                        formMessage.classList.add('hidden');
                        formMessage.classList.remove('opacity-0');
                        formMessage.setAttribute('aria-live', 'off');
                    }, 300);
                }, 5000);
            }

            // Handle server-side error messages from Laravel
            @if($errors->any())
                @if(session('error_type') == 'unregistered_email')
                    showNotification('❌ Email address not registered. Please register for an account.', 'error');
                @elseif(session('error_type') == 'wrong_password')
                    showNotification('❌ Incorrect password. Please try again.', 'error');
                @elseif(session('error_type') == 'server_error')
                    showNotification('⚠️ Server is currently experiencing issues. Please try again later.', 'error');
                @else
                    showNotification('❌ An error occurred during login. Please try again.', 'error');
                @endif
            @endif

            @if(session('success'))
                showNotification('✅ {{ session('success') }}', 'success');
            @endif

            @if(session('info'))
                showNotification('ℹ️ {{ session('info') }}', 'info');
            @endif

            // Handle form submission with client-side validation
            loginForm.addEventListener('submit', function(e) {
                const email = emailInput.value.trim();
                const password = passwordInput.value.trim();

                // Basic client-side validation
                if (!email || !password) {
                    e.preventDefault();
                    showNotification('❌ Please fill in all required fields!', 'error');
                    return;
                }

                // Validate email format
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    e.preventDefault();
                    showNotification('❌ Please enter a valid email address!', 'error');
                    return;
                }

                // Show loading state on button
                loginButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Signing In...</span>';
                loginButton.disabled = true;
                loginButton.setAttribute('aria-label', 'Processing login request');

                // Add slight delay to show loading state
                setTimeout(() => {
                    loginButton.innerHTML = '<i class="fas fa-sign-in-alt"></i><span>Sign In</span>';
                    loginButton.disabled = false;
                    loginButton.setAttribute('aria-label', 'Submit login credentials');
                }, 2000);
            });

            // Add Enter key submission support
            loginForm.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    loginForm.dispatchEvent(new Event('submit'));
                }
            });

            // Focus on email field on page load for better UX
            emailInput.focus();

            // Add animation to register button on hover
            const registerBtn = document.querySelector('.btn-register');
            if (registerBtn) {
                registerBtn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px) scale(1.02)';
                });

                registerBtn.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            }
        });
    </script>
</body>
</html>
