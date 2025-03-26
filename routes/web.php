<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PassController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home/Index', [
        'events' => Event::getIncomingEvents(12),
        'categories' => EventCategory::all(),
    ]);
})->name('home');

Route::get('/search', [EventController::class, 'rechercheEvenements'])
    ->name('search');

Route::get('/code', [TicketController::class, 'show'])
    ->name('qrcode.show');

Route::post('comment', [CommentController::class, 'store'])->name('comment.store');

Route::post('order', [OrderController::class, 'store'])->name('order.store');

Route::inertia('/about', 'Infos/About')
    ->name('about');

Route::inertia('/contact', 'Infos/Contact')
    ->name('contact');

Route::inertia('/faqs', 'Infos/Faqs')
    ->name('faqs');

Route::inertia('/cgu', 'Infos/Cgu')
    ->name('cgu');

Route::inertia('cgv', 'Infos/Cgv')
    ->name('cgv');

require __DIR__ . '/auth.php';
