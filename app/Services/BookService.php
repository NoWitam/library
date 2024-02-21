<?php

namespace App\Services;

use App\Enums\UserRole;
use App\Http\Requests\BookBorrowRequest;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookService
{
    public function index(Request $request)
    {
        $books = Book::select(['name', 'id'])->with('activeLoan.client');

        $books = $request->has('search') 
            ? $books->search($request->search)
            : $books;

        return $books->paginate(20);
    }

    public function return(Book $book)
    {
        $book->activeLoan()->update([
            'returned_at' => Carbon::now()
        ]);
    }

    public function borrow(Book $book, BookBorrowRequest $request)
    {
        Loan::create([
            'user_id' => auth()->user()->role === UserRole::ADMIN ? $request->client_id : auth()->id(),
            'book_id' => $book->id,
            'start_at' => Carbon::now(),    
            'end_at' => Carbon::now()->addDays($request->days ?? 30)
        ]);
    }
}