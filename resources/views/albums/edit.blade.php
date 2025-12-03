<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Album - MusicChart Admin</title>

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

        .file-input {
            background: rgba(255, 255, 255, 0.05);
            border: 2px dashed rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .file-input:hover {
            border-color: #60a5fa;
            background: rgba(96, 165, 250, 0.1);
        }

        .form-label {
            color: #e2e8f0;
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .form-help {
            color: #94a3b8;
            font-size: 0.875rem;
            margin-top: 4px;
        }

        .current-cover {
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .current-cover:hover {
            border-color: #60a5fa;
            transform: scale(1.02);
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
    <div class="max-w-2xl mx-auto px-6 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-black text-white mb-2">
                Edit <span class="gradient-text">{{ $album->judul }}</span>
            </h1>
            <p class="text-gray-400">Update album information and metadata</p>
        </div>

        <!-- Form -->
        <div class="glass-card rounded-2xl p-8">
            <form action="{{ route('albums.update', $album) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Artist Selection -->
                <div class="mb-6">
                    <label for="artist_id" class="form-label">
                        <i class="fas fa-user-alt text-blue-400 mr-2"></i>Artist *
                    </label>
                    <select name="artist_id" id="artist_id" required
                            class="input-field w-full px-4 py-3 text-white">
                        <option value="" class="text-gray-700">Select Artist</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}" {{ $album->artist_id == $artist->id ? 'selected' : '' }} class="text-gray-700">
                                {{ $artist->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Album Title -->
                <div class="mb-6">
                    <label for="judul" class="form-label">
                        <i class="fas fa-heading text-purple-400 mr-2"></i>Album Title *
                    </label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $album->judul) }}" required
                           class="input-field w-full px-4 py-3 text-white placeholder-gray-500"
                           placeholder="Enter album title">
                </div>

                <!-- Release Date -->
                <div class="mb-6">
                    <label for="tanggal_rilis" class="form-label">
                        <i class="fas fa-calendar text-green-400 mr-2"></i>Release Date
                    </label>
                    <input type="date" name="tanggal_rilis" id="tanggal_rilis" value="{{ old('tanggal_rilis', $album->tanggal_rilis) }}"
                           class="input-field w-full px-4 py-3 text-white">
                </div>

                <!-- Current Cover -->
@if($album->cover)
<div class="mb-6">
    <label class="form-label">
        <i class="fas fa-image text-yellow-400 mr-2"></i>Current Cover
    </label>
    <div class="current-cover p-4 inline-block">
        <img src="{{ asset('storage/' . $album->cover) }}"
             alt="{{ $album->judul }}"
             class="w-32 h-32 rounded-lg object-cover shadow-lg">
        <p class="text-xs text-gray-400 mt-2 text-center">
            {{ basename($album->cover) }}
        </p>
    </div>
</div>
@endif

                <!-- New Cover -->
                <div class="mb-6">
                    <label for="cover" class="form-label">
                        <i class="fas fa-sync text-blue-400 mr-2"></i>
                        {{ $album->cover ? 'Change Cover' : 'Upload Cover' }}
                    </label>
                    <div class="file-input p-6 text-center cursor-pointer">
                        <input type="file" name="cover" id="cover" accept="image/*"
                               class="hidden">
                        <div class="flex flex-col items-center space-y-3">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                            <div>
                                <p class="text-white font-medium">Click to {{ $album->cover ? 'change' : 'upload' }} cover image</p>
                                <p class="form-help">Max file size: 2MB. Supported formats: JPEG, PNG, JPG, GIF</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Popularity -->
                <div class="mb-8">
                    <label for="popularity" class="form-label">
                        <i class="fas fa-fire text-orange-400 mr-2"></i>Popularity (0-100)
                    </label>
                    <input type="number" name="popularity" id="popularity" min="0" max="100"
                           value="{{ old('popularity', $album->popularity ?? 0) }}"
                           class="input-field w-full px-4 py-3 text-white">
                    <p class="form-help">Optional. Higher score indicates higher popularity in charts.</p>

                    <!-- Popularity Preview -->
                    <div class="mt-3">
                        <div class="flex justify-between text-sm text-gray-400 mb-1">
                            <span>Popularity Score</span>
                            <span id="popularity-value">{{ old('popularity', $album->popularity ?? 0) }}</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div id="popularity-preview" class="bg-gradient-to-r from-orange-400 to-red-500 h-2 rounded-full transition-all duration-300"
                                 style="width: {{ old('popularity', $album->popularity ?? 0) }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-700">
                    <a href="{{ route('albums.index') }}"
                       class="btn-secondary px-6 py-3 flex items-center space-x-2 transition-all duration-300">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Albums</span>
                    </a>
                    <button type="submit"
                            class="btn-primary px-8 py-3 flex items-center space-x-2 transition-all duration-300">
                        <i class="fas fa-save"></i>
                        <span>Update Album</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // File input preview
        const fileInput = document.getElementById('cover');
        const fileInputContainer = fileInput.parentElement;

        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const fileName = this.files[0].name;
                fileInputContainer.innerHTML = `
                    <div class="flex flex-col items-center space-y-2">
                        <i class="fas fa-check-circle text-green-400 text-2xl"></i>
                        <p class="text-white font-medium">${fileName}</p>
                        <p class="form-help">File selected successfully</p>
                    </div>
                `;
            }
        });

        // Popularity preview
        const popularityInput = document.getElementById('popularity');
        const popularityValue = document.getElementById('popularity-value');
        const popularityPreview = document.getElementById('popularity-preview');

        popularityInput.addEventListener('input', function() {
            const value = this.value;
            popularityValue.textContent = value;
            popularityPreview.style.width = value + '%';
        });

        // Add click event to file input container
        fileInputContainer.addEventListener('click', function() {
            fileInput.click();
        });
    </script>
</body>
</html>
