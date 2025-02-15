@php
use Illuminate\Support\Str;
@endphp

<x-main-layout>
    <!-- Modal Edit -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center backdrop-blur-sm z-50">
        <div class="bg-white/10 backdrop-blur-xl p-8 rounded-xl border border-white/20 w-full max-w-2xl mx-4 transform transition-all">
            <form id="editForm" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label for="editTitle" class="block text-white/70 mb-2">Judul</label>
                    <input type="text" 
                           name="title" 
                           id="editTitle"
                           class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white 
                                  focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                           required>
                </div>

                <div class="mb-6">
                    <label for="editContent" class="block text-white/70 mb-2">Isi Catatan</label>
                    <textarea name="content" 
                             id="editContent"
                             rows="8"
                             class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white 
                                    focus:border-blue-500 focus:ring-1 focus:ring-blue-500 resize-none"
                             required></textarea>
                </div>

                <div class="flex justify-between items-center">
                    <button type="button" 
                            onclick="hideEditModal()"
                            class="px-6 py-2 bg-gray-500/30 text-white rounded-lg hover:bg-gray-500/50 
                                   transition-all duration-300 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span>Batal</span>
                    </button>

                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-lg 
                                   hover:shadow-lg hover:scale-105 transition-all duration-300 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="pl-4 pr-8 lg:pl-8">
        <div class="mb-8">
          
            <div class="flex justify-between items-center">
                <div></div>
                <a href="{{ route('notes.createC') }}"
                   class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-xl 
                          hover:shadow-lg hover:scale-105 transition-all duration-300 btn-shine 
                          flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Buat Catatan Baru</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($notes as $note)
                <div class="bg-white/10 backdrop-blur-xl p-6 rounded-xl border border-white/20 
                          hover:scale-102 transition-all duration-300 hover:shadow-lg">
                    <h3 class="text-2xl font-bold mb-3 text-white">{{ $note->title }}</h3>
                    <p class="text-white/70 mb-4">{{ Str::limit($note->content, 100) }}</p>
                    <div class="flex space-x-3">
                        <button onclick="showEditModal({{ $note->id }}, '{{ addslashes($note->title) }}', '{{ addslashes($note->content) }}')"
                            class="px-4 py-2 bg-blue-500/30 text-white rounded-lg hover:bg-blue-500/50 
                                   transition-all duration-300">
                            Edit
                        </button>
                        <a href="{{ route('notes.download.txt', $note) }}" 
                           class="px-4 py-2 bg-green-500/30 text-white rounded-lg hover:bg-green-500/50 
                                 transition-all duration-300 flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            <span>TXT</span>
                        </a>
                        <form action="{{ route('notes.destroy', $note) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-4 py-2 bg-pink-500/30 text-white rounded-lg hover:bg-pink-500/50 
                                           transition-all duration-300"
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function showEditModal(id, title, content) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            const titleInput = document.getElementById('editTitle');
            const contentInput = document.getElementById('editContent');

            // Set form action
            form.action = `/notes/${id}`;
            
            // Set values
            titleInput.value = title.replace(/\\'/g, "'");
            contentInput.value = content.replace(/\\'/g, "'");

            // Show modal
            modal.classList.remove('hidden');
        }

        function hideEditModal() {
            const modal = document.getElementById('editModal');
            modal.classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideEditModal();
            }
        });
    </script>
</x-main-layout> 