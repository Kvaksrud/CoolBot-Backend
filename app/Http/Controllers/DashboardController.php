<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Dinosaur;
use App\Models\DiscordRegistration;
use App\Models\DiscordRole;
use App\Models\LaborReply;
use App\Models\Teleport;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $bankAccounts = BankAccount::all();
        $dinosaurs = Dinosaur::all();
        $replies = LaborReply::where('status','=','approved')->get();
        $discordRoles = DiscordRole::all();
        $teleports = Teleport::all();
        $registrations = DiscordRegistration::all();

        return view('dashboard')
            ->with('bankAccounts',$bankAccounts)
            ->with('dinosaurs',$dinosaurs)
            ->with('replies',$replies)
            ->with('discordRoles',$discordRoles)
            ->with('teleports',$teleports)
            ->with('registrations',$registrations);
    }
}
