<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MarkResource extends JsonResource {

	public function toArray($request) {


		return [
			'id' => $this->id,
			'point' => $this->point,
			'tag' => __($this->tag),
			'note' => $this->note,
			'createdAt' => $this->created_at->diffForHumans(),
		];
	}
}
