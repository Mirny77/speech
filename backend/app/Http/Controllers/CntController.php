<?php

namespace App\Http\Controllers;

use App\Jobs\CntJob;
use Illuminate\Support\Facades\Storage;
use App\Models\UserAccountProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CntController extends Controller
{
    public function index(Request $request){

        $rand = Str::random(5).date('s');
        $text = $request->text;
        $lang = $request->lang;
        $voice = $request->voice;
        $account = UserAccountProvider::where('provider_id',2)->where('user_id',1)->first();
        CntJob::dispatch( $account,$lang, $text,$rand,$voice);
       return '/storage/cnt/'. $rand .'.wav';
    }
}
