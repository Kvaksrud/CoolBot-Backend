<?php

namespace App\Http\Controllers;

use App\ApiCodes;
use App\Models\Option;
use App\Models\OptionCategory;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class OptionCategoryController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        if($request->expectsJson()) {
            if ($request->has(['name', 'description']) === false)
                return ResponseBuilder::error(ApiCodes::MISSING_PARAMETERS);

            $category = OptionCategory::where('name','=',$request->get('name'))->get();
            if($category->count() > 0)
                return ResponseBuilder::error(ApiCodes::ALREADY_EXISTS,null,['name' => 'The category already exist']);

            $category = new OptionCategory;
            $category->name = $request->get('name');
            $category->description = $request->get('description');
            $category->save();

            return ResponseBuilder::success($category);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OptionCategory  $optionCategory
     * @return \Illuminate\Http\Response
     */
    public function show(OptionCategory $optionCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OptionCategory  $optionCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(OptionCategory $optionCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OptionCategory  $optionCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OptionCategory $optionCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OptionCategory  $optionCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(OptionCategory $optionCategory)
    {
        //
    }
}
