<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Game extends JsonResource
{
    public function toArray($request)
    {
        return [
            'extId' => $this->resource['id'],
            'name' => $this->resource['name'],
            'released_at' => $this->resource['released']
        ];
    }
}
