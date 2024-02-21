<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookBorrowRequest;
use App\Http\Requests\BookReturnRequest;
use App\Http\Resources\BookDetailResource;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    function __construct(
        public BookService $bookService = new BookService()
    ){}

    public function index(Request $request)
    {
        return BookResource::collection(
            $this->bookService->index($request)
        );
    }

    public function show(Book $book)
    {
        return BookDetailResource::make($book);
    }

    public function return(BookReturnRequest $request, Book $book)
    {
        $this->bookService->return($book);

        return response()->json([
            'status' => 'success',
            'message' => 'Book returned successfully'
        ]);
    }

    public function borrow(BookBorrowRequest $request, Book $book)
    {
        $this->bookService->borrow($book, $request);

        return response()->json([
            'status' => 'success',
            'message' => 'Book borrowed successfully'
        ]);
    }
}
