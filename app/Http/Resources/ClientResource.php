<?php

namespace App\Http\Resources;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'surname' => $this->surname,
            'books' => $this->whenLoaded('activeLoans', function () {
                return $this->activeLoans->pluck('book')->map(
                    function (Book $book){
                        return [
                            'name' => $book->name,
                            'status' => $book->status
                        ];
                    }
                );
            })
        ];
    }
}
