<?php

namespace App\Http\Resources;

use App\Models\Destination;
use App\Models\Partner;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArrangementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $destinationId = $this->destination_id;
        $promotionId = $this->promotion_id;
        $partnerId = $this->partner_id;

        $destination = Destination::find($destinationId);
        $promotion = Promotion::find($promotionId);
        $partner = Partner::find($partnerId);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'date' => $this->date,
            'description' => $this->description,
            'destination' => $destination,
            'promotion' => $promotion,
            'partner' => $partner,
        ];
    }
}
