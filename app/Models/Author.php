<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $guarded = [];

    #[Scope]
    protected function whereAuthor(Builder $query, string $author): void
    {
        $query->where('firstname', 'like', '%' . $author . '%')
            ->orWhere('lastname', 'like', '%' . $author . '%')
            ->orWhereRaw("CONCAT(lastname, ' ', firstname) LIKE ?", ["%{$author}%"])
            ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%{$author}%"]);
    }

    #[Scope]
    protected function withSort(Builder $query, string $sort, string $direction): void
    {
        $query->orderBy($sort, $direction);
    }

    public function books(): belongsToMany
    {
        return $this->belongsToMany(Book::class, 'author_book');
    }
}
