<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MonthlysubscribeStudentResource extends JsonResource
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
            'id'=>$this->id,
            'amount'=>$this->amount,
            'paid'=>$this->paid==1?true:false,
            'paidDate'=>$this->paid_date,
            'recordmonthly'=>$this->recordmonthly->created_at->getTranslatedMonthName() . ' ' . $this->recordmonthly->created_at->format('Y'),
        ];
    }
}
