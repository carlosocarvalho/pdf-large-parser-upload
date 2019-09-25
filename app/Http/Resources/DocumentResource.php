<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [

         "name" => $this->name,
         "title" => substr($this->original_name, 0, strlen($this->original_name) - 4),
         "mime" => $this->mime,
         'url' => $this->url,
        ];
    }
}
