<x-main-layout>
    <!-- Container dengan padding top untuk memberikan jarak dari navbar -->
    <div class="max-w-5xl mx-auto px-4 pt-24">
        <!-- Header Section dengan margin bottom yang lebih besar -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-white mb-4">Tentang Aplikasi</h1>
            <p class="text-white/70 text-lg max-w-2xl mx-auto">
                Solusi pencatatan digital yang elegan dan mudah digunakan
            </p>
        </div>

        <!-- Main Content dengan spacing yang lebih baik -->
        <div class="grid md:grid-cols-2 gap-8 mb-16">
            <!-- App Info Card -->
            <div class="bg-white/10 backdrop-blur-xl p-8 rounded-2xl border border-white/20 
                        hover:scale-105 transition-all duration-300 hover:shadow-lg">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="p-3 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-xl">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white">Sticky Notes</h2>
                </div>
                <p class="text-white/70 mb-6 leading-relaxed">
                    Aplikasi pencatatan online yang membantu Anda menyimpan dan mengelola catatan dengan mudah.
                    Dibuat menggunakan Laravel dan Tailwind CSS dan Particle JS untuk memberikan pengalaman yang modern dan responsif.
                </p>
                <div class="flex items-center space-x-3 text-white/60">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>Versi 1.0.0</span>
                </div>
            </div>

            <!-- Features Card -->
            <div class="bg-white/10 backdrop-blur-xl p-8 rounded-2xl border border-white/20 
                        hover:scale-105 transition-all duration-300 hover:shadow-lg">
                <h3 class="text-2xl font-bold text-white mb-6">Fitur Utama</h3>
                <ul class="space-y-4">
                    <li class="flex items-center space-x-3">
                        <div class="p-2 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <span class="text-white/70">Buat, edit, dan hapus catatan dengan mudah</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <div class="p-2 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <span class="text-white/70">Pencarian catatan yang cepat</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <div class="p-2 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                            </svg>
                        </div>
                        <span class="text-white/70">Antarmuka yang responsif</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <div class="p-2 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <span class="text-white/70">Keamanan data terjamin</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contact Section dengan margin yang lebih baik -->
        <div class="py-12 text-center border-t border-white/10">
            <p class="text-white/70">
                Dibuat dengan ❤️ oleh Tim Pengembang
                <br>
                <a href="mailto:support@stickynotes.com" 
                   class="text-blue-300 hover:text-blue-200 transition-colors duration-300 inline-block mt-2">
                    support@stickynotes.com
                </a>
            </p>
        </div>
    </div>
</x-main-layout> 