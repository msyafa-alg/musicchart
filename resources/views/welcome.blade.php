<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicChart - Trending Music & Popular Albums</title>

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
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            transform: translateY(-8px);
            background: rgba(30, 41, 59, 0.85);
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.05);
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

        .gradient-text {
            background: linear-gradient(135deg, #60a5fa 0%, #c084fc 50%, #f472b6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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

        .nav-blur {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
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

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-green) 0%, #059669 100%);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
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

        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-12px); }
        }
    </style>
</head>

<body class="min-h-screen antialiased">

    <!-- Navigation -->
    <nav class="nav-blur sticky top-0 z-50 py-4 px-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center pulse-glow">
                    <i class="fas fa-wave-square text-white"></i>
                </div>
                <span class="text-2xl font-black gradient-text tracking-tight">MusicChart</span>
            </div>
            <a href="{{ route('login') }}"
               class="btn-primary px-6 py-3 text-white font-semibold flex items-center space-x-2 group">
                <span>Login</span>
                <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-200"></i>
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative overflow-hidden py-20 px-6">
        <div class="max-w-6xl mx-auto text-center relative z-10">
            <!-- Floating Elements -->
            <div class="floating-element absolute -top-10 -left-10 w-20 h-20 bg-blue-500/10 rounded-full blur-xl"></div>
            <div class="floating-element absolute -bottom-10 -right-10 w-24 h-24 bg-purple-500/10 rounded-full blur-xl" style="animation-delay: 2s;"></div>

            <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight">
                <span class="gradient-text">Discover</span><br>
                <span class="text-white">Trending Music</span>
            </h1>

            <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed">
                Real-time music charts powered by fan engagement and expert curation.
                <span class="text-accent-green font-semibold">Updated live.</span>
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mt-12">
                <div class="flex items-center space-x-2 text-gray-400">
                    <i class="fas fa-fire text-orange-400"></i>
                    <span class="text-sm font-medium">Live Rankings</span>
                </div>
                <div class="w-2 h-2 bg-gray-600 rounded-full"></div>
                <div class="flex items-center space-x-2 text-gray-400">
                    <i class="fas fa-users text-blue-400"></i>
                    <span class="text-sm font-medium">Fan Powered</span>
                </div>
                <div class="w-2 h-2 bg-gray-600 rounded-full"></div>
                <div class="flex items-center space-x-2 text-gray-400">
                    <i class="fas fa-sync text-green-400"></i>
                    <span class="text-sm font-medium">Daily Updates</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Albums Chart -->
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

                        <!-- Popularity Score -->
                        <div class="space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-400 font-medium">Popularity</span>
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-fire text-orange-400 text-sm"></i>
                                    <span class="font-bold text-orange-400">{{ $album->popularity ?? 0 }}</span>
                                    <span class="text-gray-500 text-xs">/100</span>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="popularity-bar">
                                <div class="popularity-fill" style="width: {{ $album->popularity ?? 0 }}%"></div>
                            </div>
                        </div>

                        <!-- Album Stats -->
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

            <!-- Empty State -->
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

    <!-- Footer -->
    <footer class="border-t border-gray-800 py-12 px-6">
        <div class="max-w-6xl mx-auto text-center">
            <div class="flex justify-center items-center space-x-3 mb-6">
                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-wave-square text-white text-sm"></i>
                </div>
                <span class="text-xl font-black gradient-text">MusicChart</span>
            </div>

            <p class="text-gray-500 mb-4 max-w-md mx-auto">
                Your ultimate destination for discovering trending music and popular albums.
            </p>

            <div class="flex justify-center items-center space-x-6 text-gray-500 text-sm mb-6">
                <span>© 2024 MusicChart</span>
                <span>•</span>
                <span>All rights reserved</span>
                <span>•</span>
                <span>Powered by Fans</span>
            </div>

            <div class="flex justify-center space-x-4">
                <a href="#" class="text-gray-500 hover:text-white transition-colors">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="https://instagram.com/syafaalgiffari" class="text-gray-500 hover:text-white transition-colors">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-gray-500 hover:text-white transition-colors">
                    <i class="fab fa-spotify"></i>
                </a>
            </div>
        </div>
    </footer>

</body>
</html>
