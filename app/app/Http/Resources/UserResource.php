<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($data): array
    {
        $abilities = [];
        if($this->id === 1) {
            $abilities[] = 'access:admin';
        }
        return [
            'user' => (object)[
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email
            ],
            'token' => $this->createToken('API Token')->plainTextToken,
        ];
    }
}
