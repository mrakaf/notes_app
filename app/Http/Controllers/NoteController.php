<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('user_id', auth()->id())
                    ->latest()
                    ->get();
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
                'font' => 'nullable|string'
            ]);

            $note = Note::create([
                'title' => $request->title,
                'content' => $request->content,
                'font' => $request->font ?? 'font-roboto',
                'user_id' => auth()->id()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Catatan berhasil disimpan',
                    'note' => $note
                ]);
            }

            return redirect()->route('notes.index')
                ->with('success', 'Catatan berhasil dibuat!');
        } catch (\Exception $e) {
            \Log::error('Store note error: ' . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan catatan: ' . $e->getMessage()
                ], 500);
            }

            return back()->with('error', 'Gagal menyimpan catatan');
        }
    }

    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $note->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil diperbarui!');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $notes = Note::where('user_id', auth()->id())
                    ->where(function($q) use ($query) {
                        $q->where('title', 'like', "%{$query}%")
                          ->orWhere('content', 'like', "%{$query}%");
                    })
                    ->latest()
                    ->get();

        return view('notes.index', compact('notes'));
    }

    public function history()
    {
        $notes = Note::where('user_id', auth()->id())
                    ->orderBy('updated_at', 'desc')
                    ->get();

        return view('notes.history', compact('notes'));
    }

    public function createC()
    {
        return view('notes.createC');
    }

    public function edit1(Note $note)
    {
        return view('notes.edit1', compact('note'));
    }

    public function downloadTXT(Note $note)
    {
        $content = "Judul: " . $note->title . "\n\n" . $note->content;
        $fileName = $note->title . '.txt';
        
        return response()->streamDownload(function() use ($content) {
            echo $content;
        }, $fileName);
    }
} 