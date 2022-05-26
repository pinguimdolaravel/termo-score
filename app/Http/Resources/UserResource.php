<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'password' => $this->when(
                $request->user()->can('view', $this->resource),
                $this->password
            ),
            'name'       => $this->name,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
