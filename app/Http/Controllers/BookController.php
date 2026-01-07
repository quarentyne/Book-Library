<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController
{
    public function index(Request $request): View
    {
        $authors = Author::all();

        $query = Book::query()->with('authors');;

        if($request->get('search')) {
            $search = $request->get('search');

            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhereHas('authors', function ($query) use ($search) {
                        $query->where('firstname', 'like', '%' . $search . '%')
                            ->orWhere('lastname', 'like', '%' . $search . '%')
                            ->orWhereRaw("CONCAT(lastname, ' ', firstname) LIKE ?", ["%{$search}%"])
                            ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%{$search}%"]);
                    });
            });
        }

        if ($request->get('sort') === 'title') {
            $direction = $request->get('direction', 'ASC');
            $query->orderBy('title', $direction);
        }

        $books = $query->paginate(15);

        return view('book.index', compact('authors', 'books'));
    }

    public function store(BookRequest $request)
    {
        $bookData = $request->validated();

        $imagePath = $request->file('image')->store('book', 'public');

        $book = Book::create([
            'title'         => $bookData['title'],
            'image'         => $imagePath,
            'description'   => $bookData['description'],
            'release_date'  => $bookData['release_date'],
        ]);

        $book->authors()->sync($bookData['authors']);

        return response()->json(['success' => true, 'book' => $book]);
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
