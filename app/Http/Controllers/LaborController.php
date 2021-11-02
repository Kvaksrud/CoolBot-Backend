<?php

namespace App\Http\Controllers;

use App\ApiCodes;
use App\Models\BankTransaction;
use App\Models\DiscordRegistration;
use App\Models\LaborReply;
use App\Models\Option;
use App\RegexPatterns;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class LaborController extends Controller
{

    public function doLabor(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        if ($request->expectsJson()) {

            if($request->has(['member_id','guild_id']) === false)
                return ResponseBuilder::error(ApiCodes::MISSING_PARAMETERS);

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

            $laborReply = LaborReply::without(['suggested_by','status_updated_by'])->where('status', '=', 'approved')->inRandomOrder()->first();
            if (!$laborReply)
                return ResponseBuilder::error(ApiCodes::NO_LABOR_REPLY);

            // Check if timer
            $lastLabor = $member->bankAccount->transactions()->where('timer','=','labor')->orderByDesc('created_at')->first();
            $lastCarbon = new Carbon($lastLabor->created_at);
            $nowCarbon = new Carbon();
            $secondsSince = $nowCarbon->diffInSeconds($lastCarbon);
            $restTime = (int)OptionController::getOption('labor','rest_time'); // Seconds
            if($secondsSince < $restTime){
                return ResponseBuilder::error(ApiCodes::TOO_TIRED,null,['message'=>'You are to tired to work right now.','seconds_left'=>($restTime - $secondsSince)]);
            }

            $wage = self::wage();
            $transaction = $member->bankAccount->transactions()->create([
                'type' => 'deposit',
                'target' => $laborReply->target,
                'amount' => $wage,
                'description' => ($laborReply->text_before.' '.$wage.' '.$laborReply->text_after),
                'timer' => 'labor',
            ]);

            return ResponseBuilder::success($transaction);
        }
        abort(404);
    }

    /**
     * @return int Returns a wage between minimum and maximum defines in the options
     */
    public static function wage(): int
    {
        return rand((int)OptionController::getOption('labor','minimum_wage'),(int)OptionController::getOption('labor','maximum_wage'));
    }
}
