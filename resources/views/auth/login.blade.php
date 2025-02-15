<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sticky Notes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
</head>
<body class="bg-gradient-to-br from-blue-400 via-purple-400 to-pink-400 min-h-screen">
    <div id="particles-js" class="fixed inset-0"></div>

    <div class="min-h-screen flex items-center justify-center relative z-10 p-4">
        <div class="max-w-md w-full bg-white/10 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 p-8">
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <svg class="w-12 h-12 text-white animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang Kembali!</h1>
                <p class="text-white/80">Lanjutkan perjalanan mencatat Anda</p>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-500/10 backdrop-blur-md border border-green-500/20 rounded-xl">
                    <div class="flex items-center text-green-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 p-4 bg-red-500/10 backdrop-blur-md border border-red-500/20 rounded-xl">
                    <div class="flex items-center text-red-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-white/90 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" 
                               class="block w-full pl-10 px-4 py-3 bg-white/10 border border-white/20 rounded-xl 
                                      text-white placeholder-white/50 backdrop-blur-md
                                      focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent
                                      transition-all duration-300"
                               placeholder="Masukkan email Anda"
                               required>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-white/90 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" 
                               class="block w-full pl-10 px-4 py-3 bg-white/10 border border-white/20 rounded-xl 
                                      text-white placeholder-white/50 backdrop-blur-md
                                      focus:outline-none focus:ring-2 focus:ring-white/30 focus:border-transparent
                                      transition-all duration-300"
                               placeholder="Masukkan password Anda"
                               required>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full py-3 bg-white/20 backdrop-blur-md rounded-xl text-white 
                               hover:bg-white/30 transition-all duration-300 transform hover:scale-[1.02]
                               flex items-center justify-center gap-2">
                    <svg class="w-5 h-5 icon-animate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Masuk
                </button>
            </form>

            <p class="mt-8 text-center text-white/80">
                Belum punya akun? 
                <a href="{{ route('signup.form') }}" 
                   class="font-medium text-white hover:text-white/90 transition-colors duration-300">
                    Daftar disini
                </a>
            </p>
        </div>
    </div>

    <script>
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
    </script>
</body>
</html>
