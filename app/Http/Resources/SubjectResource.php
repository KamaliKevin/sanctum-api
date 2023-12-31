<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'weekly_hours' => $this->weekly_hours,
            'shift_time' => $this->shift_time,
            'classroom' => $this->classroom,
            'user_id' => $this->user_id,
            'specialty' => [
                'id' => $this->specialty->id,
                'name' => $this->specialty->name
            ],
            'department_id' => $this->department_id,
            // 'created_at' => $this->created_at->toDateTimeString(),
            // 'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
