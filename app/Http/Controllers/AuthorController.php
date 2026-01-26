<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(!Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $authorData = $request->validated();

        $author = Author::create($authorData);

        return response()->json(['success' => true, 'author' => $author], 201);
    }

    public function update(AuthorRequest $request, Author $author)
    {
        if(!Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $author->update($request->validated());

        return response()->json(['success' => true, 'author' => $author]);
    }

    public function destroy(Author $author): RedirectResponse
    {
        if(!auth()->user()->hasRole('admin')) {
            abort(403);
        }

        $author->delete();

        return back();
    }
}
