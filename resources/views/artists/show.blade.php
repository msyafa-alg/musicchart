<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $artist->name }} - MusicChart Admin</title>

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
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            background-attachment: fixed;
            color: #f8fafc;
            min-height: 100vh;
        }

        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
        }

        .glass-nav {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .gradient-text {
            background: linear-gradient(135deg, #60a5fa 0%, #c084fc 50%, #f472b6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
        }

        .btn-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-blue:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        }

        .nav-link {
            position: relative;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #1e40af 0%, #7c3aed 100%);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .info-card {
            background: rgba(30, 41, 59, 0.5);
            border-radius: 12px;
            padding: 16px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .info-label {
            color: #94a3b8;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .info-value {
            color: #f8fafc;
            font-size: 1rem;
            font-weight: 600;
        }
    </style>
</head>

<body class="min-h-screen antialiased">
    <!-- Navigation -->
    <nav class="glass-nav sticky top-0 z-50 py-4">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-wave-square text-white"></i>
                    </div>
                    <div>
                        <span class="text-2xl font-black gradient-text tracking-tight">MusicChart</span>
                        <span class="text-blue-300 text-sm font-medium ml-2">Admin</span>
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link flex items-center space-x-2">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('artists.index') }}"
                       class="nav-link active flex items-center space-x-2">
                        <i class="fas fa-user-alt"></i>
                        <span>Artists</span>
                    </a>

                    <a href="{{ route('albums.index') }}"
                       class="nav-link flex items-center space-x-2">
                        <i class="fas fa-compact-disc"></i>
                        <span>Albums</span>
                    </a>

                    <a href="{{ route('songs.index') }}"
                       class="nav-link flex items-center space-x-2">
                        <i class="fas fa-music"></i>
                        <span>Songs</span>
                    </a>

                    <!-- Logout -->
                    <form action="{{ route('logout') }}" method="POST" class="ml-4">
                        @csrf
                        <button type="submit"
                                class="btn-secondary px-4 py-2 flex items-center space-x-2 transition-all duration-300">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-6 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-black text-white mb-2">
                    <span class="gradient-text">{{ $artist->name }}</span>
                </h1>
                <p class="text-gray-400">Artist Details</p>
            </div>

            <div class="flex space-x-3">
                <a href="{{ route('artists.edit', $artist) }}"
                   class="btn-primary px-6 py-3 flex items-center space-x-2 transition-all duration-300">
                    <i class="fas fa-edit"></i>
                    <span>Edit Artist</span>
                </a>
                <a href="{{ route('artists.index') }}"
                   class="btn-secondary px-6 py-3 flex items-center space-x-2 transition-all duration-300">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Artists</span>
                </a>
            </div>
        </div>

        <!-- Artist Details Card -->
        <div class="glass-card rounded-2xl p-8 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Photo Section -->
                <div class="md:col-span-1">
                    <div class="bg-gradient-to-br from-purple-600 to-blue-700 rounded-2xl h-80 flex items-center justify-center shadow-2xl">
                        @if($artist->photo && file_exists(public_path('storage/' . $artist->photo)))
                            <img src="{{ asset('storage/' . $artist->photo) }}"
                                 alt="{{ $artist->name }}"
                                 class="w-full h-full object-cover rounded-2xl">
                        @else
                            <i class="fas fa-user text-white text-8xl"></i>
                        @endif
                    </div>
                </div>

                <!-- Info Section -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Name -->
                    <div class="info-card">
                        <div class="info-label">Artist Name</div>
                        <div class="info-value text-2xl">{{ $artist->name }}</div>
                    </div>

                    <!-- Biography -->
                    <div class="info-card">
                        <div class="info-label">Biography</div>
                        <div class="info-value text-gray-300 whitespace-pre-line mt-2 leading-relaxed">
                            {{ $artist->bio ?? 'No biography available' }}
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Created At -->
                        <div class="info-card">
                            <div class="info-label">Created At</div>
                            <div class="info-value">
                                <i class="fas fa-calendar-plus text-blue-400 mr-2"></i>
                                {{ $artist->created_at->format('d M Y, H:i') }}
                            </div>
                        </div>

                        <!-- Last Updated -->
                        <div class="info-card">
                            <div class="info-label">Last Updated</div>
                            <div class="info-value">
                                <i class="fas fa-calendar-check text-green-400 mr-2"></i>
                                {{ $artist->updated_at->format('d M Y, H:i') }}
                            </div>
                        </div>
                    </div>

                    <!-- Total Donations -->
                    <div class="info-card bg-gradient-to-r from-purple-900/30 to-blue-900/30 border-purple-500/20">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="info-label">Total Donations</div>
                                <div class="info-value text-3xl text-yellow-300">
                                    {{ $artist->total_donations ?? 0 }}
                                    <span class="text-lg text-yellow-200">points</span>
                                </div>
                            </div>
                            <div class="w-12 h-12 bg-yellow-500/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-trophy text-yellow-400 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donation Section -->
        @auth
        <div class="glass-card rounded-2xl p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-600 rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-heart text-white"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">Support This Artist</h3>
                    <p class="text-gray-400">Donate points to support your favorite artist</p>
                </div>
            </div>

            <div class="mb-6 info-card bg-gradient-to-r from-emerald-900/30 to-teal-900/30 border-emerald-500/20">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-coins text-yellow-400 text-xl mr-3"></i>
                        <div>
                            <div class="info-label">Your Available Points</div>
                            <div class="info-value text-2xl text-emerald-300">{{ auth()->user()->points }}</div>
                        </div>
                    </div>
                    <div class="text-emerald-400">
                        <i class="fas fa-wallet text-2xl"></i>
                    </div>
                </div>
            </div>

            <form action="{{ route('donations.store', $artist) }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-2">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-gift text-gray-400"></i>
                            </div>
                            <input type="number"
                                   name="amount"
                                   min="1"
                                   max="{{ auth()->user()->points }}"
                                   placeholder="Enter amount of points to donate"
                                   class="w-full bg-gray-900/50 border border-gray-700 text-white pl-10 pr-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition"
                                   required>
                        </div>
                    </div>
                    <div>
                        <button type="submit"
                                class="w-full btn-primary py-3 flex items-center justify-center space-x-2">
                            <i class="fas fa-heart"></i>
                            <span>Donate Now</span>
                        </button>
                    </div>
                </div>
            </form>

            @if(session('success'))
                <div class="mt-6 info-card bg-gradient-to-r from-emerald-900/30 to-green-900/30 border-emerald-500/30">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-emerald-500/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-emerald-400"></i>
                        </div>
                        <p class="text-emerald-400 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mt-6 info-card bg-gradient-to-r from-rose-900/30 to-red-900/30 border-rose-500/30">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-rose-500/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-exclamation-circle text-rose-400"></i>
                        </div>
                        <p class="text-rose-400 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            @endif
        </div>
        @endauth

        @guest
        <div class="glass-card rounded-2xl p-8 text-center">
            <div class="max-w-md mx-auto">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-lock text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Login Required</h3>
                <p class="text-gray-400 mb-6">Please login to donate points and support artists</p>
                <a href="{{ route('admin.login') }}"
                   class="btn-blue px-6 py-3 inline-flex items-center space-x-2 transition-all duration-300">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login to Account</span>
                </a>
            </div>
        </div>
        @endguest
    </div>
</body>
</html>
