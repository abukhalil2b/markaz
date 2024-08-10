<?php

namespace App\Http\Controllers;

use App\Models\QuranAya;

class QuranController extends Controller {

	public function quranAyas($sowar_id, $ayafrom, $ayato) {
		$ayas = QuranAya::where(['quran_surat_id' => $sowar_id])
			->whereBetween('number', [$ayafrom, $ayato])
			->get();
		return view('quran.ayas', compact('ayas'));
	}

	public function pages() {
		return view('quran.pages');
	}

	public function page($pageNumber) {
		$ayas = QuranAya::where('page_number', $pageNumber)->get();
		return view('quran.page', compact('ayas'));
	}
}
