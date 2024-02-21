<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'author' => $this->author,
            'realase_year' => $this->release_at->year,
            'publisher' => $this->publisher,
            'stastus' => $this->status,
            'client' => $this->whenLoaded('activeLoan', function () {
                return ClientResource::make($this->activeLoan->client);
            })
        ];
    }
}
