<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artists Trash - MusicChart Admin</title>

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

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
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

        .restore-btn:hover { background: rgba(34, 197, 94, 0.2); }
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
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-black text-white mb-2">
                    <span class="gradient-text">Artists</span> Trash
                </h1>
                <p class="text-gray-400">Manage deleted artists - restore or permanently delete</p>
            </div>

            <div class="flex space-x-3">
                <a href="{{ route('artists.index') }}"
                   class="btn-secondary px-6 py-3 flex items-center space-x-2 transition-all duration-300">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Artists</span>
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

        <!-- Trash Table -->
        @if($artists->count() > 0)
        <div class="glass-card rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="table-header">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Photo</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Bio</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Deleted At</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @foreach($artists as $artist)
                        <tr class="table-row">
                            <!-- Photo -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($artist->photo)
                                    <img src="{{ asset('storage/' . $artist->photo) }}"
                                         alt="{{ $artist->name }}"
                                         class="w-12 h-12 rounded-full object-cover border-2 border-red-500/40 shadow-lg">
                                @else
                                    <div class="w-12 h-12 bg-gradient-to-br from-red-600 to-orange-600 rounded-full flex items-center justify-center shadow-lg">
                                        <i class="fas fa-user-slash text-white text-sm"></i>
                                    </div>
                                @endif
                            </td>

                            <!-- Name -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-white">{{ $artist->name }}</div>
                            </td>

                            <!-- Bio -->
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-300 max-w-xs truncate">{{ $artist->bio ?? 'No bio' }}</div>
                            </td>

                            <!-- Deleted At -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-calendar-times text-red-400 text-sm"></i>
                                    <span class="text-sm text-red-300">
                                        {{ optional($artist->deleted_at)->format('d M Y, H:i') ?? '-' }}
                                    </span>
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <form action="{{ url('artists/' . $artist->id . '/restore') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="action-btn restore-btn text-green-600 hover:text-green-900 mr-3">
                                            <i class="fas fa-undo mr-1"></i>Restore
                                        </button>
                                    </form>
                                    <form action="{{ url('artists/' . $artist->id . '/force-delete') }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete-btn text-red-600 hover:text-red-900" onclick="return confirm('Permanently delete this artist? This action cannot be undone!')">
                                            <i class="fas fa-trash mr-1"></i>Delete Permanently
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <!-- Empty Trash State -->
        <div class="glass-card rounded-2xl p-12 text-center">
            <div class="max-w-md mx-auto">
                <div class="w-24 h-24 bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl flex items-center justify-center mx-auto mb-6 border border-gray-700">
                    <i class="fas fa-trash-alt text-gray-500 text-4xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-400 mb-3">Trash is Empty</h2>
                <p class="text-gray-500 mb-8">No deleted artists found in the trash bin.</p>
                <a href="{{ route('artists.index') }}"
                   class="btn-secondary px-8 py-3 inline-flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Return to Artists</span>
                </a>
            </div>
        </div>
        @endif
    </div>

    <script>
        // Confirmation for permanent delete
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[action*="force-delete"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('Are you absolutely sure you want to permanently delete this artist?\n\nThis action cannot be undone and all associated data will be lost forever!')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>
