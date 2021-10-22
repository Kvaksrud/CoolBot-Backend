<?php

namespace App\Http\Controllers;

use App\ApiCodes;
use App\Models\BankAccount;
use App\Models\DiscordRegistration;
use App\RegexPatterns;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $bankAccounts = BankAccount::with('holder')->get();
        return view('bankaccount.index')->with('bankAccounts',$bankAccounts);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function show(Request $request,int $id)
    {
        if($request->expectsJson()) {
            if ($request->has(['discord_identifier'])) {
                if ($request->has(['guild_id']) !== true)
                    return ResponseBuilder::error(ApiCodes::MISSING_PARAMETERS, null, ['guild_id' => 'Parameter required']);

                if (is_string($request->get('guild_id')) === false)
                    return ResponseBuilder::error(ApiCodes::INVALID_INPUT, null, ['guild_id' => 'The guild id must be posted as a string because a limitation in JSON int length']);

                if (!preg_match(RegexPatterns::DISCORD_ID_REGEX, $request->get('guild_id')))
                    return ResponseBuilder::error(ApiCodes::INVALID_INPUT, null, ['guild_id' => 'Guild ID must be numeric and between 2-20 characters.']);

                if (!preg_match(RegexPatterns::DISCORD_ID_REGEX, $id))
                    return ResponseBuilder::error(ApiCodes::INVALID_INPUT, null, ['member_id' => 'Member ID must be numeric (as a string) and between 2-20 characters.']);

                // Check if member exists
                $member = DiscordRegistration::with('bankAccount')->where('guild_id', '=', $request->get('guild_id'))->where('member_id', '=', $id)->first();
            }

            if (!$member)
                return ResponseBuilder::error(ApiCodes::NOT_EXISTS, null, ['member_id' => 'The member does not exist']);

            if ($member->bankAccount === null)
                return ResponseBuilder::error(ApiCodes::NO_BANK_ACCOUNT);

            return ResponseBuilder::success($member->bankAccount);
        }
        else
        {
            $bankAccount = BankAccount::with(['holder','transactions'])->findOrFail($id);
            $lastTransactions = $bankAccount->transactions()->orderbyDesc('id')->limit(25)->get();
            return view('bankaccount.show')->with('bankAccount',$bankAccount)->with('lastTransactions',$lastTransactions);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bankAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankAccount $bankAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankAccount $bankAccount)
    {
        //
    }
}
