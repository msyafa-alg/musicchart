<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - MusicChart</title>

    <!-- Tailwind & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

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

        .popularity-bar {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
            height: 6px;
        }

        .popularity-fill {
            height: 100%;
            background: linear-gradient(90deg, #f59e0b 0%, #ef4444 100%);
            border-radius: 10px;
            transition: width 1s ease-in-out;
        }

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }

        .rank-badge {
            position: absolute;
            top: -12px;
            left: -12px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 16px;
            color: white;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.4);
            z-index: 10;
            transition: all 0.3s ease;
        }

        .rank-badge:hover {
            transform: scale(1.1);
        }

        .album-cover {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4);
        }

        .album-cover::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.3) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .glass-card:hover .album-cover::after {
            opacity: 1;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.8) 0%, rgba(15, 23, 42, 0.6) 100%);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.9) 0%, rgba(15, 23, 42, 0.7) 100%);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        /* DataTables Custom Styling */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            color: #9ca3af !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #9ca3af !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            background: rgba(30, 41, 59, 0.7) !important;
            border-radius: 8px !important;
            margin: 0 2px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: rgba(59, 130, 246, 0.5) !important;
            border-color: rgba(59, 130, 246, 0.5) !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            color: white !important;
            border: none !important;
        }

        #albumsTable tbody tr:hover {
            background: rgba(55, 65, 81, 0.5) !important;
        }
    </style>
</head>

<body class="min-h-screen antialiased">
    <!-- Background Floating Elements -->
    <div class="floating-element absolute -top-20 -left-20 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>
    <div class="floating-element absolute -bottom-20 -right-20 w-48 h-48 bg-purple-500/10 rounded-full blur-3xl" style="animation-delay: 2s;"></div>

    <!-- Navigation -->
    <nav class="glass-nav sticky top-0 z-50 py-4">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-wave-square text-white"></i>
                    </div>
                    <span class="text-2xl font-black gradient-text tracking-tight">MusicChart</span>
                </div>

                <!-- User Info & Logout -->
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <span class="text-blue-200 font-medium">Hello, {{ $user->username }}! 👋</span>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-secondary px-4 py-2 flex items-center space-x-2 transition-all duration-300">
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
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mb-8 bg-green-500/20 border border-green-500/30 rounded-xl p-4 text-green-300">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3 text-green-400"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 bg-red-500/20 border border-red-500/30 rounded-xl p-4 text-red-300">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3 text-red-400"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Welcome Section -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-black text-white mb-4">
                Welcome to <span class="gradient-text">MusicChart</span>
            </h1>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                Discover trending music, explore top charts, and find your next favorite song
            </p>
        </div>

<!-- Top Albums Section (New Version) -->
<section class="py-16 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-black mb-4">
                <span class="gradient-text">Top Albums</span> Chart
            </h2>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                Ranked by popularity score, streaming data, and fan engagement metrics
            </p>
        </div>

        <!-- DEBUG SECTION (temporary) -->
<div class="fixed bottom-4 right-4 bg-red-500 text-white p-4 rounded-lg z-50 text-xs">
    Top Albums Count: {{ $topAlbums->count() }}<br>
    Total Songs: {{ $totalSongs }}<br>
    Total Artists: {{ $totalArtists }}<br>
    Top Artists Count: {{ $topArtists->count() }}<br>
    User: {{ $user->name ?? 'No user' }}
