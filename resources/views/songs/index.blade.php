<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Songs - MusicChart Admin</title>

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

        .table-glass {
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .table-header {
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .table-row {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .table-row:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: translateX(4px);
        }

        .action-btn {
            transition: all 0.3s ease;
            padding: 6px 10px;
            border-radius: 8px;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        .view-btn:hover { background: rgba(96, 165, 250, 0.2); }
        .edit-btn:hover { background: rgba(34, 197, 94, 0.2); }
        .delete-btn:hover { background: rgba(239, 68, 68, 0.2); }
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
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-black text-white mb-2">
                    <span class="gradient-text">Songs</span> Management
                </h1>
                <p class="text-gray-400">Manage your music songs and tracks</p>
            </div>

            <div class="flex space-x-3">
                <!-- Export Button -->
                <a href="{{ route('songs.export') }}"
                   class="btn-secondary px-4 py-3 flex items-center space-x-2 transition-all duration-300">
                    <i class="fas fa-file-excel text-green-400"></i>
                    <span>Export Excel</span>
                </a>

                <!-- Trash Button -->
                <a href="{{ route('songs.trash') }}"
                   class="btn-warning px-4 py-3 flex items-center space-x-2 transition-all duration-300">
                    <i class="fas fa-trash"></i>
                    <span>View Trash</span>
                </a>

                <!-- Add Button -->
                <a href="{{ route('songs.create') }}"
                   class="btn-primary px-6 py-3 flex items-center space-x-2 transition-all duration-300">
                    <i class="fas fa-plus"></i>
                    <span>Add New Song</span>
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="glass-card border border-green-500/20 mb-6 p-4">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-green-500/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-check text-green-400"></i>
                </div>
                <p class="text-green-400 font-medium">{{ session('success') }}</p>
            </div>
        </div>
        @endif

        <!-- Songs Table -->
        <div class="glass-card rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="table-header">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Song Title</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Artist</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Album</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Duration</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse($songs as $song)
                        <tr class="table-row">
                            <!-- Song Title -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-white">{{ $song->judul }}</div>
                            </td>

                            <!-- Artist -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">{{ optional($song->artist)->name ?? 'Unknown Artist' }}</div>
                            </td>

                            <!-- Album -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-300">{{ optional($song->album)->judul ?? 'Unknown Album' }}</div>
                            </td>

                            <!-- Duration -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-400">{{ $song->durasi_formatted }}</div>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('songs.show', $song) }}"
                                       class="action-btn view-btn text-blue-400 hover:text-blue-300">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('songs.edit', $song) }}"
                                       class="action-btn edit-btn text-green-400 hover:text-green-300">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ url('songs/' . $song->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="action-btn delete-btn text-red-400 hover:text-red-300"
                                                onclick="return confirm('Are you sure you want to delete this song?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center">
                                <div class="flex flex-col items-center space-y-4">
                                    <div class="w-16 h-16 bg-gray-800 rounded-2xl flex items-center justify-center">
                                        <i class="fas fa-music text-gray-600 text-2xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-400 mb-2">No songs found</h3>
                                        <p class="text-gray-500 text-sm">Get started by adding your first song</p>
                                    </div>
                                    <a href="{{ route('songs.create') }}"
                                       class="btn-primary px-6 py-2 text-sm">
                                        <i class="fas fa-plus mr-2"></i>Add First Song
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
