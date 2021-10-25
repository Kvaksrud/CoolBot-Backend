<?php

namespace App\Http\Controllers;

use App\ApiCodes;
use App\Models\BankAccount;
use App\Models\BankTransaction;
use App\Models\DiscordRegistration;
use App\RegexPatterns;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use function Symfony\Component\String\s;

class BankTransactionController extends Controller
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
        if($request->has(['member_id','guild_id','type','target','amount','description']) === false)
            return ResponseBuilder::error(ApiCodes::MISSING_PARAMETERS);

        if(in_array($request->get('type'),['withdraw','deposit']) === false)
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['type' => 'Type can be either withdraw or deposit']);

        if(in_array($request->get('target'),['wallet','balance']) === false)
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['type' => 'Type can be either wallet or balance']);

        if(is_numeric($request->get('amount')) === false or $request->get('amount') <= 0)
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['amount' => 'Amount must be an integer of positive value']);

        if(is_string($request->get('guild_id')) === false)
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['guild_id' => 'The guild id must be posted as a string because a limitation in JSON int length']);

        if(is_string($request->get('member_id')) === false)
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['member_id' => 'The member id must be posted as a string because a limitation in JSON int length']);

        if(!preg_match(RegexPatterns::DISCORD_ID_REGEX,$request->get('guild_id')))
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['guild_id'=>'Guild ID must be numeric and between 2-20 characters.']);

        if(!preg_match(RegexPatterns::DISCORD_ID_REGEX,$request->get('member_id')))
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['member_id'=> 'Member ID must be numeric (as a string) and between 2-20 characters.']);

        // Check if member exists
        $member = DiscordRegistration::with('bankAccount')->where('guild_id','=',$request->get('guild_id'))->where('member_id','=',$request->get('member_id'))->first();
        if(!$member)
            return ResponseBuilder::error(ApiCodes::NOT_EXISTS,null,['member_id' => 'The member does not exist']);

        // Get bank account
        if($member->bankAccount === null) {
            $member->bankAccount = $member->bankAccount()->create([
                'wallet' => 0,
                'balance' => 0,
            ]);
        }

        // Type
        if($request->has(['timer']))
            $timer = $request->get('timer');
        else
            $timer = null;

        if($request->get('type') === 'deposit'){ // Add money
            $amount = $request->get('amount');
        } elseif($request->get('type') === 'withdraw'){ // Remove money
            $amount = $request->get('amount') - $request->get('amount') * 2;
        } else
            return ResponseBuilder::error(500);

        if($request->get('target') === 'balance'){
            $member->bankAccount->balance = $member->bankAccount->balance + $amount;
            if($member->bankAccount->balance < 0)
                return ResponseBuilder::error(ApiCodes::INSUFFICIENT_FUNDS);
            $member->bankAccount->save();
        } elseif($request->get('target') === 'wallet'){
            $member->bankAccount->wallet = $member->bankAccount->wallet + $amount;
            if($member->bankAccount->wallet < 0)
                return ResponseBuilder::error(ApiCodes::INSUFFICIENT_FUNDS);
            $member->bankAccount->save();
        } else
            return ResponseBuilder::error(500);

        $transaction = $member->bankAccount->transactions()->create([
            'type' => $request->get('type'),
            'target' => $request->get('target'),
            'amount' => $amount,
            'description' => $request->get('description'),
            'timer' => $timer,
        ]);

        return ResponseBuilder::success(BankTransaction::with('bankAccount')->find($transaction->id));
    }

    /**
     * Move money from/to wallet/balance
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \MarcinOrlowski\ResponseBuilder\Exceptions\ArrayWithMixedKeysException
     * @throws \MarcinOrlowski\ResponseBuilder\Exceptions\ConfigurationNotFoundException
     * @throws \MarcinOrlowski\ResponseBuilder\Exceptions\IncompatibleTypeException
     * @throws \MarcinOrlowski\ResponseBuilder\Exceptions\InvalidTypeException
     * @throws \MarcinOrlowski\ResponseBuilder\Exceptions\MissingConfigurationKeyException
     * @throws \MarcinOrlowski\ResponseBuilder\Exceptions\NotIntegerException
     */
    public function transfer(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        if($request->has(['member_id','guild_id','target','amount']) === false)
            return ResponseBuilder::error(ApiCodes::MISSING_PARAMETERS);

        if(in_array($request->get('target'),['wallet','balance']) === false)
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['type' => 'Type can be either wallet or balance']);

        if(is_numeric($request->get('amount')) === false or $request->get('amount') <= 0)
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['amount' => 'Amount must be an integer of positive value']);

        if(is_string($request->get('guild_id')) === false)
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['guild_id' => 'The guild id must be posted as a string because a limitation in JSON int length']);

        if(is_string($request->get('member_id')) === false)
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['member_id' => 'The member id must be posted as a string because a limitation in JSON int length']);

        if(!preg_match(RegexPatterns::DISCORD_ID_REGEX,$request->get('guild_id')))
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['guild_id'=>'Guild ID must be numeric and between 2-20 characters.']);

        if(!preg_match(RegexPatterns::DISCORD_ID_REGEX,$request->get('member_id')))
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['member_id'=> 'Member ID must be numeric (as a string) and between 2-20 characters.']);

        // Check if member exists
        $member = DiscordRegistration::with('bankAccount')->where('guild_id','=',$request->get('guild_id'))->where('member_id','=',$request->get('member_id'))->first();
        if(!$member)
            return ResponseBuilder::error(ApiCodes::NOT_EXISTS,null,['member_id' => 'The member does not exist']);

        if($member->bankAccount === null)
            return ResponseBuilder::error(ApiCodes::NO_BANK_ACCOUNT);

        $amount = $request->get('amount');
        $withdraw = $amount - $amount * 2;
        $deposit = $amount;

        if($request->get('target') === 'balance'){
            $member->bankAccount->wallet = $member->bankAccount->wallet + $withdraw;
            $member->bankAccount->balance = $member->bankAccount->balance + $deposit;
            if($member->bankAccount->balance < 0 or $member->bankAccount->wallet < 0)
                return ResponseBuilder::error(ApiCodes::INSUFFICIENT_FUNDS);
            $member->bankAccount->save();

            $transactionWithdrawal = $member->bankAccount->transactions()->create([
                'type' => 'withdraw',
                'target' => 'wallet',
                'amount' => $withdraw,
                'description' => 'Transfer to wallet'
            ]);
            $transactionDeposit = $member->bankAccount->transactions()->create([
                'type' => 'deposit',
                'target' => 'balance',
                'amount' => $deposit,
                'description' => 'Transfer to wallet'
            ]);
        } elseif($request->get('target') === 'wallet'){
            $member->bankAccount->balance = $member->bankAccount->balance + $withdraw;
            $member->bankAccount->wallet = $member->bankAccount->wallet + $deposit;
            if($member->bankAccount->balance < 0 or $member->bankAccount->wallet < 0)
                return ResponseBuilder::error(ApiCodes::INSUFFICIENT_FUNDS);
            $member->bankAccount->save();

            $transactionWithdrawal = $member->bankAccount->transactions()->create([
                'type' => 'withdraw',
                'target' => 'balance',
                'amount' => $withdraw,
                'description' => 'Transfer to balance'
            ]);
            $transactionDeposit = $member->bankAccount->transactions()->create([
                'type' => 'deposit',
                'target' => 'wallet',
                'amount' => $deposit,
                'description' => 'Transfer to balance'
            ]);
        } else
            return ResponseBuilder::error(500);

        return ResponseBuilder::success([
            'transaction' => [
                'from' => $transactionWithdrawal,
                'to' => $transactionDeposit
            ],
            'bank_account' => BankAccount::find($member->bankAccount->id)
        ]);
    }

    /**
     * Move money between accounts balance -> balance
     */
    public function send(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        if($request->has(['guild_id','from_member_id','to_member_id','amount']) === false)
            return ResponseBuilder::error(ApiCodes::MISSING_PARAMETERS);

        if(is_numeric($request->get('amount')) === false or $request->get('amount') <= 0)
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['amount' => 'Amount must be an integer of positive value']);

        if(is_string($request->get('guild_id')) === false)
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['guild_id' => 'The guild id must be posted as a string because a limitation in JSON int length']);

        if(!preg_match(RegexPatterns::DISCORD_ID_REGEX,$request->get('guild_id')))
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['guild_id'=>'Guild ID must be numeric and between 2-20 characters.']);

        if(is_string($request->get('from_member_id')) === false)
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['from_member_id' => 'The member id must be posted as a string because a limitation in JSON int length']);

        if(!preg_match(RegexPatterns::DISCORD_ID_REGEX,$request->get('from_member_id')))
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['from_member_id'=> 'Member ID must be numeric (as a string) and between 2-20 characters.']);

        if(is_string($request->get('to_member_id')) === false)
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['to_member_id' => 'The member id must be posted as a string because a limitation in JSON int length']);

        if(!preg_match(RegexPatterns::DISCORD_ID_REGEX,$request->get('to_member_id')))
            return ResponseBuilder::error(ApiCodes::INVALID_INPUT,null,['to_member_id'=> 'Member ID must be numeric (as a string) and between 2-20 characters.']);

        // Check if member exists
        $memberFrom = DiscordRegistration::with('bankAccount')->where('guild_id','=',$request->get('guild_id'))->where('member_id','=',$request->get('from_member_id'))->first();
        $memberTo = DiscordRegistration::with('bankAccount')->where('guild_id','=',$request->get('guild_id'))->where('member_id','=',$request->get('to_member_id'))->first();
        if(!$memberFrom)
            return ResponseBuilder::error(ApiCodes::NOT_EXISTS,null,['from_member_id' => 'The member does not exist']);
        if(!$memberTo)
            return ResponseBuilder::error(ApiCodes::NOT_EXISTS,null,['to_member_id' => 'The member does not exist']);

        if($memberFrom->bankAccount === null)
            return ResponseBuilder::error(ApiCodes::NO_BANK_ACCOUNT,null,['from_member_id' => 'The sender does not have a bank account']);

        $amountDeposited = $request->get('amount');
        $amountWithdrawn = $amountDeposited - $amountDeposited * 2;

        // Make sure recipient has a bank account
        if($memberTo->bankAccount === null) {
            $memberTo->bankAccount = $memberTo->bankAccount()->create([
                'wallet' => 0,
                'balance' => 0,
            ]);
        }

        $memberFrom->bankAccount->balance = $memberFrom->bankAccount->balance + $amountWithdrawn;
        $memberFrom->bankAccount->save();
        $transactionFrom = $memberFrom->bankAccount->transactions()->create([
            'type' => 'withdraw',
            'target' => 'balance',
            'amount' => $amountWithdrawn,
            'description' => 'Send money to '.$memberTo->username,
        ]);

        $memberTo->bankAccount->balance = $memberTo->bankAccount->balance + $amountDeposited;
        $memberTo->bankAccount->save();
        $transactionTo = $memberTo->bankAccount->transactions()->create([
            'type' => 'deposit',
            'target' => 'balance',
            'amount' => $amountDeposited,
            'description' => 'Receive money from '.$memberFrom->username,
        ]);

        return ResponseBuilder::success([
            'transaction' => [
                'from' => $transactionFrom,
                'to' => $transactionTo,
            ],
            'bankAccount' => BankAccount::find($memberFrom->id)
        ]);
    }

    /**
     * Search for the specified resource.
     *
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function search(Request $request)
    {
        if($request->has(['guild_id','member_id','type']) === false)
            return ResponseBuilder::error(ApiCodes::MISSING_PARAMETERS);

        if($request->has(['limit']) === false and !is_numeric($request->get('limit')))
            $limit = 25;
        else {
            $limit = $request->get('limit');
        }

        if($request->has(['timer']) === false)
            $timer = null;
        else {
            $timer = $request->get('timer');
        }

        $guild_id = $request->get('guild_id');
        $member_id = $request->get('member_id');
        $search = BankTransaction::whereHas('bankAccount', function($bankAccount) use($guild_id,$member_id){
            //'bankAccount.holder.guild_id','=',$request->get('guild_id')
            $bankAccount->whereHas('holder', function($holder) use($guild_id,$member_id){
                $holder->where('guild_id','=',$guild_id)->where('member_id','=',$member_id);
            });
        })->where('type','=',$request->get('type'))
            ->when($timer, function($query) use ($timer){
                $query->where('timer','=',$timer);
            })->orderByDesc('created_at')
            ->limit($limit)->get();
        return ResponseBuilder::success($search);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(BankTransaction $bankTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(BankTransaction $bankTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankTransaction $bankTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankTransaction $bankTransaction)
    {
        //
    }
}
