<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                'appointment' => (string)$this->id,
                'patient_id' => $this->user_id,
                'book_day' => $this->day,
                'book_month' => $this->month,
                'book_year' => $this->year,
                'book_hour' => $this->hour,
                'book_minute' => $this->minute,
                'medical_field' => $this->specialization,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,             
            ];
    }
}
