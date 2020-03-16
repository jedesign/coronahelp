<?php

namespace App\Http\Resources;

use App\Need;
use Illuminate\Http\Resources\Json\JsonResource;

class NeedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Need $this */
        return [
            'id' => $this->id,
            'title' => $this->title,
            'preview' => $this->preview,
            'description' => $this->description,
            'lat' => $this->user->lat,
            'lng' => $this->user->lng,
            'plz' => $this->user->plz,
            'city' => $this->user->city,
            'username' => $this->user->name
        ];
    }
}
