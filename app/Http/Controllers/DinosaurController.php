<?php

namespace App\Http\Controllers;

use App\ApiCodes;
use App\Models\Dinosaur;
use Exception;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class DinosaurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $dinosaurs = Dinosaur::orderBy('display_name')->get();
        return view('dinosaur/index')->with('dinosaurs',$dinosaurs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('dinosaur/create');
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

        $dino = new Dinosaur();
        $dino->display_name = $request->get('display_name');
        $dino->code = $request->get('code');
        $dino->cost = (int)$request->get('cost');
        $dino->sheet = json_decode($request->get('json_sheet'));
        try {
            $dino->saveOrFail();
        } catch(Exception $exception){
            return back()->withErrors($exception->getMessage());
        }

        return redirect()->route('Dinosaur.show',['Dinosaur'=>$dino->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dinosaur  $dinosaur
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request, $dinosaur_id)
    {
        $dinosaur = Dinosaur::findOrFail($dinosaur_id);
        return view('dinosaur.show')->with('dinosaur',$dinosaur)->with('sheet',$dinosaur->sheet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dinosaur  $dinosaur
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $dinosaur_id)
    {
        $dinosaur = Dinosaur::findOrFail($dinosaur_id);
        return view('dinosaur.edit')->with('dinosaur',$dinosaur);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dinosaur  $dinosaur
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function update(Request $request, $dinosaur_id)
    {
        if($request->expectsJson())
            return ResponseBuilder::error(ApiCodes::NOT_EXISTS);

        $dino = Dinosaur::findOrFail($dinosaur_id);

        $request->validate([
            'display_name' => ['required','string'],
            'cost' => ['required','integer'],
        ]);

        $dino->display_name = $request->get('display_name');
        $dino->cost = (int)$request->get('cost');

        try {
            $dino->updateOrFail();
        } catch(Exception $exception){
            return back()->with('error',$exception->getMessage());
        }

        return redirect()->route('Dinosaur.show',['Dinosaur'=>$dino->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dinosaur  $dinosaur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dinosaur $dinosaur)
    {
        //
    }
}
