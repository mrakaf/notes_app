<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catatan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="mb-6 text-3xl font-bold">Edit Catatan</h1>

            <div class="p-6 bg-white rounded-lg shadow">
                <form action="{{ route('notes.update', $note) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="title" class="block mb-2 text-sm font-bold text-gray-700">Judul</label>
                        <input type="text" name="title" id="title" class="w-full px-3 py-2 border rounded" 
                            value="{{ $note->title }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block mb-2 text-sm font-bold text-gray-700">Isi Catatan</label>
                        <textarea name="content" id="content" rows="5" class="w-full px-3 py-2 border rounded" 
                            required>{{ $note->content }}</textarea>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">
                            Update
                        </button>
                        <a href="{{ route('notes.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 