<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsCreate extends Component
{
    use WithFileUploads;

    public $title, $description, $keywords, $news_cover, $content, $author_name;

    protected $messages = [
        'title.required' => 'Judul wajib diisi.',
        'title.unique' => 'Judul sudah digunakan.',
        'author_name.required' => 'Nama penulis wajib diisi.',
        'description.required' => 'Deskripsi wajib diisi.',
        'news_cover.required' => 'Gambar depan wajib diunggah.',
        'news_cover.image' => 'File harus berupa gambar.',
        'news_cover.max' => 'Ukuran gambar maksimal 2MB.',
        'content.required' => 'Isi berita tidak boleh kosong.',
    ];

    public function store()
    {
        $this->validate([
            'title' => 'required|unique:news',
            'author_name' => 'required|string',
            'description' => 'required',
            'keywords' => 'nullable|string',
            'news_cover' => 'required|image|max:2048',
            'content' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (trim(strip_tags($value)) === '') {
                        $fail('Isi berita tidak boleh kosong.');
                    }
                },
            ],
        ]);

        $coverPath = $this->news_cover->store('news_covers', 'public');

        News::create([
            'title' => $this->title,
            'author_name' => $this->author_name,
            'description' => $this->description,
            'keywords' => $this->keywords,
            'news_cover' => $coverPath,
            'content' => $this->content,
            'staff_id' => Auth::id() ?? 1,
        ]);

        return redirect()->route('admin.manage-news')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function uploadTrixImage($file)
    {
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('trix_uploads', $filename, 'public');
        return asset('storage/' . $path);
    }

    public function render()
    {
        return view('livewire.admin.news-create')->layout('components.layouts.dashboard-admin');
    }
}
