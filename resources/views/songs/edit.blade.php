<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Song - MusicChart Admin</title>

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

        .form-input {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: white;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
        }

        .form-label {
            color: #e2e8f0;
            font-weight: 500;
        }

        .form-hint {
            color: #94a3b8;
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
                       class="nav-link flex items-center space-x-2">
                        <i class="fas fa-compact-disc"></i>
                        <span>Albums</span>
                    </a>

                    <a href="{{ route('songs.index') }}"
                       class="nav-link active flex items-center space-x-2">
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
    <div class="max-w-2xl mx-auto px-6 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-black text-white mb-2">
                <span class="gradient-text">Edit Song</span>
            </h1>
            <p class="text-gray-400">Update song: {{ $song->judul }}</p>
        </div>

        <!-- Form -->
        <div class="glass-card rounded-2xl p-8">
            <form action="{{ route('songs.update', $song) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Artist Selection -->
                <div class="mb-6">
                    <label for="artist_id" class="form-label block mb-3">Artist *</label>
                    <select name="artist_id" id="artist_id" required
                        class="form-input w-full px-4 py-3">
                        <option value="" class="bg-gray-800">Select Artist</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}" {{ $song->artist_id == $artist->id ? 'selected' : '' }} class="bg-gray-800">
                                {{ $artist->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Album Selection -->
                <div class="mb-6">
                    <label for="album_id" class="form-label block mb-3">Album *</label>
                    <select name="album_id" id="album_id" required
                        class="form-input w-full px-4 py-3">
                        <option value="" class="bg-gray-800">Select Album</option>
                        @foreach($albums as $album)
                            <option value="{{ $album->id }}" {{ $song->album_id == $album->id ? 'selected' : '' }} class="bg-gray-800">
                                {{ $album->judul }} - {{ optional($album->artist)->name ?? 'Unknown Artist' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Song Title -->
                <div class="mb-6">
                    <label for="judul" class="form-label block mb-3">Song Title *</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $song->judul) }}" required
                        class="form-input w-full px-4 py-3"
                        placeholder="Enter song title">
                </div>

                <!-- Duration -->
                <div class="mb-8">
                    <label for="durasi" class="form-label block mb-3">Duration (seconds) *</label>
                    <input type="number" name="durasi" id="durasi" min="1" value="{{ old('durasi', $song->durasi) }}" required
                        class="form-input w-full px-4 py-3"
                        placeholder="Enter duration in seconds">
                    <p class="form-hint text-sm mt-2">Current: {{ $song->durasi_formatted }} ({{ $song->durasi }} seconds)</p>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-700">
                    <a href="{{ route('songs.index') }}"
                       class="btn-secondary px-6 py-3 flex items-center space-x-2 transition-all duration-300">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    <button type="submit"
                            class="btn-primary px-8 py-3 flex items-center space-x-2 transition-all duration-300">
                        <i class="fas fa-save"></i>
                        <span>Update Song</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
