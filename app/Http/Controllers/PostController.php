<?php
// Deskripsi file: app/Http/Controllers/PostController.php
namespace App\Http\Controllers;

// Model Post digunakan untuk membaca dan memperbarui data post.
use App\Models\Post;
// Inertia digunakan untuk mengirim data dan merender halaman Vue.
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // Mengambil semua post dari database dan mengurutkannya berdasarkan data terbaru.
        $posts = Post::latest()->get();

        // Mengirim daftar post ke halaman daftar data pada frontend.
        return Inertia::render('Post/Index', [
            'posts' => $posts
        ]);
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        // Menampilkan halaman formulir untuk menambah post baru.
        return Inertia::render('Post/Create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // Memastikan judul dan isi post wajib diisi.
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        // Membuat record post baru berdasarkan input pengguna.
        $post = Post::create([
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        if ($post) {
            // Mengarahkan pengguna kembali ke daftar dan menampilkan pesan berhasil.
            return Redirect::route('posts.index')->with('message', 'Data Berhasil Disimpan!');
        }
    }

    /**
     * edit
     *
     * @param  mixed $post
     * @return void
     */
    public function edit(Post $post)
    {
        // Mengirim data post yang dipilih ke halaman edit.
        return Inertia::render('Post/Edit', [
            'post' => $post
        ]);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Post $post)
    {
        // Memvalidasi data baru sebelum proses pembaruan dijalankan.
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        // Memperbarui judul dan isi post pada database.
        $post->update([
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        if ($post) {
            // Mengarahkan pengguna ke daftar setelah data berhasil diperbarui.
            return Redirect::route('posts.index')->with('message', 'Data Berhasil Diupdate!');
        }
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        // Mencari post berdasarkan ID yang dikirim dari halaman.
        $post = Post::findOrfail($id);

        // Menghapus record post dari database.
        $post->delete();

        if ($post) {
            // Mengarahkan pengguna kembali dan menampilkan pesan penghapusan berhasil.
            return Redirect::route('posts.index')->with('message', 'Data Berhasil Dihapus!');
        }
    }
}
