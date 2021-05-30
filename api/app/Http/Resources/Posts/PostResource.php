<?php

namespace App\Http\Resources\Posts;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'price' => $this->price,
            'photo' => $this->photo,
            'author' => $this->user->name,
            'subject' => $this->subject,
            'published' => $this->created_at->format("d F, Y")
        ];
    }
}
