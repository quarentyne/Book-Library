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
            $search = $request->get('search');

            $query->where(function ($query) use ($request, $search) {
                $query->where('firstname', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('lastname', 'like', '%' . $request->get('search') . '%')
                    ->orWhereRaw("CONCAT(lastname, ' ', firstname) LIKE ?", ["%{$search}%"])
                    ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%{$search}%"]);
            });
        }

        if ($request->get('sort') === 'lastname') {
            $direction = $request->get('direction', 'ASC');
            $query->orderBy('lastname', $direction);
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
