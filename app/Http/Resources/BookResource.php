<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'stastus' => $this->status,
            'client' => $this->whenLoaded('activeLoan', function () {
                return ClientResource::make($this->activeLoan->client);
            })
        ];
    }
}
