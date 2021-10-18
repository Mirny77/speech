<?php

namespace App\Http\Controllers;

use App\Jobs\MicrosoftJob;
use Illuminate\Support\Facades\Storage;
use App\Models\UserAccountProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class MicrosoftController extends Controller
{
  public function index(Request $request){
    $rand = Str::random(5).date('s');
    $text = $request->text;
    $lang = $request->lang;
    $voice = $request->voice;
    $speed = $request->speed;
    $account = UserAccountProvider::where('provider_id',3)->where('user_id',1)->first();
    MicrosoftJob::dispatch( $account,$lang, $text,$rand,$voice, $speed);
   return '/storage/microsoft/'. $rand .'.wav';
  }
}
