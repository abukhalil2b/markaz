<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'reportId' => $this->id,
			'title' => $this->tasktype == 'new' ? 'حفظ ' . $this->soraname : 'مراجعة ' . $this->soraname,
			'range' => $this->whole ? 'كاملة ' : 'من الآية ' . $this->ayafrom . ' إلى الآية ' . $this->ayato,
			'userId' => $this->user && $this->user->id,
			'userName' => $this->user &&  $this->user->first_name . ' ' . $this->user->last_name,
			'dateTobedoneAt' =>$this->tobedone_at ? date('Y-m-d', $this->tobedone_at):'',
			'timeTobedoneAt' =>$this->tobedone_at ? date('H:i', $this->tobedone_at):'',
			'evaluation' => $this->evaluation ? $this->evaluation : '',
			'note' => $this->note ? $this->note : '',
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
