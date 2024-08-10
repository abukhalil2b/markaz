<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentHasDuaaResource extends JsonResource
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
            'start_at'=>$this->start_at,
            'tobedone_at'=>$this->tobedone_at,
            'done_at'=>$this->done_at,
            'evaluation'=>$this->evaluation=='لم ينجح'?'لم ينجح':$this->evaluation,
            'numwrong'=>$this->numwrong,
            'notes'=>$this->notes,
            'ignore_timing'=>$this->ignore_timing,
            'timing_status'=>$this->timing_status,
            'duaaTitle'=>$this->duaa->title,
            'duaaContent'=>$this->duaa->content,
            'duaaContentType'=>$this->content_type
        ];
    }
}
