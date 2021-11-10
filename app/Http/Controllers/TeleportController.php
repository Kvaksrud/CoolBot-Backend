<?php

namespace App\Http\Controllers;

use App\ApiCodes;
use App\Models\Teleport;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class TeleportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $teleports = Teleport::orderBy('display_name')->get();
        return view('teleport/index')->with('teleports',$teleports);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('teleport/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        if($request->expectsJson())
            return ResponseBuilder::error(ApiCodes::NOT_EXISTS);

        $request->validate([
            'display_name' => ['required','string'],
            'code' => ['required','string'],
            'cost' => ['required','integer'],
            'json_sheet' => ['required','json']
        ]);

        $teleport = new Teleport();
        $teleport->display_name = $request->get('display_name');
        $teleport->code = $request->get('code');
        $teleport->cost = (int)$request->get('cost');
        $teleport->sheet = json_decode($request->get('json_sheet'));
        try {
            $teleport->saveOrFail();
        } catch(Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

        return redirect()->route('Teleport.show',['Teleport'=>$teleport->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teleport  $teleport
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request,$teleport_id)
    {
        $teleport = Teleport::findOrFail($teleport_id);
        return view('teleport.show')->with('teleport',$teleport);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teleport  $teleport
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Request $request, $teleport_id)
    {
        $teleport = Teleport::findOrFail($teleport_id);
        return view('teleport.edit')->with('teleport',$teleport);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teleport  $teleport
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $teleport_id)
    {
        if($request->expectsJson())
            return ResponseBuilder::error(ApiCodes::NOT_EXISTS);

        $teleport = Teleport::findOrFail($teleport_id);

        $request->validate([
            'display_name' => ['required','string'],
            'cost' => ['required','integer'],
        ]);

        $teleport->display_name = $request->get('display_name');
        $teleport->cost = (int)$request->get('cost');

        try {
            $teleport->updateOrFail();
        } catch(Exception $exception){
            return back()->with('error',$exception->getMessage());
        }

        return redirect()->route('Teleport.show',['Teleport'=>$teleport->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teleport  $teleport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teleport $teleport)
    {
        //
    }
}
