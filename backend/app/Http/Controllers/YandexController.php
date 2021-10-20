<?php

namespace App\Http\Controllers;

use App\Jobs\YandexJob;
use Illuminate\Support\Facades\Storage;
use App\Models\UserAccountProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class YandexController extends Controller
{
    public function index(Request $request){

        $text = $request->text;
        $lang = 'ru-RU';
        $speed = $request->speed;
        $voice = $request->voice;
        $emotion = $request->emotion;
       
        $rand = Str::random(5).date('s');
        $account = UserAccountProvider::where('id',1)->where('user_id',1)->first();
        $FORMAT_OPUS = "oggopus";
         YandexJob::dispatch($text, $lang,$speed, $voice,$emotion, $account, $FORMAT_OPUS, $rand);
        return '/storage/yandex/'. $rand .'.ogg';
    }

}
