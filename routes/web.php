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
use App\Http\Controllers\AgentsController;



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
    
    // ডাটাবেজে প্রোপার্টি সেভ করার জন্য এই POST রাউটটি যুক্ত করা হলো
    Route::post('/property/store', [PropertyController::class, 'store'])->name('property.store');

    // 👇 নতুন যোগ করা রাউট (বাটনগুলো সচল করার জন্য)
    Route::get('/property/edit/{id}', [PropertyController::class, 'edit'])->name('property.edit');
    Route::put('/property/update/{id}', [PropertyController::class, 'update'])->name('property.update');
    Route::delete('/property/delete/{id}', [PropertyController::class, 'destroy'])->name('property.delete');
});

// কাস্টমারদের প্রোপার্টি দেখার রাউট
Route::get('/all-properties', [PropertyController::class, 'publicIndex'])->name('customer.properties.index');
Route::get('/property-view/{id}', [PropertyController::class, 'publicDetails'])->name('customer.properties.details');



Route::middleware(['auth'])->group(function () {
    Route::get('/agents/grid', [AgentsController::class, 'grid'])->name('agents.grid');
    Route::get('/agents/list', [AgentsController::class, 'list'])->name('agents.list');
    Route::get('/agents/details', [AgentsController::class, 'details'])->name('agents.details');
    Route::get('/agents/add', [AgentsController::class, 'add'])->name('agents.add');
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
