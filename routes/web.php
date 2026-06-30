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
use App\Http\Controllers\HomeController; // সব Use ওপরে একসাথে রাখা ভালো

/*
|--------------------------------------------------------------------------
| Public Routes (সবার জন্য উন্মুক্ত)
|--------------------------------------------------------------------------
*/

// অপশন ১: আপনি যদি HomeController ব্যবহার করতে চান (বর্তমানে এটি চালু রাখা হলো)
Route::get('/', [HomeController::class, 'index'])->name('home');

// অপশন ২: কন্ট্রোলার ছাড়া সরাসরি ভিউ দেখাতে চাইলে ওপরের লাইনটি কেটে নিচের ৩ লাইন আনকমেন্ট করুন:
// Route::get('/', function () {
//     $properties = \App\Models\Property::latest()->take(6)->get();
//     return view('welcome', compact('properties'));
// })->name('home');


/*
|--------------------------------------------------------------------------
| Authenticated Routes (লগইন করা ইউজারদের জন্য)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // প্রোফাইল ম্যানেজমেন্ট
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ইনবক্স রাউট
    Route::get('/inbox', [InboxController::class, 'index'])->name('inbox.index');

    // প্রোপার্টি রাউট গ্রুপ 
    Route::get('/property/grid', [PropertyController::class, 'grid'])->name('property.grid');
    Route::get('/property/list', [PropertyController::class, 'list'])->name('property.list');
    Route::get('/property/details', [PropertyController::class, 'details'])->name('property.details');
    Route::get('/property/add', [PropertyController::class, 'add'])->name('property.add');
    Route::post('/property/store', [PropertyController::class, 'store'])->name('property.store');
    Route::get('/property/edit/{id}', [PropertyController::class, 'edit'])->name('property.edit');
    Route::put('/property/update/{id}', [PropertyController::class, 'update'])->name('property.update');
    Route::delete('/property/delete/{id}', [PropertyController::class, 'destroy'])->name('property.delete');

    // কাস্টমারদের প্রোপার্টি দেখার রাউট 
    Route::get('/all-properties', [PropertyController::class, 'publicIndex'])->name('customer.properties.index');
    Route::get('/property-view/{id}', [PropertyController::class, 'publicDetails'])->name('customer.properties.details');

    // এজেন্ট ম্যানেজমেন্ট রাউট
    Route::get('/agents/grid', [AgentsController::class, 'grid'])->name('agents.grid');
    Route::get('/agents/list', [AgentsController::class, 'list'])->name('agents.list');
    Route::get('/agents/details', [AgentsController::class, 'details'])->name('agents.details');
    Route::get('/agents/add', [AgentsController::class, 'add'])->name('agents.add');
    Route::post('/agents/store', [AgentsController::class, 'store'])->name('agents.store');
    Route::delete('/agents/delete/{id}', [AgentsController::class, 'destroy'])->name('agents.delete');

    // অর্ডার রাউট
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::put('/orders/update/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/delete/{id}', [OrderController::class, 'destroy'])->name('orders.delete');

    // ট্রানজেকশন রাউট
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');

    // মেসেজ রাউট
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::post('/messages/send', [MessageController::class, 'store'])->name('messages.store');
});

/*
|--------------------------------------------------------------------------
| Role Based Routes (রোল অনুযায়ী ড্যাশবোর্ড)
|--------------------------------------------------------------------------
*/

// কাস্টমার ড্যাশবোর্ড
Route::middleware(['auth', 'verified', 'role:customer'])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboards.customer'); 
    })->name('dashboard');

    Route::get('/customers/details', function () {
        return view('customers.details'); 
    })->name('customers.details');
});

// অ্যাডমিন ড্যাশবোর্ড
Route::middleware(['auth', 'verified', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// এজেন্ট ড্যাশবোর্ড
Route::middleware(['auth', 'verified', 'role:agent'])->group(function(){
    Route::get('/agent/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
});

require __DIR__.'/auth.php';
