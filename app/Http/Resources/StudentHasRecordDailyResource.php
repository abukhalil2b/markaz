<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentHasRecordDailyResource extends JsonResource {

	public function toArray($request) {

		return [
			'id' => $this->id,
			'dayName' => $this->created_at->format('D'),
			'date' => $this->created_at->toDateString(),
			'present' => $this->present_time != null ? 'حاضر' : 'غائب، وسبب الغياب ' . $this->note,
			'presentTime' => $this->present ? date('H:i', $this->present_time) : null,

		];
	}

}
