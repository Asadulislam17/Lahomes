<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\PropertyController;



Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/dashboard', function () {
    
    return view('dashboards.customer'); 
})->middleware(['auth', 'verified', 'role:customer'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


Route::middleware(['auth', 'verified', 'role:agent'])->group(function(){
    Route::get('/agent/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
});


Route::get('/customers/details', function () {
    return view('customers.details'); 
})->middleware(['auth', 'role:customer'])->name('customers.details');


// প্রোপার্টি রাউট গ্রুপ (শুধু লগইন করা Admin এবং Agent প্রবেশ করতে পারবে)
Route::middleware(['auth'])->group(function () {
    Route::get('/property/grid', [PropertyController::class, 'grid'])->name('property.grid');
    Route::get('/property/list', [PropertyController::class, 'list'])->name('property.list');
    Route::get('/property/details', [PropertyController::class, 'details'])->name('property.details');
    Route::get('/property/add', [PropertyController::class, 'add'])->name('property.add');
});

// কন্ট্রোলার ব্যবহার করে অর্ডার রাউট
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
// কন্ট্রোলার ব্যবহার করে ট্রানজেকশন রাউট
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index')->middleware('auth');
// কন্ট্রোলার ব্যবহার করে মেসেজ রাউট
Route::get('/messages', [MessageController::class, 'index'])->name('messages.index')->middleware('auth');
// কন্ট্রোলার ব্যবহার করে ইনবক্স রাউট
Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index')->middleware('auth');





require __DIR__.'/auth.php';
