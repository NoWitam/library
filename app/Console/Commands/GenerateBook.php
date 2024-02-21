<?php

namespace App\Console\Commands;

use App\Models\Book;
use Illuminate\Console\Command;

class GenerateBook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:book {count=60}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate book';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Book::factory()->times($this->argument('count'))->create();
    }
}
