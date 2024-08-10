<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource {

	public function toArray($request) {

		return [
			'title' => $this->title,
			'action' => $this->action,
			'createdAt' => $this->created_at->diffForHumans(),
		];
	}
}
