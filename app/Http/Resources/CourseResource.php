<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'mentor' => $this->when($this->relationLoaded('user'), new UserResource($this->user)),
            'progress' => $this->when(auth()->check() && $this->relationLoaded('students'), function () {
                $enrollment = $this->students->where('id', auth()->id())->first();
                return $enrollment ? $enrollment->pivot->progress : null;
            }),
        ];
    }
}
