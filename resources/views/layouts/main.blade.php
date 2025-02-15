<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sticky Notes' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            pointer-events: none;
            background: linear-gradient(to bottom right, #60A5FA, #A78BFA, #F472B6);
        }

        body {
            font-family: 'Poppins', sans-serif;
            position: relative;
            z-index: 1;
        }
        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
        .btn-shine {
            position: relative;
            overflow: hidden;
        }
        .btn-shine::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to right,
                rgba(255,255,255,0) 0%,
                rgba(255,255,255,.3) 50%,
                rgba(255,255,255,0) 100%
            );
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }
        @keyframes shine {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-400 via-purple-400 to-pink-400 animate-gradient text-gray-800">
    <!-- Particle.js container -->
    <div id="particles-js" class="fixed inset-0 z-0 pointer-events-none"></div>

    <div class="flex min-h-screen relative z-10">
        <!-- Sidebar yang lebih colorful -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-30 w-80 bg-white/10 backdrop-blur-xl border-r border-white/20 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="h-full pt-16 flex flex-col">
                <!-- User Profile -->
                <div class="p-6 border-b border-white/20">
                    <h2 class="text-4xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent hover-scale">Sticky Notes</h2>
                </div>
                
                <!-- User Profile yang lebih menarik -->
                <div class="p-6 border-b border-white/20">
                    <div class="flex items-center space-x-4 p-4 rounded-2xl bg-white/10 hover-scale backdrop-blur-lg">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full blur-lg opacity-70"></div>
                            <img class="relative w-16 h-16 rounded-full ring-4 ring-white/30 shadow-lg" 
                                 src="https://ui-avatars.com/api/?name={{ auth()->user()->username }}&background=6366f1&color=fff" 
                                 alt="Profile">
                        </div>
                        <div>
                            <p class="font-semibold text-xl text-white">{{ auth()->user()->username }}</p>
                            <p class="text-sm text-white/70">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation yang diperbarui -->
                <nav class="p-6 flex-1 overflow-y-auto">
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('notes.index') }}" 
                               class="flex items-center space-x-3 p-4 rounded-xl transition-all duration-300 btn-shine
                               {{ request()->routeIs('notes.index') 
                                  ? 'bg-gradient-to-r from-blue-500/30 to-purple-500/30 text-white shadow-lg border border-white/20' 
                                  : 'hover:bg-white/10 text-white/80 hover:text-white' }}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                <span class="font-medium text-lg">Beranda</span>
                            </a>
                        </li>
                        <!-- <li>
                            <a href="{{ route('notes.history') }}" 
                               class="flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 
                               {{ request()->routeIs('notes.history') 
                                  ? 'bg-gradient-to-r from-indigo-50 to-pink-50 text-indigo-600 shadow-sm border border-indigo-100' 
                                  : 'hover:bg-white/80 hover:shadow-sm' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Riwayat Catatan</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 p-2 rounded hover:bg-gray-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>Profil</span>
                            </a>
                        </li>
                        <li> -->
                            <a href="{{ route('about') }}" 
                               class="flex items-center space-x-3 p-4 rounded-xl transition-all duration-300
                               {{ request()->routeIs('about') 
                                  ? 'bg-gradient-to-r from-blue-500/30 to-purple-500/30 text-white shadow-lg border border-white/20' 
                                  : 'hover:bg-white/10 text-white/80 hover:text-white' }}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-medium text-lg">Tentang</span>
                            </a>
                        </li>
                        <li>
                            <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="button" 
                                        onclick="showLogoutConfirmation()"
                                        class="w-full flex items-center space-x-3 p-4 rounded-xl transition-all duration-300 text-pink-400 hover:bg-pink-500/10 hover:text-pink-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    <span class="font-medium text-lg">Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 lg:pl-80">
            <!-- Toggle Sidebar Button -->
            <button id="toggleSidebar" class="fixed top-6 left-6 z-50 lg:hidden bg-white/20 p-3 rounded-xl backdrop-blur-xl shadow-lg border border-white/20 hover:bg-white/30 transition-all duration-300">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <div class="min-h-screen pt-16">
                <!-- Navbar -->
                <nav class="fixed top-0 left-0 right-0 bg-white/10 backdrop-blur-md border-b border-white/20 z-40">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between items-center h-16">
                            <!-- Logo dan Brand -->
                            <div class="flex items-center gap-2">
                                <a href="{{ route('notes.create') }}" class="flex items-center gap-2">
                                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <span class="text-xl font-bold bg-gradient-to-r from-blue-500 to-purple-500 text-transparent bg-clip-text">
                                        Sticky Notes
                                    </span>
                                </a>
                            </div>

                            <!-- Search Bar - Hanya tampilkan jika bukan di halaman about -->
                            @if(Route::currentRouteName() !== 'about')
                            <div class="flex-1 max-w-xl mx-4">
                                <form action="{{ route('notes.search') }}" method="GET" class="relative flex gap-2">
                                    <div class="relative flex-1">
                                        <input type="text" 
                                               name="q" 
                                               placeholder="Cari catatan..." 
                                               class="w-full px-4 py-2 bg-white/10 border border-white/20 rounded-xl 
                                                      focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent 
                                                      placeholder-gray-400 text-white"
                                                value="{{ request('q') }}">
                                        <button type="submit" class="absolute right-3 top-2.5">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <!-- Tombol Reset -->
                                    @if(request('q'))
                                    <a href="{{ route('notes.index') }}" 
                                       class="px-4 py-2 bg-white/10 border border-white/20 rounded-xl text-white hover:bg-white/20 
                                              transition-all duration-300 flex items-center gap-2 hover:scale-105">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                        Reset
                                    </a>
                                    @endif
                                </form>
                            </div>
                            @endif

                            <!-- Navigation Links -->
                            <div class="flex items-center gap-4">
                                <!-- ... kode navigasi lainnya ... -->
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Content -->
                <div class="p-6 mt-4">
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-400/20 text-white rounded-xl border border-green-400/30 backdrop-blur-xl animate-fade-in">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Particle.js configuration yang lebih colorful
            particlesJS("particles-js", {
                particles: {
                    number: { value: 80, density: { enable: true, value_area: 800 } },
                    color: { value: ["#ffffff", "#f0f0f0"] },
                    shape: { type: "circle" },
                    opacity: {
                        value: 0.2,
                        random: true,
                        animation: { enable: true, speed: 1, opacity_min: 0.1, sync: false }
                    },
                    size: {
                        value: 5,
                        random: true,
                        animation: { enable: true, speed: 4, size_min: 0.3, sync: false }
                    },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: "#ffffff",
                        opacity: 0.2,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 2,
                        direction: "none",
                        random: true,
                        straight: false,
                        out_mode: "out",
                        bounce: false,
                    }
                },
                interactivity: {
                    detect_on: "canvas",
                    events: {
                        onhover: { enable: true, mode: "bubble" },
                        onclick: { enable: true, mode: "push" },
                        resize: true
                    },
                    modes: {
                        bubble: {
                            distance: 200,
                            size: 8,
                            duration: 0.4,
                            opacity: 0.3,
                            speed: 3
                        },
                        push: { particles_nb: 4 }
                    }
                },
                retina_detect: true
            });
        });

        // Sidebar toggle logic
        const sidebar = document.getElementById('sidebar');
        const toggleSidebar = document.getElementById('toggleSidebar');
        const closeSidebar = document.getElementById('closeSidebar');

        function toggleSidebarVisibility() {
            sidebar.classList.toggle('-translate-x-full');
        }

        toggleSidebar.addEventListener('click', toggleSidebarVisibility);
        closeSidebar?.addEventListener('click', toggleSidebarVisibility);

        if (window.innerWidth < 1024) {
            sidebar.classList.add('-translate-x-full');
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Update fungsi konfirmasi logout
        function showLogoutConfirmation() {
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Apakah Anda yakin ingin keluar?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#ec4899',
                cancelButtonColor: '#9ca3af',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal',
                background: 'rgba(255, 255, 255, 0.9)',
                backdrop: `
                    rgba(0,0,0,0.4)
                    url("/images/nyan-cat.gif")
                    left top
                    no-repeat
                `,
                customClass: {
                    popup: 'rounded-xl',
                    title: 'text-gray-800',
                    text: 'text-gray-600',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Logout Berhasil!',
                        text: 'Anda akan diarahkan ke halaman utama...',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        background: 'rgba(255, 255, 255, 0.9)',
                        customClass: {
                            popup: 'rounded-xl',
                            title: 'text-gray-800',
                            text: 'text-gray-600',
                        }
                    }).then(() => {
                        document.getElementById('logoutForm').submit();
                    });
                }
            });
        }

        // Reinitialize particles on page load and navigation
        function initializeParticles() {
            if (typeof particlesJS !== 'undefined') {
                particlesJS("particles-js", {
                    particles: {
                        number: { value: 80, density: { enable: true, value_area: 800 } },
                        color: { value: ["#ffffff", "#f0f0f0"] },
                        shape: { type: "circle" },
                        opacity: {
                            value: 0.2,
                            random: true,
                            animation: { enable: true, speed: 1, opacity_min: 0.1, sync: false }
                        },
                        size: {
                            value: 5,
                            random: true,
                            animation: { enable: true, speed: 4, size_min: 0.3, sync: false }
                        },
                        line_linked: {
                            enable: true,
                            distance: 150,
                            color: "#ffffff",
                            opacity: 0.2,
                            width: 1
                        },
                        move: {
                            enable: true,
                            speed: 2,
                            direction: "none",
                            random: true,
                            straight: false,
                            out_mode: "out",
                            bounce: false,
                        }
                    },
                    interactivity: {
                        detect_on: "canvas",
                        events: {
                            onhover: { enable: true, mode: "bubble" },
                            onclick: { enable: true, mode: "push" },
                            resize: true
                        },
                        modes: {
                            bubble: {
                                distance: 200,
                                size: 8,
                                duration: 0.4,
                                opacity: 0.3,
                                speed: 3
                            },
                            push: { particles_nb: 4 }
                        }
                    },
                    retina_detect: true
                });
            }
        }

        // Call on page load
        document.addEventListener('DOMContentLoaded', initializeParticles);

        // Call on navigation (if using Turbolinks or similar)
        document.addEventListener('turbolinks:load', initializeParticles);
    </script>
</body>
</html> 