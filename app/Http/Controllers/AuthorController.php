<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthorController
{
    public function index()
    {
        $authors = Author::paginate(15);

        return view('author.index', compact('authors'));
    }

    public function store(AuthorRequest $request)
    {

    }
    public function update(AuthorRequest $request, Author $author)
    {
        $author->update($request->validated());

        return response()->json(['success' => true, 'author' => $author]);
    }

    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();

        return back();
    }
}
