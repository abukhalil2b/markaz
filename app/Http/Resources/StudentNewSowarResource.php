<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentNewSowarResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'title' => $this->sowar->title,
			'mission_id' => $this->mission_id,
			'mission_title' => $this->mission_title,
			'ayat' => $this->ayat,
			'done' => $this->done,
			'done_at' => date('d-m-Y', $this->done_at),
		];
	}
}
