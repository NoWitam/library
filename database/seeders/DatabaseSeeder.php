<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    { 
        User::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'name' => 'Hubert',
            'surname' => 'Golewski'
        ]);

        User::factory()->times(10)->create();

        Artisan::call('generate:book');

        Loan::factory()->times(Book::count())->create();
    }
}
