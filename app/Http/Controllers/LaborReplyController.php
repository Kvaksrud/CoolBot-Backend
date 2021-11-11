<?php

namespace App\Http\Controllers;

use App\ApiCodes;
use App\Models\DiscordRegistration;
use App\Models\LaborReply;
use App\RegexPatterns;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class LaborReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        if($request->expectsJson()){
            $status = $request->has('status') ? $request->get('status') : null;
            $laborReplies = LaborReply::when($status, function($query,$status){
                return $query->where('status','=',$status);
            })->get();
            return ResponseBuilder::success($laborReplies);
        }

        $replies = LaborReply::all();
        return view('labor_reply/index')->with('replies',$replies);
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
        if($request->expectsJson()){
            /**
             * Validate request
             */
            $request->validate([
                'guild_id' => ['required','integer'],
                'member_id' => ['required','integer'],
                'text_before' => ['required','string'],
                'text_after' => ['required','string'],
                'target' => ['required',Rule::in(['balance','wallet'])]
            ]);

            /**
             * Check if suggestion already exists
             */
            $search = LaborReply::where('text_before','LIKE',$request->get('text_before'))->where('text_after','LIKE',$request->get('text_after'))->get();
            if($search->count() > 0)
                return ResponseBuilder::error(ApiCodes::ALREADY_EXISTS);

            // Check if member exists
            $member = DiscordRegistration::where('guild_id','=',$request->get('guild_id'))->where('member_id','=',$request->get('member_id'))->first();
            if(!$member)
                return ResponseBuilder::error(ApiCodes::NOT_EXISTS,null,['member_id' => 'The member does not exist']);

            // Add suggestion
            $suggestion = new LaborReply();
            $suggestion->discord_registration_id = $member->id;
            $suggestion->text_before = $request->get('text_before');
            $suggestion->text_after = $request->get('text_after');
            $suggestion->target = $request->get('target');
            try {
                $suggestion->save();
            } catch(Exception $exception){
                return ResponseBuilder::error(ApiCodes::FAILED_SAVING,null,['errorMessage' => $exception->getMessage()]);
            }
            return ResponseBuilder::success($suggestion);
        }

        abort(404); // Non-json is not supported at this time
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LaborReply  $laborReply
     * @return \Illuminate\Http\Response
     */
    public function show(LaborReply $laborReply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LaborReply  $laborReply
     * @return \Illuminate\Http\Response
     */
    public function edit(LaborReply $laborReply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LaborReply  $laborReply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaborReply $laborReply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LaborReply  $laborReply
     * @return \Illuminate\Http\Response
     */
    public function destroy(LaborReply $laborReply)
    {
        //
    }
}
