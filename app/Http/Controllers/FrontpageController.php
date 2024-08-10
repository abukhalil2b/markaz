<?php

namespace App\Http\Controllers;

use App\Models\Frontpage;
use Illuminate\Http\Request;

class FrontpageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show()
    {
        $frontpage = Frontpage::first();

        return view('admin.frontpage.show', compact('frontpage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required'
        ]);

        Frontpage::truncate();

        Frontpage::create($data);

        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Frontpage $frontpage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Frontpage $frontpage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Frontpage $frontpage)
    {
        //
    }
}
