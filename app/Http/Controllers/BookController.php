<?php

namespace App\Http\Controllers;

use App\DTOs\BookDTO;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class BookController
{
    public function index(Request $request): View
    {
        $authors = Author::withSort('lastname', 'ASC')->get();

        $query = Book::query()->with('authors')->with('user');

        if($request->get('search')) {
            $query->withSearch($request->get('search'));
        }

        if ($request->get('sort')) {
            $query->withSort($request->get('sort'), $request->get('direction', 'ASC'));
        }

        $books = $query->paginate(15);

        return view('book.index', compact('authors', 'books'));
    }

    public function store(CreateBookRequest $request): JsonResponse
    {
        if(Auth::guest()) {
            abort(401);
        }

        $bookData = BookDTO::fromRequest($request);

        $imagePath = $request->file('image')->store('book', 'public');

        $book = Book::create([
            'title'         => $bookData->title,
            'image'         => $imagePath,
            'description'   => $bookData->description,
            'release_date'  => $bookData->release_date,
            'owner_id'      => $bookData->owner_id,
        ]);

        $book->authors()->sync($bookData->authors);

        return response()->json(['success' => true, 'book' => $book], 201);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        if(!Gate::allows('book-edit', $book)) {
            abort(403);
        }

        $bookData = BookDTO::fromRequest($request);

        if($request->hasFile('image')) {
            $path = $request->file('image')->store('book', 'public');
            $book->image = $path;
        }

        $book->title = $bookData->title;
        $book->description = $bookData->description;
        $book->release_date = $bookData->release_date;

        $book->save();

        $book->authors()->sync($bookData->authors);

        return response()->json(['success' => true, 'book' => $bookData]);
    }

    public function destroy(Book $book): RedirectResponse
    {
        if(!Gate::allows('book-edit', $book)) {
            abort(403);
        }

        $book->delete();

        return back();
    }

    public function show(Request $request, Book $book): View
    {
        return view('book.show', compact('book'));
    }
}
