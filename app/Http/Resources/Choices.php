<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Choices extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this ->choices;
    }
}