</div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($topAlbums as $index => $album)
            <div class="glass-card rounded-2xl p-6 relative group">

                <!-- Rank Badge -->
                <div class="rank-badge
                    @if($index == 0) bg-gradient-to-br from-yellow-400 to-yellow-600
                    @elseif($index == 1) bg-gradient-to-br from-gray-400 to-gray-600
                    @elseif($index == 2) bg-gradient-to-br from-orange-400 to-orange-600
                    @else bg-gradient-to-br from-blue-500 to-blue-700 @endif">
                    #{{ $index + 1 }}
                </div>

                <!-- Album Cover -->
                <div class="album-cover mb-6">
                    @if($album->cover)
                        <img src="{{ asset('storage/' . $album->cover) }}"
                            alt="{{ $album->judul }}"
                            class="w-full h-56 object-cover rounded-xl transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-56 bg-gradient-to-br from-purple-500 to-blue-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-compact-disc text-white text-5xl opacity-80"></i>
                        </div>
                    @endif
                </div>

                <!-- Album Info -->
                <div class="space-y-4">
                    <div>
                        <h3 class="font-bold text-xl mb-2 line-clamp-1 group-hover:text-blue-300 transition-colors">
                            {{ $album->judul }}
                        </h3>
                        <p class="text-gray-300 text-sm font-medium">
                            {{ optional($album->artist)->name ?? 'Unknown Artist' }}
                        </p>
                    </div>

                    <!-- Popularity -->
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400 font-medium">Popularity</span>
                            <div class="flex items-center space-x-1">
                                <i class="fas fa-fire text-orange-400 text-sm"></i>
                                <span class="font-bold text-orange-400">{{ $album->popularity ?? 0 }}</span>
                                <span class="text-gray-500 text-xs">/100</span>
                            </div>
                        </div>

                        <div class="popularity-bar">
                            <div class="popularity-fill" style="width: {{ $album->popularity ?? 0 }}%"></div>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="flex justify-between items-center pt-3 border-t border-gray-700">
                        <div class="flex items-center space-x-2 text-gray-400">
                            <i class="fas fa-music text-xs"></i>
                            <span class="text-sm font-medium">{{ $album->songs_count }} tracks</span>
                        </div>
                        <div class="flex items-center space-x-2 text-gray-400">
                            <i class="fas fa-calendar text-xs"></i>
                            <span class="text-sm font-medium">
                                {{ $album->tanggal_rilis ? \Carbon\Carbon::parse($album->tanggal_rilis)->format('M Y') : 'TBA' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($topAlbums->count() == 0)
        <div class="text-center py-20">
            <div class="w-24 h-24 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-compact-disc text-3xl text-gray-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-400 mb-3">No Albums Available</h3>
            <p class="text-gray-500 max-w-md mx-auto">
                Albums will appear here once they're added to the system. Check back soon!
            </p>
        </div>
        @endif
    </div>
</section>


        <!-- Stats Section -->
        <section class="py-16 px-6">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="stat-card p-8 text-center">
                        <div class="w-16 h-16 bg-blue-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-compact-disc text-2xl text-blue-400"></i>
                        </div>
                        <div class="text-4xl font-black text-white mb-2">{{ $topAlbums->count() }}</div>
                        <p class="text-gray-400 font-semibold">Featured Albums</p>
                    </div>

                    <div class="stat-card p-8 text-center">
                        <div class="w-16 h-16 bg-green-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-music text-2xl text-green-400"></i>
                        </div>
                        <div class="text-4xl font-black text-white mb-2">{{ $totalSongs }}</div>
                        <p class="text-gray-400 font-semibold">Total Tracks</p>
                    </div>

                    <div class="stat-card p-8 text-center">
                        <div class="w-16 h-16 bg-purple-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-users text-2xl text-purple-400"></i>
                        </div>
                        <div class="text-4xl font-black text-white mb-2">{{ $totalArtists }}</div>
                        <p class="text-gray-400 font-semibold">Artists</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Top Artists Chart dengan Donation Feature -->
        <div class="glass-card rounded-2xl p-8 mb-8">
            <div class="text-center mb-8">
                <h2 class="text-4xl font-black text-white mb-4">
                    <span class="gradient-text">Top Artists</span> & Donate
                </h2>
                <p class="text-gray-400 text-lg">Support your favorite artists with donations</p>
            </div>

            <!-- Artists Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($topArtists as $artist)
                <div class="glass-card p-6 text-center hover:scale-105 transition-all duration-300">
                    <!-- Artist Photo -->
                    @if($artist->photo)
                        <div class="w-20 h-20 rounded-full mx-auto mb-4 overflow-hidden">
                            <img src="{{ asset('storage/' . $artist->photo) }}"
                                 alt="{{ $artist->name }}"
                                 class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-600 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user text-white text-2xl"></i>
                        </div>
                    @endif

                    <!-- Artist Name -->
                    <h3 class="text-xl font-bold text-white mb-2">{{ $artist->name }}</h3>

                    <!-- Total Donations -->
                    <div class="text-sm text-gray-400 mb-4">
                        <i class="fas fa-heart text-red-400 mr-1"></i>
                        {{ number_format($artist->total_donations ?? 0) }} total donations
                    </div>

                    <!-- Donate Button -->
                    <button onclick="openDonateModal({{ $artist->id }}, '{{ $artist->name }}')"
                            class="w-full bg-gradient-to-r from-pink-500 to-red-500 hover:from-pink-600 hover:to-red-600 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-hand-holding-heart mr-2"></i>Donate
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        <!-- User Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="glass-card p-6 text-center">
                <div class="w-16 h-16 bg-blue-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headphones text-blue-400 text-2xl"></i>
                </div>
                <div class="text-3xl font-black text-white mb-2">12.5h</div>
                <p class="text-gray-400 font-semibold">Listening Time</p>
                <p class="text-green-400 text-sm mt-1">+2.3h this week</p>
            </div>

            <div class="glass-card p-6 text-center">
                <div class="w-16 h-16 bg-purple-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-heart text-purple-400 text-2xl"></i>
                </div>
                <div class="text-3xl font-black text-white mb-2">24</div>
                <p class="text-gray-400 font-semibold">Liked Songs</p>
                <p class="text-blue-400 text-sm mt-1">8 new this month</p>
            </div>

            <div class="glass-card p-6 text-center">
                <div class="w-16 h-16 bg-green-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-list text-green-400 text-2xl"></i>
                </div>
                <div class="text-3xl font-black text-white mb-2">8</div>
                <p class="text-gray-400 font-semibold">Playlists</p>
                <p class="text-yellow-400 text-sm mt    -1">128 songs total</p>
            </div>

            <div class="glass-card p-6 text-center">
                <div class="w-16 h-16 bg-yellow-500/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-coins text-yellow-400 text-2xl"></i>
                </div>
                <div class="text-3xl font-black text-white mb-2">{{ $user->points ?? 0 }}</div>
                <p class="text-gray-400 font-semibold">Poin Saya</p>
                <p class="text-yellow-400 text-sm mt-1">Gunakan untuk donasi</p>
                <button onclick="openTopupModal()" class="mt-4 bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-plus-circle mr-2"></i>Top Up
                </button>
            </div>
        </div>
    </div>

    <!-- Top Up Modal -->
    <div id="topupModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="glass-card rounded-2xl p-8 max-w-md w-full mx-4">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-coins text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-black text-white mb-2">Top Up Points</h3>
                <p class="text-gray-400">Tambah poin ke akun Anda</p>
            </div>

            <form action="{{ route('topup') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-300 mb-2">Jumlah Poin</label>
                    <input type="number" id="amount" name="amount" min="1" max="10000"
                           class="w-full bg-gray-800/50 border border-gray-600 rounded-xl py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all"
                           placeholder="Masukkan jumlah poin" required>
                </div>

                <div class="flex space-x-4">
                    <button type="button" onclick="closeTopupModal()"
                            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105">
                        Top Up
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Donate Modal -->
    <div id="donateModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="glass-card rounded-2xl p-8 max-w-md w-full mx-4">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-red-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-hand-holding-heart text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-black text-white mb-2">Donate to <span id="donateArtistName" class="gradient-text"></span></h3>
                <p class="text-gray-400">Support this artist with your points</p>
            </div>

            <form id="donateForm" action="" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="donateAmount" class="block text-sm font-medium text-gray-300 mb-2">Donation Amount (Points)</label>
                    <input type="number" id="donateAmount" name="amount" min="1" max="{{ $user->points ?? 0 }}"
                           class="w-full bg-gray-800/50 border border-gray-600 rounded-xl py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all"
                           placeholder="Enter amount" required>
                    <p class="text-sm text-gray-400 mt-1">Available points: {{ $user->points ?? 0 }}</p>
                </div>

                <div class="flex space-x-4">
                    <button type="button" onclick="closeDonateModal()"
                            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex-1 bg-gradient-to-r from-pink-500 to-red-500 hover:from-pink-600 hover:to-red-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-heart mr-2"></i>Donate
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Album Donate Modal -->
    <div id="albumDonateModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="glass-card rounded-2xl p-8 max-w-md w-full mx-4">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-compact-disc text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-black text-white mb-2">Donate to Album <span id="donateAlbumName" class="gradient-text"></span></h3>
                <p class="text-gray-400">Support this album with your points</p>
            </div>

            <form id="albumDonateForm" action="" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="albumDonateAmount" class="block text-sm font-medium text-gray-300 mb-2">Donation Amount (Points)</label>
                    <input type="number" id="albumDonateAmount" name="amount" min="1" max="{{ $user->points ?? 0 }}"
                           class="w-full bg-gray-800/50 border border-gray-600 rounded-xl py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                           placeholder="Enter amount" required>
                    <p class="text-sm text-gray-400 mt-1">Available points: {{ $user->points ?? 0 }}</p>
                </div>

                <div class="flex space-x-4">
                    <button type="button" onclick="closeAlbumDonateModal()"
                            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex-1 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-heart mr-2"></i>Donate to Album
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="border-t border-white/10 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-gray-500 text-sm">
                &copy; {{ date('Y') }} <span class="gradient-text font-bold">MusicChart</span>.
                Your personal music companion.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.tailwindcss.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
        // Modal functions
        function openTopupModal() {
            document.getElementById('topupModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeTopupModal() {
            document.getElementById('topupModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Donation modal functions
        function openDonateModal(artistId, artistName) {
            document.getElementById('donateArtistName').textContent = artistName;
            document.getElementById('donateForm').action = `/artists/${artistId}/donate`;
            document.getElementById('donateModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.getElementById('donateAmount').focus();
        }

        function closeDonateModal() {
            document.getElementById('donateModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('donateForm').reset();
        }

        // Album donation modal functions
        function openAlbumDonateModal(albumId, albumName) {
            document.getElementById('donateAlbumName').textContent = albumName;
            document.getElementById('albumDonateForm').action = `/albums/${albumId}/donate`;
            document.getElementById('albumDonateModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.getElementById('albumDonateAmount').focus();
        }

        function closeAlbumDonateModal() {
            document.getElementById('albumDonateModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('albumDonateForm').reset();
        }

        // Close modal when clicking outside
        document.getElementById('topupModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeTopupModal();
            }
        });

        document.getElementById('donateModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDonateModal();
            }
        });

        document.getElementById('albumDonateModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAlbumDonateModal();
            }
        });

        // DataTables Initialization
        $(document).ready(function() {
            $('#albumsTable').DataTable({
                responsive: true,
                language: {
                    search: "",
                    searchPlaceholder: "Search albums...",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ albums",
                    infoEmpty: "No albums found",
                    infoFiltered: "(filtered from _MAX_ total albums)",
                    paginate: {
                        previous: '<i class="fas fa-chevron-left"></i>',
                        next: '<i class="fas fa-chevron-right"></i>'
                    }
                },
                dom: '<"flex justify-between items-center mb-4"<"text-gray-400"l>fr>t<"flex justify-between items-center mt-4"<"text-gray-400"i>p>',
                pageLength: 10,
                order: [[0, 'asc']],
                initComplete: function() {
                    // Custom search box styling
                    $('.dataTables_filter input').addClass('bg-gray-800/50 border border-gray-600 rounded-lg py-2 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500');
                }
            });

            // Custom search functionality
            $('#albumSearch').on('keyup', function() {
                $('#albumsTable').DataTable().search(this.value).draw();
            });

            // Popularity bar animation
            document.querySelectorAll('.popularity-fill').forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });
        });
    </script>
</body>
</html>
