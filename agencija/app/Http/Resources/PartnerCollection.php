<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Controllers\PartnerController;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PartnerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
   
    public static $wrap = 'partners';
    public function toArray($request)
    {
        return parent::toArray($request);
    }

}
