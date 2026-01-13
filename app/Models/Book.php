<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $guarded = [];

    #[Scope]
    protected function withSearch(Builder $query, string $search): void
    {
        $query->where('title', 'like', '%' . $search . '%')
            ->orWhereHas('authors', function ($query) use ($search) {
                $query->where('firstname', 'like', '%' . $search . '%')
                    ->orWhere('lastname', 'like', '%' . $search . '%')
                    ->orWhereRaw("CONCAT(lastname, ' ', firstname) LIKE ?", ["%{$search}%"])
                    ->orWhereRaw("CONCAT(firstname, ' ', lastname) LIKE ?", ["%{$search}%"]);
            });
    }

    #[Scope]
    protected function withSort(Builder $query, string $sort, string $direction): void
    {
        $query->orderBy($sort, $direction);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (string $image) => empty($image) ? null : asset('storage/' . $image),
        );
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $title) => ucfirst($title),
        );
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_book', 'book_id', 'author_id');
    }
}
