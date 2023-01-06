<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IncidentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => 'Incidents',
            'attributes' => [
                'name' => $this->name,
                'country' => $this->country,
                'city' => $this->city,
                'temperature' => $this->temperature,
                'humidity' => $this->humidity,
                'wind_speed' => $this->wind_speed,
            ]

        ];
    }
}
