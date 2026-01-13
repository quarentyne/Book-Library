<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthorController
{
    public function index(Request $request)
    {
        $query = Author::query();

        if($request->get('search')) {
            $query->whereAuthor($request->get('search'));
        }

        if ($request->get('sort')) {
            $query->withSort($request->get('sort'), $request->get('direction', 'ASC'));
        }

        $authors = $query->paginate(15);

        return view('author.index', compact('authors'));
    }

    public function store(AuthorRequest $request)
    {
        $authorData = $request->validated();

        $author = Author::create($authorData);

        return response()->json(['success' => true, 'author' => $author]);
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
