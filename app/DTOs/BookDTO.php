<?php

namespace App\DTOs;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Auth;

final readonly class BookDTO
{
    /**
     * @param array<int> $authors
     */
    public function __construct(
        public string  $title,
        public string  $image,
        public string  $description,
        public int $release_date,
        public int $owner_id,
        public array $authors,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            image: $data['image'] ?? '',
            description: $data['description'],
            release_date: $data['release_date'],
            owner_id: $data['owner_id'] ?? Auth::id(),
            authors: $data['authors'],
        );
    }

    public static function fromRequest(CreateBookRequest|UpdateBookRequest $request): self
    {
        return self::fromArray($request->validated());
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'image' => $this->image,
            'description' => $this->description,
            'release_date' => $this->release_date,
            'owner_id' => $this->owner_id,
            'authors' => $this->authors,
        ];
    }
}
