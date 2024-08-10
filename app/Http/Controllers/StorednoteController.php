<?php

namespace App\Http\Controllers;

use App\Models\Storednote;
use Illuminate\Http\Request;

class StorednoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        $storednotes = Storednote::all();
        return view('storednote.create', compact('storednotes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'content' => 'required'
        ]);

        $loggedUser = auth()->user();


        Storednote::create([
            'content' => $request->content,
            'user_id' => $loggedUser->id
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Storednote  $storednote
     * @return \Illuminate\Http\Response
     */
    public function show(Storednote $storednote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Storednote  $storednote
     * @return \Illuminate\Http\Response
     */
    public function edit(Storednote $storednote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Storednote  $storednote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Storednote $storednote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Storednote  $storednote
     * @return \Illuminate\Http\Response
     */
    public function delete(Storednote $storednote)
    {
        $loggedUser = auth()->user();

        if ($storednote->user_id == $loggedUser->id) {

            $storednote->delete();
        }

        return back();
    }
}
