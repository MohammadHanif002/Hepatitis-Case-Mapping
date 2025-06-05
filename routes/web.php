<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasusController;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/petaSebaran', function () {
    return view('petaSebaran', ['title' => 'Cluster Penyebaran Hepatitis A Jember']);
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

// Route::get('dataKasus', function () {
//     return view('dataKasus', ['title' => 'Data Kasus']);
// });

Route::get('loginAdmin', function () {
    return view('loginAdmin', ['title' => 'Login Admin']);
})->name('loginAdmin');

Route::get('dataKasus', function () {
    return view('dataKasus', ['title' => 'Data Kasus']);
})->name('dataKasus');


// Proses login manual
Route::post('/loginAdmin', function (Request $request) {
    $email = $request->input('email');
    $password = $request->input('password');

    if ($email === 'admin@example.com' && $password === 'admin123') {
        session(['admin_logged_in' => true]); // Set session manual
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('loginAdmin')->with('error', 'Email atau password salah.');
    }
})->name('admin.login');

// Middleware manual (tanpa auth Laravel)
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');

// Route baru untuk menampilkan GeoJSON dengan data kasus hepatitis 
Route::get('/geojson', [MapController::class, 'geojson'])->name('geojson');

Route::post('/petaSebaran', [AdminController::class, 'logout'])->name('logout');

Route::get('/dataKasus', [KasusController::class, 'index'])->name('data.kasus');

Route::get('/grafikKasus', [KasusController::class, 'grafik'])->name('grafikKasus');

Route::get('/searchKasus', [KasusController::class, 'searchKasus']);

Route::get('/', [KasusController::class, 'home']);