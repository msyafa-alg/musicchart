<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $album->judul }} - MusicChart Admin</title>

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

        .info-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
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
                       class="nav-link flex items-center space-x-2">
                        <i class="fas fa-user-alt"></i>
                        <span>Artists</span>
                    </a>

                    <a href="{{ route('albums.index') }}"
                       class="nav-link active flex items-center space-x-2">
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
    <div class="max-w-6xl mx-auto px-6 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-black text-white mb-2">
                    Album: <span class="gradient-text">{{ $album->judul }}</span>
                </h1>
                <p class="text-gray-400">Detailed information about this music album</p>
            </div>

            <div class="flex space-x-3">
                <a href="{{ route('albums.edit', $album) }}"
                   class="btn-primary px-6 py-3 flex items-center space-x-2 transition-all duration-300">
                    <i class="fas fa-edit"></i>
                    <span>Edit Album</span>
                </a>
                <a href="{{ route('albums.index') }}"
                   class="btn-secondary px-6 py-3 flex items-center space-x-2 transition-all duration-300">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Albums</span>
                </a>
            </div>
        </div>

        <!-- Album Details -->
        <div class="glass-card rounded-2xl p-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cover Section -->
                <div class="lg:col-span-1">
                    <div class="flex flex-col items-center">
                        @php
                            $cover = $album->cover;
                            $storageExists = $cover && \Illuminate\Support\Facades\Storage::disk('public')->exists($cover);
                        @endphp

                        @if($cover)
                            <img src="{{ asset('storage/' . $cover) }}"
                                 alt="{{ $album->judul }}"
                                 class="w-64 h-64 rounded-2xl object-cover shadow-2xl border-2 border-blue-500/30">
                        @else
                            <div class="w-64 h-64 bg-gradient-to-br from-purple-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-2xl">
                                <i class="fas fa-compact-disc text-white text-4xl"></i>
                            </div>
                        @endif

                        <!-- Popularity Badge -->
                        <div class="mt-4 flex items-center space-x-2 bg-orange-500/20 px-4 py-2 rounded-full border border-orange-500/30">
                            <i class="fas fa-fire text-orange-400"></i>
                            <span class="text-orange-400 font-bold text-lg">{{ $album->popularity }}</span>
                            <span class="text-orange-300 text-sm">Popularity</span>
                        </div>
                    </div>
                </div>

                <!-- Info Section -->
                <div class="lg:col-span-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Album Title -->
                        <div class="info-card">
                            <div class="info-label">
                                <i class="fas fa-heading text-blue-400 mr-2"></i>Album Title
                            </div>
                            <div class="info-value">{{ $album->judul }}</div>
                        </div>

                        <!-- Artist -->
                        <div class="info-card">
                            <div class="info-label">
                                <i class="fas fa-user-alt text-purple-400 mr-2"></i>Artist
                            </div>
                            <div class="info-value">{{ optional($album->artist)->name ?? 'Unknown Artist' }}</div>
                        </div>

                        <!-- Release Date -->
                        <div class="info-card">
                            <div class="info-label">
                                <i class="fas fa-calendar text-green-400 mr-2"></i>Release Date
                            </div>
                            <div class="info-value">
                                {{ $album->tanggal_rilis ? \Carbon\Carbon::parse($album->tanggal_rilis)->format('d M Y') : 'Not set' }}
                            </div>
                        </div>

                        <!-- Album ID -->
                        <div class="info-card">
                            <div class="info-label">
                                <i class="fas fa-hashtag text-gray-400 mr-2"></i>Album ID
                            </div>
                            <div class="info-value">#{{ $album->id }}</div>
                        </div>

                        <!-- Created At -->
                        <div class="info-card">
                            <div class="info-label">
                                <i class="fas fa-plus-circle text-green-400 mr-2"></i>Created At
                            </div>
                            <div class="info-value">{{ $album->created_at->format('d M Y, H:i') }}</div>
                        </div>

                        <!-- Last Updated -->
                        <div class="info-card">
                            <div class="info-label">
                                <i class="fas fa-sync-alt text-blue-400 mr-2"></i>Last Updated
                            </div>
                            <div class="info-value">{{ $album->updated_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="mt-6 info-card">
                        <div class="info-label">
                            <i class="fas fa-info-circle text-yellow-400 mr-2"></i>Additional Information
                        </div>
                        <div class="text-gray-300 mt-2">
                            This album is part of your music collection. You can edit the details or manage related songs from here.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center space-x-4 mt-8">
            <a href="{{ route('albums.edit', $album) }}"
               class="btn-primary px-8 py-3 flex items-center space-x-2 transition-all duration-300">
                <i class="fas fa-edit"></i>
                <span>Edit Album</span>
            </a>
            <a href="{{ route('albums.index') }}"
               class="btn-secondary px-8 py-3 flex items-center space-x-2 transition-all duration-300">
                <i class="fas fa-list"></i>
                <span>View All Albums</span>
            </a>
        </div>
    </div>
</body>
</html>
