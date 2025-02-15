<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Buat Catatan Baru</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Open+Sans:wght@400;700&family=Lato:wght@400;700&family=Poppins:wght@400;700&family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@400;700&family=Raleway:wght@400;700&family=Merriweather:wght@400;700&family=Source+Sans+Pro:wght@400;700&family=Cormorant+Garamond:wght@400;700&family=Crimson+Text:wght@400;700&family=Libre+Baskerville:wght@400;700&family=Quicksand:wght@400;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .paper {
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 8px;
            background-image: 
                linear-gradient(rgba(18, 147, 216, 0.1) .1em, transparent .1em),
                linear-gradient(90deg, rgba(18, 147, 216, 0.04) 1px, transparent 1px);
            background-size: 100% 1.2em, 1.2em 100%;
            padding: 0.5rem;
            line-height: 1.2em;
            backdrop-filter: blur(10px);
        }
        
        .floating-card {
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .floating-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        /* Font classes */
        .font-roboto { font-family: 'Roboto', sans-serif; }
        .font-opensans { font-family: 'Open Sans', sans-serif; }
        .font-lato { font-family: 'Lato', sans-serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }
        .font-comic { font-family: 'Comic Neue', cursive; }
        
        .font-selector.active {
            @apply bg-gradient-to-r from-blue-500 to-purple-500 text-white border-transparent;
        }
        
        .font-selector:hover {
            transform: translateY(-2px);
        }

        .icon-animate {
            animation: bounce 1.5s ease infinite;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }

        .modal-content {
            z-index: 60;
            position: relative;
        }

        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .font-option-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .font-selector {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
            color: #1a1a1a;
            min-width: 140px;
        }

        .font-selector.active {
            @apply bg-gradient-to-r from-blue-500 to-purple-500 text-white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
        }

        .note-input {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .note-input:focus {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.2);
            transform: translateY(-2px);
        }

        .paper {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            background-image: 
                linear-gradient(rgba(59, 130, 246, 0.1) .1em, transparent .1em),
                linear-gradient(90deg, rgba(59, 130, 246, 0.04) 1px, transparent 1px);
            background-size: 100% 1.2em, 1.2em 100%;
            padding: 1rem;
            line-height: 1.2em;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .paper:focus {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-hover-effect {
            position: relative;
            overflow: hidden;
        }

        .btn-hover-effect::after {
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
            transition: all 0.3s;
            opacity: 0;
        }

        .btn-hover-effect:hover::after {
            animation: shine 1.5s ease;
            opacity: 1;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) rotate(45deg); }
            100% { transform: translateX(100%) rotate(45deg); }
        }

        .typing-container {
            display: inline-block;
            position: relative;
        }

        .typing-text {
            position: relative;
            color: white;
            font-weight: 600;
        }

        .typing-text::after {
            content: '|';
            position: absolute;
            right: -8px;
            animation: blink 0.7s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        /* Tambahan font classes */
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-montserrat { font-family: 'Montserrat', sans-serif; }
        .font-raleway { font-family: 'Raleway', sans-serif; }
        .font-merriweather { font-family: 'Merriweather', serif; }
        .font-sourcesans { font-family: 'Source Sans Pro', sans-serif; }
        .font-cormorant { font-family: 'Cormorant Garamond', serif; }
        .font-crimson { font-family: 'Crimson Text', serif; }
        .font-baskerville { font-family: 'Libre Baskerville', serif; }
        .font-quicksand { font-family: 'Quicksand', sans-serif; }
        .font-dmserif { font-family: 'DM Serif Display', serif; }

        .fonts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 0.75rem;
        }

        .signature-badge {
            width: 8px;
            height: 8px;
            margin-left: 2px;
            color: #FFD700;
            display: inline-block;
            vertical-align: super;
            font-size: 8px;
        }

        @keyframes wiggle {
            0%, 100% { transform: rotate(-3deg); }
            50% { transform: rotate(3deg); }
        }
        
        .animate-wiggle {
            animation: wiggle 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-400 via-purple-400 to-pink-400 min-h-screen">
    <div id="particles-js"></div>

    <div class="relative z-20">
        <!-- Sticky Header/Navbar -->
        <div class="fixed top-0 left-0 right-0 bg-white/10 backdrop-blur-md border-b border-white/20 z-50">
            <div class="mx-auto max-w-4xl px-4 py-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <svg class="w-10 h-10 text-blue-500 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-transparent bg-clip-text">
                            Sticky Notes
                        </h1>
                    </div>
                    
                    <!-- Navigation Buttons -->
                    <div class="flex gap-4">
                        <button onclick="showLoginModal()"
                            class="group px-6 py-2 bg-white/10 backdrop-blur-md rounded-xl border border-white/20 
                                   hover:bg-white/20 transition-all duration-300 flex items-center gap-2 hover:scale-105 
                                   hover:shadow-lg hover:shadow-white/20">
                            <svg class="w-5 h-5 animate-wiggle text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            <span class="transform group-hover:translate-x-1 transition-transform duration-300 
                                         bg-gradient-to-r from-blue-500 to-purple-500 text-transparent bg-clip-text font-semibold">
                                Masuk
                            </span>
                        </button>
                        <button onclick="showSignupModal()"
                            class="group px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl text-white 
                                   hover:shadow-lg hover:shadow-blue-500/30 transition-all duration-300 flex items-center gap-2 
                                   hover:scale-105">
                            <svg class="w-5 h-5 animate-wiggle" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            <span class="transform group-hover:translate-x-1 transition-transform duration-300 font-semibold">
                                Daftar
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add padding to content to prevent it from hiding behind fixed header -->
        <div class="pt-24">
            <div class="py-8">
                <div class="mx-auto max-w-4xl px-4">
                    <!-- Hero Section -->
                    <div class="text-center mb-12">
                        <h2 class="text-2xl md:text-3xl text-white/90 mb-4">
                            <span class="typing-container">
                                <span id="typewriter" class="typing-text"></span>
                            </span>
                        </h2>
                        <p class="text-white/80 mb-8 max-w-2xl mx-auto">
                            Buat, simpan, dan atur catatan Anda dengan mudah. Dengan berbagai pilihan font dan desain yang menarik, 
                            menulis catatan menjadi lebih menyenangkan!
                        </p>
                        
                        <!-- Feature Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                            <!-- Card 1 -->
                            <div class="floating-card bg-white/10 p-6 rounded-xl backdrop-blur-md border border-white/20">
                                <div class="text-white mb-4">
                                    <svg class="w-8 h-8 mx-auto icon-animate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-white mb-2">Tulis dengan Gaya</h3>
                                <p class="text-white/70">
                                    Pilih dari berbagai font menarik untuk mempersonalisasi catatan Anda
                                </p>
                            </div>

                        <!-- Card 2 -->
                        <div class="floating-card bg-white/10 p-6 rounded-xl backdrop-blur-md border border-white/20">
                            <div class="text-white mb-4">
                                <svg class="w-8 h-8 mx-auto icon-animate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-white mb-2">Mudah Diatur</h3>
                            <p class="text-white/70">
                                Kelola catatan Anda dengan sistem yang simpel dan intuitif
                            </p>
                        </div>

                        <!-- Card 3 -->
                        <div class="floating-card bg-white/10 p-6 rounded-xl backdrop-blur-md border border-white/20">
                            <div class="text-white mb-4">
                                <svg class="w-8 h-8 mx-auto icon-animate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-white mb-2">Aman & Pribadi</h3>
                            <p class="text-white/70">
                                Catatan Anda tersimpan dengan aman dan hanya dapat diakses oleh Anda
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="floating-card bg-white/10 rounded-xl shadow-xl p-8 backdrop-blur-xl border border-white/20">
                <form id="noteForm" onsubmit="event.preventDefault(); saveTempNote();">
                        @csrf
                        <div class="mb-6">
                            <input type="text" 
                                   name="title" 
                                   placeholder="Judul catatan..." 
                                   class="note-input w-full text-2xl font-bold px-4 py-3 focus:outline-none 
                                          placeholder-gray-400/70 text-gray-700"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="text-sm font-medium text-white mb-2 block">Pilih Font:</label>
                            <div class="font-option-container">
                                <div class="fonts-grid">
                                    <button type="button" 
                                            onclick="changeFont('font-playfair')" 
                                            class="font-selector px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 font-playfair">
                                        Playfair
                                    </button>
                                    <button type="button" 
                                            onclick="changeFont('font-montserrat')" 
                                            class="font-selector px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 font-montserrat">
                                        Montserrat
                                    </button>
                                    <button type="button" 
                                            onclick="changeFont('font-raleway')" 
                                            class="font-selector px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 font-raleway">
                                        Raleway
                                    </button>
                                    <button type="button" 
                                            onclick="changeFont('font-merriweather')" 
                                            class="font-selector px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 font-merriweather">
                                        Merriweather
                                    </button>
                                    <button type="button" 
                                            onclick="changeFont('font-sourcesans')" 
                                            class="font-selector px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 font-sourcesans">
                                        Source Sans
                                        <svg class="signature-badge" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </button>
                                    <button type="button" 
                                            onclick="changeFont('font-cormorant')" 
                                            class="font-selector px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 font-cormorant">
                                        Cormorant
                                    </button>
                                    <button type="button" 
                                            onclick="changeFont('font-crimson')" 
                                            class="font-selector px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 font-crimson">
                                        Crimson
                                    </button>
                                    <button type="button" 
                                            onclick="changeFont('font-baskerville')" 
                                            class="font-selector px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 font-baskerville">
                                        Baskerville
                                        <svg class="signature-badge" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </button>
                                    <button type="button" 
                                            onclick="changeFont('font-quicksand')" 
                                            class="font-selector px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 font-quicksand">
                                        Quicksand
                                        <svg class="signature-badge" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </button>
                                    <button type="button" 
                                            onclick="changeFont('font-dmserif')" 
                                            class="font-selector px-4 py-2 rounded-xl transition-all duration-300 hover:scale-105 font-dmserif">
                                        DM Serif
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <textarea name="content" 
                                      id="noteContent"
                                      placeholder="Mulai menulis catatan Anda di sini..." 
                                      class="paper w-full h-64 focus:outline-none placeholder-gray-400/70 
                                             text-gray-700 leading-relaxed resize-none font-roboto"
                                      required></textarea>
                        </div>

                        <div class="flex justify-end">
                       <button type="submit" 
                                class="btn-hover-effect px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-500 
                                text-white rounded-xl transition-all duration-300 shadow-md 
                                hover:shadow-xl hover:scale-105 flex items-center gap-2">
                           <svg class="w-5 h-5 icon-animate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                          </svg>
                            Simpan Catatan
                       </button>
                     </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center backdrop-blur-sm z-50">
        <div class="bg-white/90 backdrop-blur-xl p-8 rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0 modal-content" id="modalContent">
            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Login</h2>
                    <p class="text-gray-500 mt-1">Selamat datang kembali!</p>
                </div>
                <button onclick="hideLoginModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="loginModalForm" class="space-y-6" onsubmit="handleLogin(event)">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" required
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Masukkan email Anda">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Masukkan password Anda">
                </div>

                <button type="submit" 
                        class="w-full py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl hover:shadow-lg">
                    <span>Masuk</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Signup Modal -->
    <div id="signupModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center backdrop-blur-sm z-50">
        <div class="bg-white/90 backdrop-blur-xl p-8 rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="signupModalContent">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Daftar</h2>
                    <p class="text-gray-500 mt-1">Buat akun baru</p>
                </div>
                <button onclick="hideSignupModal()" class="text-gray-400 hover:text-gray-600 transition-colors p-2 hover:bg-gray-100 rounded-full">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="signupModalForm" class="space-y-6" onsubmit="handleSignup(event)">
                @csrf
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <input type="text" name="username" id="username" required
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Masukkan username Anda">
                </div>

                <div>
                    <label for="signup-email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="signup-email" required
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Masukkan email Anda">
                </div>

                <div>
                    <label for="signup-password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" id="signup-password" required
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Masukkan password Anda">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Konfirmasi password Anda">
                </div>

                <button type="submit" 
                        class="w-full py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl hover:shadow-lg">
                    <span>Daftar</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Modal login untuk menyimpan catatan -->
    <div id="saveNoteLoginModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center backdrop-blur-sm z-50">
        <div class="bg-white/90 backdrop-blur-xl p-8 rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="saveNoteModalContent">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Login untuk Menyimpan</h2>
                    <p class="text-gray-500 mt-1">Silakan login untuk menyimpan catatan Anda</p>
                </div>
                <button onclick="hideSaveNoteLoginModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form onsubmit="handleSaveNoteLogin(event)" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 rounded-xl border focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 rounded-xl border focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl hover:shadow-lg transition-all duration-300">
                    Login & Simpan Catatan
                </button>
            </form>
        </div>
    </div>

    <script>
        // Particle.js configuration
        particlesJS("particles-js", {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: "#ffffff" },
                shape: { type: "circle" },
                opacity: {
                    value: 0.5,
                    random: true,
                    animation: { enable: true, speed: 1, opacity_min: 0.1, sync: false }
                },
                size: {
                    value: 3,
                    random: true,
                    animation: { enable: true, speed: 2, size_min: 0.1, sync: false }
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: "#ffffff",
                    opacity: 0.4,
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
                        size: 6,
                        duration: 0.2,
                        opacity: 0.8,
                        speed: 3
                    },
                    push: { particles_nb: 4 }
                }
            },
            retina_detect: true
        });

        function handleLogin(e) {
            e.preventDefault();
            
            const form = e.target;
            const formData = new FormData(form);

            fetch('{{ route('login') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '{{ route('notes.index') }}';
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error',
                    text: error.message || 'Gagal login',
                    icon: 'error'
                });
            });
        }

        // Fungsi untuk menyimpan catatan
        function saveNote(redirectUrl) {
            const noteData = {
                title: sessionStorage.getItem('temp_note_title'),
                content: sessionStorage.getItem('temp_note_content'),
                _token: '{{ csrf_token() }}'
            };

            return fetch('{{ route('notes.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(noteData)
            })
            .then(response => response.json())
            .then(data => {
                sessionStorage.removeItem('temp_note_title');
                sessionStorage.removeItem('temp_note_content');
                window.location.href = redirectUrl;
            });
        }

        // Fungsi untuk menampilkan modal
        function showLoginModal() {
            const modal = document.getElementById('loginModal');
            const modalContent = document.getElementById('modalContent');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        // Fungsi untuk menyembunyikan modal
        function hideLoginModal() {
            const modal = document.getElementById('loginModal');
            const modalContent = document.getElementById('modalContent');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Close modal when clicking outside
        document.getElementById('loginModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideLoginModal();
            }
        });

        function changeFont(fontClass) {
            const noteContent = document.getElementById('noteContent');
            noteContent.classList.remove(
                'font-playfair', 'font-montserrat', 'font-raleway', 
                'font-merriweather', 'font-sourcesans', 'font-cormorant', 
                'font-crimson', 'font-baskerville', 'font-quicksand', 'font-dmserif'
            );
            noteContent.classList.add(fontClass);
            
            document.querySelectorAll('.font-selector').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
        }

        // Set default active font
        document.querySelector('.font-selector').classList.add('active');

        // Typewriter effect
        const typeWriter = document.getElementById('typewriter');
        const phrases = [
            'Selamat Datang di Sticky Notes! ✨',
            'Catat Momen Berharga Anda... 📝',
            'Dengan Cara yang Indah dan Menarik 🎨',
            'Mulai Menulis Sekarang! ✍️',
            'Simpan Ide Kreatif Anda 💡',
            'Buat Catatan Lebih Berwarna 🌈',
            'Organisir Pikiran Anda 🧠',
            'Jadikan Menulis Lebih Menyenangkan! 🎯',
            'Ekspresikan Kreativitas Anda 🎪',
            'Catatan Anda, Gaya Anda! 🌟'
        ];
        let phraseIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        let isWaiting = false;

        function type() {
            const currentPhrase = phrases[phraseIndex];
            
            if (isDeleting) {
                // Menghapus karakter
                typeWriter.textContent = currentPhrase.substring(0, charIndex - 1);
                charIndex--;
            } else {
                // Menambah karakter
                typeWriter.textContent = currentPhrase.substring(0, charIndex + 1);
                charIndex++;
            }

            // Kecepatan mengetik
            let typeSpeed = isDeleting ? 50 : 100;

            if (!isDeleting && charIndex === currentPhrase.length) {
                // Selesai mengetik, tunggu sebelum menghapus
                isWaiting = true;
                typeSpeed = 2000; // Tunggu 2 detik
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                // Selesai menghapus, pindah ke phrase berikutnya
                isDeleting = false;
                phraseIndex = (phraseIndex + 1) % phrases.length;
                typeSpeed = 500; // Tunggu 0.5 detik sebelum phrase baru
            }

            setTimeout(type, typeSpeed);
        }

        // Mulai efek typewriter saat halaman dimuat
        window.addEventListener('load', type);

        // Fungsi untuk menampilkan modal signup
        function showSignupModal() {
            const modal = document.getElementById('signupModal');
            const modalContent = document.getElementById('signupModalContent');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        // Fungsi untuk menyembunyikan modal signup
        function hideSignupModal() {
            const modal = document.getElementById('signupModal');
            const modalContent = document.getElementById('signupModalContent');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Handle signup form submission
        function handleSignup(e) {
            e.preventDefault();
            
            const form = e.target;
            const formData = new FormData(form);
            
            // Validasi password confirmation
            const password = formData.get('password');
            const passwordConfirmation = formData.get('password_confirmation');
            
            if (password !== passwordConfirmation) {
                Swal.fire({
                    title: 'Pendaftaran Gagal',
                    text: 'Password dan konfirmasi password tidak cocok',
                    icon: 'error',
                    confirmButtonColor: '#3B82F6'
                });
                return;
            }
            
            fetch('{{ route('signup') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData,
                credentials: 'same-origin'
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => Promise.reject(data));
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Pendaftaran Berhasil!',
                        text: 'Silakan login dengan akun baru Anda',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        hideSignupModal();
                        showLoginModal();
                    });
                } else {
                    throw new Error(data.message || 'Pendaftaran gagal');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Pendaftaran Gagal',
                    text: error.message || 'Email sudah terdaftar atau password terlalu pendek (min. 8 karakter)',
                    icon: 'error',
                    confirmButtonColor: '#3B82F6'
                });
            });
        }

        // Close modals when clicking outside
        document.getElementById('signupModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideSignupModal();
            }
        });

        function saveTempNote() {
            const form = document.getElementById('noteForm');
            const formData = new FormData(form);

            // Validasi form
            if (!formData.get('title') || !formData.get('content')) {
                Swal.fire({
                    title: 'Error',
                    text: 'Judul dan konten catatan harus diisi',
                    icon: 'error'
                });
                return;
            }

            // Simpan ke session storage
            sessionStorage.setItem('temp_note_title', formData.get('title'));
            sessionStorage.setItem('temp_note_content', formData.get('content'));
            sessionStorage.setItem('temp_note_font', document.getElementById('noteContent').className);

            // Tampilkan modal login
            showSaveNoteLoginModal();
        }

        function handleSaveNoteLogin(e) {
            e.preventDefault();
            
            const form = e.target;
            const formData = new FormData(form);

            // Login khusus untuk menyimpan catatan
            fetch('{{ route('login.save.note') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                credentials: 'same-origin',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Gunakan token baru dari response untuk request selanjutnya
                    const noteData = new FormData();
                    noteData.append('title', sessionStorage.getItem('temp_note_title'));
                    noteData.append('content', sessionStorage.getItem('temp_note_content'));
                    noteData.append('font', sessionStorage.getItem('temp_note_font'));
                    noteData.append('_token', data.token);

                    return fetch('{{ route('notes.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': data.token,
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin',
                        body: noteData
                    });
                } else {
                    throw new Error(data.message);
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hapus data temporary
                    sessionStorage.removeItem('temp_note_title');
                    sessionStorage.removeItem('temp_note_content');
                    sessionStorage.removeItem('temp_note_font');

                    // Tampilkan notifikasi sukses
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Login berhasil dan catatan telah disimpan',
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '{{ route('notes.index') }}';
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: error.message || 'Terjadi kesalahan saat login',
                    icon: 'error'
                });
            });
        }

        // Fungsi untuk menampilkan/menyembunyikan modal
        function showSaveNoteLoginModal() {
            const modal = document.getElementById('saveNoteLoginModal');
            const modalContent = document.getElementById('saveNoteModalContent');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function hideSaveNoteLoginModal() {
            const modal = document.getElementById('saveNoteLoginModal');
            const modalContent = document.getElementById('saveNoteModalContent');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
</body>
</html> 