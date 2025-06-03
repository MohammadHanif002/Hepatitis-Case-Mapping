<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'Cluster Penyebaran Hepatitis A Jember']);
});

Route::get('/posts', function () {

    // $post = Post::with(['author', 'category'])->latest()->get();

    $posts = Post::latest()->get();
    return view('posts', [
        'title' => 'Statistik Kasus',
        'posts' => $posts
    ]);
});

Route::get('/posts/{post:slug}', function (Post $post) {

    return view('post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/authors/{user:username}', function (User $user) {


    // $posts = $user->posts->load('category', 'author');
    return view('posts', ['title' => count($user->posts) . ' Articles by ' . $user->name, 'posts' => $user->posts()]);
});

Route::get('/categories/{category:slug}', function (Category $category) {


    // $posts = $category->posts->load('category', 'author');
    return view('posts', ['title' => ' Articles in:' . $category->name, 'posts' => $category->posts]);
});

Route::get('contact', function () {
    return view('contact', ['title' => 'Data Kasus']);
});

Route::get('loginAdmin', function () {
    return view('loginAdmin', ['title' => 'Login Admin']);
});

Route::get('index', function () {
    return view('index', ['title' => 'Login Admin']);
});

// Memproses form login
Route::post('/loginAdmin', function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    // Contoh login sederhana (tanpa database dan autentikasi Laravel)
    if ($email === 'admin@example.com' && $password === 'admin123') {
        return redirect('/')->with('success', 'Login berhasil!');
    } else {
        return redirect('/loginAdmin')->with('error', 'Email atau password salah.');
    }
})->name('admin.login');


// Route baru untuk menampilkan GeoJSON dengan data kasus hepatitis 
Route::get('/geojson', [MapController::class, 'geojson'])->name('geojson');