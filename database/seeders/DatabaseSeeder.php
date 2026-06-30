<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Testimonial;

class DatabaseSeeder extends Seeder
{
    /**
     * টেস্টের জন্য ডেমো ডাটা তৈরি করা হচ্ছে - 3 জন ইউজার, কিছু প্রপার্টি
     */
    public function run(): void
    {
        // ১টা Admin একাউন্ট
        $admin = User::firstOrCreate(
            ['email' => 'admin@lahomes.com'],
            [
                'name' => 'Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // ১টা Agent একাউন্ট
        $agent = User::firstOrCreate(
            ['email' => 'agent@lahomes.com'],
            [
                'name' => 'John Agent',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'agent',
                'phone' => '01700000000',
                'address' => 'Gulshan, Dhaka',
                'experience' => '3 Year',
            ]
        );

        // ১টা Customer একাউন্ট
        $customer = User::firstOrCreate(
            ['email' => 'customer@lahomes.com'],
            [
                'name' => 'Rahim Customer',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );

        // কয়েকটা ডেমো প্রপার্টি
        if (Property::count() == 0) {
            Property::create([
                'name' => 'Modern Family House',
                'category' => 'Residential',
                'price' => 250000,
                'property_for' => 'Sale',
                'bedroom' => 4,
                'bathroom' => 3,
                'sqft' => 2200,
                'floor' => 2,
                'address' => 'Banani, Dhaka',
                'city' => 'Dhaka',
                'country' => 'Bangladesh',
            ]);

            Property::create([
                'name' => 'Cozy Apartment',
                'category' => 'Apartment',
                'price' => 80000,
                'property_for' => 'Rent',
                'bedroom' => 2,
                'bathroom' => 1,
                'sqft' => 950,
                'floor' => 5,
                'address' => 'Dhanmondi, Dhaka',
                'city' => 'Dhaka',
                'country' => 'Bangladesh',
            ]);
        }
        if (Testimonial::count() == 0) {
        Testimonial::create([
            'name' => 'Alice Rahman',
            'designation' => 'Customer',
            'message' => 'Lahomes helped me find my dream home easily!',
            'avatar' => null,
        ]);

        Testimonial::create([
            'name' => 'Karim Hossain',
            'designation' => 'Investor',
            'message' => 'Great platform with verified listings and trusted agents.',
            'avatar' => null,
        ]);
    }

        // টেস্ট করার জন্য একটা ডেমো মেসেজ
        if (\App\Models\Message::count() == 0) {
            \App\Models\Message::create([
                'sender_id'   => $customer->id,
                'receiver_id' => $agent->id,
                'body'        => 'Hi, I am interested in the Cozy Apartment listing. Is it still available?',
            ]);
        }
    }
}
