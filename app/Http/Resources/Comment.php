<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'post_id' => $this->post_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => $this->user,
        ];
    }
}
