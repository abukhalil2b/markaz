<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WarnabsentResource extends JsonResource {

	public function toArray($request) {
		return [
			'id' => $this->id,
			'absent' => $this->absent?true:false,
		];
	}
}
