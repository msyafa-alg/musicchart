<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MusicChart</title>

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

        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-green), var(--primary-purple));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            background: rgba(30, 41, 59, 0.9);
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.05);
        }

        .quick-action-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .quick-action-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(96, 165, 250, 0.1) 0%, rgba(192, 132, 252, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .quick-action-card:hover::before {
            opacity: 1;
        }

        .quick-action-card:hover {
            transform: translateY(-6px) scale(1.02);
            border-color: rgba(96, 165, 250, 0.3);
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
    </style>
</head>

<body class="min-h-screen antialiased">
    <!-- Navigation -->
    <nav class="glass-nav sticky top-0 z-50 py-4">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center pulse-glow">
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
                       class="nav-link active flex items-center space-x-2">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       class="nav-link flex items-center space-x-2">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>

                    <a href="{{ route('artists.index') }}"
                       class="nav-link flex items-center space-x-2">
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
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Welcome Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-black text-white mb-2">
                Welcome back, <span class="gradient-text">Admin</span>!
            </h1>
            <p class="text-gray-400 text-lg">
                Here's what's happening with your music platform today.
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
            <div class="glass-card stat-card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm font-semibold uppercase tracking-wide">Total Users</p>
                        <p class="text-3xl font-black text-white mt-2">{{ $stats['total_users'] }}</p>
                        <div class="flex items-center mt-2">
                            <i class="fas fa-arrow-up text-green-400 text-sm mr-1"></i>
                            <span class="text-green-400 text-sm font-medium">Active</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-blue-400 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Songs -->
            <div class="glass-card stat-card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm font-semibold uppercase tracking-wide">Total Songs</p>
                        <p class="text-3xl font-black text-white mt-2">{{ $stats['total_songs'] }}</p>
                        <div class="flex items-center mt-2">
                            <i class="fas fa-music text-gray-400 text-sm mr-1"></i>
                            <span class="text-gray-400 text-sm font-medium">Tracks</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-music text-green-400 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Artists -->
            <div class="glass-card stat-card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm font-semibold uppercase tracking-wide">Total Artists</p>
                        <p class="text-3xl font-black text-white mt-2">{{ $stats['total_artists'] }}</p>
                        <div class="flex items-center mt-2">
                            <i class="fas fa-star text-yellow-400 text-sm mr-1"></i>
                            <span class="text-yellow-400 text-sm font-medium">Featured</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-purple-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-alt text-purple-400 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Albums -->
            <div class="glass-card stat-card p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm font-semibold uppercase tracking-wide">Total Albums</p>
                        <p class="text-3xl font-black text-white mt-2">{{ $stats['total_albums'] }}</p>
                        <div class="flex items-center mt-2">
                            <i class="fas fa-compact-disc text-orange-400 text-sm mr-1"></i>
                            <span class="text-orange-400 text-sm font-medium">Releases</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-orange-500/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-compact-disc text-orange-400 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="glass-card p-8">
            <h2 class="text-2xl font-black text-white mb-6 flex items-center">
                <i class="fas fa-bolt text-yellow-400 mr-3"></i>
                Quick Actions
            </h2>

            <div class="grid grid-cols-1 md:grid-cold-3 gap-6">
                <!-- Manage Users -->
                <a href="{{ route('admin.users.index') }}"
                class="quick-action-card glass-card p-6 text-center border border-white/10 rounded-xl transition-all duration-300 group">
                    <div class="w-16 h-16 bg-red-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-red-500/30 transition-colors">
                        <i class="fas fa-users text-red-400 text-2xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h3 class="font-bold text-white text-lg mb-2">Manage Users</h3>
                    <p class="text-gray-400 text-sm">Topup points and manage user accounts</p>
                    <div class="mt-4 flex justify-center">
                        <span class="text-red-400 text-sm font-semibold flex items-center">
                            Manage Users <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Manage Artists -->
                <a href="{{ route('artists.index') }}"
                   class="quick-action-card glass-card p-6 text-center border border-white/10 rounded-xl transition-all duration-300 group">
                    <div class="w-16 h-16 bg-blue-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-500/30 transition-colors">
                        <i class="fas fa-user-alt text-blue-400 text-2xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h3 class="font-bold text-white text-lg mb-2">Manage Artists</h3>
                    <p class="text-gray-400 text-sm">Add, edit, and manage music artists</p>
                    <div class="mt-4 flex justify-center">
                        <span class="text-blue-400 text-sm font-semibold flex items-center">
                            Explore <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>

                <!-- Manage Albums -->
                <a href="{{ route('albums.index') }}"
                   class="quick-action-card glass-card p-6 text-center border border-white/10 rounded-xl transition-all duration-300 group">
                    <div class="w-16 h-16 bg-green-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-green-500/30 transition-colors">
                        <i class="fas fa-compact-disc text-green-400 text-2xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h3 class="font-bold text-white text-lg mb-2">Manage Albums</h3>
                    <p class="text-gray-400 text-sm">Handle album releases and metadata</p>
                    <div class="mt-4 flex justify-center">
                        <span class="text-green-400 text-sm font-semibold flex items-center">
                            Explore <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>

                <!-- Manage Songs -->
                <a href="{{ route('songs.index') }}"
                   class="quick-action-card glass-card p-6 text-center border border-white/10 rounded-xl transition-all duration-300 group">
                    <div class="w-16 h-16 bg-purple-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-500/30 transition-colors">
                        <i class="fas fa-music text-purple-400 text-2xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <h3 class="font-bold text-white text-lg mb-2">Manage Songs</h3>
                    <p class="text-gray-400 text-sm">Organize tracks and song details</p>
                    <div class="mt-4 flex justify-center">
                        <span class="text-purple-400 text-sm font-semibold flex items-center">
                            Explore <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
            <!-- Recent Updates -->
            <div class="glass-card p-6">
                <h3 class="text-xl font-black text-white mb-4 flex items-center">
                    <i class="fas fa-history text-blue-400 mr-2"></i>
                    Recent Activity
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 p-3 rounded-lg bg-white/5">
                        <div class="w-8 h-8 bg-green-500/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-plus text-green-400 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-white text-sm font-medium">New album added</p>
                            <p class="text-gray-400 text-xs">2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-3 rounded-lg bg-white/5">
                        <div class="w-8 h-8 bg-blue-500/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-edit text-blue-400 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-white text-sm font-medium">Artist profile updated</p>
                            <p class="text-gray-400 text-xs">5 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="glass-card p-6">
                <h3 class="text-xl font-black text-white mb-4 flex items-center">
                    <i class="fas fa-server text-green-400 mr-2"></i>
                    System Status
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Database</span>
                        <span class="text-green-400 font-semibold flex items-center">
                            <i class="fas fa-circle text-xs mr-1"></i> Online
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Storage</span>
                        <span class="text-blue-400 font-semibold">78% Used</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">API</span>
                        <span class="text-green-400 font-semibold flex items-center">
                            <i class="fas fa-circle text-xs mr-1"></i> Active
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t border-white/10 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} <span class="gradient-text font-bold">MusicChart</span>. Admin Dashboard v1.0
            </p>
        </div>
    </footer>
</body>
</html>
