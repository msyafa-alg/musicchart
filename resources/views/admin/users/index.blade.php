<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - MusicChart Admin</title>

    <!-- Tailwind & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css">

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

        .points-badge {
            background: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
            color: white;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.875rem;
        }

        .admin-badge {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
        }

        .user-row:hover {
            background: rgba(59, 130, 246, 0.1);
            transition: all 0.3s ease;
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

                    <a href="{{ route('admin.users.index') }}"
                       class="nav-link active flex items-center space-x-2">
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
        <!-- Header -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-black text-white mb-2">
                    <span class="gradient-text">User Management</span>
                </h1>
                <p class="text-gray-400">Manage users and their points</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-black text-white">
                    {{ $users->total() }} Total Users
                </div>
                <p class="text-gray-400 text-sm">Manage points and accounts</p>
            </div>
        </div>

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

        <!-- Users Table -->
        <div class="glass-card rounded-2xl p-8">
            <div class="overflow-x-auto">
                <table class="w-full text-white">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="py-4 px-4 text-left font-semibold">ID</th>
                            <th class="py-4 px-4 text-left font-semibold">User</th>
                            <th class="py-4 px-4 text-left font-semibold">Email</th>
                            <th class="py-4 px-4 text-left font-semibold">Points</th>
                            <th class="py-4 px-4 text-left font-semibold">Joined</th>
                            <th class="py-4 px-4 text-left font-semibold">Role</th>
                            <th class="py-4 px-4 text-left font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="user-row border-b border-gray-800 hover:bg-gray-800/30 transition-colors">
                            <td class="py-4 px-4 text-gray-300">#{{ $user->id }}</td>
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <div class="font-medium text-white">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-400">{{ $user->username }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-gray-300">{{ $user->email }}</td>
                            <td class="py-4 px-4">
                                <span class="points-badge">{{ number_format($user->points) }} pts</span>
                            </td>
                            <td class="py-4 px-4 text-gray-300">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="py-4 px-4">
                                @if($user->is_admin)
                                    <span class="admin-badge">Admin</span>
                                @else
                                    <span class="text-gray-400">User</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex space-x-2">
                                    <!-- Edit Points Button -->
                                    <button onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', {{ $user->points }})"
                                            class="btn-secondary px-3 py-2 text-sm flex items-center space-x-1">
                                        <i class="fas fa-edit text-blue-400"></i>
                                        <span>Edit Points</span>
                                    </button>

                                    <!-- Topup Button -->
                                    <button onclick="openTopupModal({{ $user->id }}, '{{ $user->name }}')"
                                            class="btn-primary px-3 py-2 text-sm flex items-center space-x-1">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Topup</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
            <div class="mt-8 flex justify-center">
                <div class="flex space-x-2">
                    @if($users->onFirstPage())
                        <span class="px-4 py-2 bg-gray-800 text-gray-500 rounded-lg cursor-not-allowed">
                            <i class="fas fa-chevron-left mr-1"></i> Previous
                        </span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="btn-secondary px-4 py-2 flex items-center">
                            <i class="fas fa-chevron-left mr-1"></i> Previous
                        </a>
                    @endif

                    <span class="px-4 py-2 bg-gray-800 text-white rounded-lg">
                        Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
                    </span>

                    @if($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="btn-secondary px-4 py-2 flex items-center">
                            Next <i class="fas fa-chevron-right ml-1"></i>
                        </a>
                    @else
                        <span class="px-4 py-2 bg-gray-800 text-gray-500 rounded-lg cursor-not-allowed">
                            Next <i class="fas fa-chevron-right ml-1"></i>
                        </span>
                    @endif
                </div>
            </div>
            @endif

            <!-- Total Points Summary -->
            <div class="mt-8 pt-6 border-t border-gray-700">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="glass-card p-4 text-center">
                        <div class="text-2xl font-black text-white">{{ number_format($users->sum('points')) }}</div>
                        <p class="text-gray-400 text-sm">Total Points All Users</p>
                    </div>
                    <div class="glass-card p-4 text-center">
                        <div class="text-2xl font-black text-white">{{ number_format($users->avg('points'), 0) }}</div>
                        <p class="text-gray-400 text-sm">Average Points per User</p>
                    </div>
                    <div class="glass-card p-4 text-center">
                        <div class="text-2xl font-black text-white">{{ $users->where('points', '>', 0)->count() }}</div>
                        <p class="text-gray-400 text-sm">Users with Points</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Points Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="glass-card rounded-2xl p-8 max-w-md w-full mx-4">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-edit text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-black text-white mb-2" id="editUserName">Edit Points</h3>
                <p class="text-gray-400">Set points for this user</p>
            </div>

            <form id="editForm" action="" method="POST" class="space-y-6">
                @csrf
                @method('POST')
                <div>
                    <label for="points" class="block text-sm font-medium text-gray-300 mb-2">Points Amount</label>
                    <input type="number" id="points" name="points" min="0" max="1000000"
                           class="w-full bg-gray-800/50 border border-gray-600 rounded-xl py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                           placeholder="Enter points amount" required>
                    <p class="text-sm text-gray-400 mt-1">Set the exact point value for user</p>
                </div>

                <div class="flex space-x-4">
                    <button type="button" onclick="closeEditModal()"
                            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex-1 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i>Update Points
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Topup Modal -->
    <div id="topupModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="glass-card rounded-2xl p-8 max-w-md w-full mx-4">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-plus-circle text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-black text-white mb-2" id="topupUserName">Topup Points</h3>
                <p class="text-gray-400">Add points to this user</p>
            </div>

            <form id="topupForm" action="" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-300 mb-2">Add Points</label>
                    <input type="number" id="amount" name="amount" min="1" max="1000000"
                           class="w-full bg-gray-800/50 border border-gray-600 rounded-xl py-3 px-4 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all"
                           placeholder="Enter points to add" required>
                    <p class="text-sm text-gray-400 mt-1">Enter how many points to add</p>
                </div>

                <div class="flex space-x-4">
                    <button type="button" onclick="closeTopupModal()"
                            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                        Cancel
                    </button>
                    <button type="submit"
                            class="flex-1 bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-plus-circle mr-2"></i>Add Points
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Edit Points Modal
        function openEditModal(userId, userName, currentPoints) {
            document.getElementById('editUserName').textContent = `Edit Points for ${userName}`;
            document.getElementById('editForm').action = `/admin/users/${userId}/update-points`;
            document.getElementById('points').value = currentPoints;
            document.getElementById('editModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.getElementById('points').focus();
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('editForm').reset();
        }

        // Topup Modal
        function openTopupModal(userId, userName) {
            document.getElementById('topupUserName').textContent = `Topup Points for ${userName}`;
            document.getElementById('topupForm').action = `/admin/users/${userId}/topup`;
            document.getElementById('topupModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.getElementById('amount').focus();
        }

        function closeTopupModal() {
            document.getElementById('topupModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
            document.getElementById('topupForm').reset();
        }

        // Close modals when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        document.getElementById('topupModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeTopupModal();
            }
        });

        // Initialize DataTables if needed
        document.addEventListener('DOMContentLoaded', function() {
            // You can add DataTables initialization here if needed
        });
    </script>
</body>
</html>
