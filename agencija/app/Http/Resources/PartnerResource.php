<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Controllers\PartnerController;


class PartnerResource extends JsonResource
{

     public static $wrap = 'partner';
     public function toArray($request)
     {
         return [
             'id'=>$this->resource->id,
             'name'=>$this->resource->name,
             'contact'=>$this->resource->contact,
             'type'=>$this->resource->type,
             
         ];
     }
 
   
}
