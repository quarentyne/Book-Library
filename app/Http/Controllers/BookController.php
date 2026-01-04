<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController
{
    public function index(Request $request): View
    {
        $authors = Author::all();

        return view('book.index', compact('authors'));
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, Book $book)
    {

    }

    public function destroy(Book $book)
    {

    }

    public function show(Request $request, Book $book): View
    {
        return view('book.show', compact('book'));
    }
}
