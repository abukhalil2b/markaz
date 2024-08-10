<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentHasMissionResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'title' => $this->mission_title,
			'description' => $this->description,
			'dateStartAt' => date('d-m-Y', $this->start_at),
			'timeStartAt' => date('H:i', $this->start_at),
			'dateTobeDoneAt' => $this->tobedone_at ? date('d-m-Y', $this->tobedone_at) : '',
			'timeTobeDoneAt' => $this->tobedone_at ? date('H:i', $this->tobedone_at) : '',
			'evaluation' => $this->evaluation ? $this->evaluation : '',
			'note' => $this->notes ? $this->notes : '',
			'numwrong' => $this->numwrong ? $this->numwrong : '',
			'dateDoneAt' => $this->done_at ? date('Y-m-d', $this->done_at) : '',
			'timeDoneAt' => $this->done_at ? date('H:i', $this->done_at) : '',
			'success' => $this->success,
			'islate' => $this->islate,
			'isforgiven' => $this->isforgiven,
			'late' => $this->islate === 1 ? $this->isforgiven === 0 ? 'متأخر' : 'تم مسامحته عن التأخير'
			: ' ',
			'done' => $this->done,
			'whole' => $this->whole,
		];
	}
}
