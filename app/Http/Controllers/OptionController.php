<?php

namespace App\Http\Controllers;

use App\ApiCodes;
use App\Models\Option;
use App\Models\OptionCategory;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $categories = OptionCategory::orderBy('name')->get();
        return view('option/index')->with('categories',$categories);
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
            if ($request->has(['category', 'name', 'value']) === false)
                return ResponseBuilder::error(ApiCodes::MISSING_PARAMETERS);

            $category = OptionCategory::where('id','=',$request->get('category'))->first();
            if(!$category)
                return ResponseBuilder::error(ApiCodes::NOT_EXISTS,null,['category' => 'The category does not exist']);

            $option = Option::where('name','=',$request->get('name'))->first();
            if($option)
                return ResponseBuilder::error(ApiCodes::ALREADY_EXISTS,null,$option);

            $option = $category->options()->create([
                'name' => strtolower($request->get('name')),
                'value' => $request->get('value'),
            ]);

            return ResponseBuilder::success($option);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        //
    }

    /**
     * @param string $categoryName
     * @param string $optionName
     */
    public static function getOption(string $categoryName,string $optionName = null){
        $category = OptionCategory::where('name','=',$categoryName)->first();
        if(!$category) return null;
        if($optionName !== null) {
            $option = $category->options()->where('name', '=', $optionName)->first();
            if (!$option) return null;
            return $option->value;
        } else {
            $option = $category->options()->get();
            if ($option->count() < 0) return null;
        }
        return $option;
    }
}
