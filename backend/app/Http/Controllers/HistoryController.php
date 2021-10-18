<?php

namespace App\Http\Controllers;

use App\Models\History;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HistoryController extends Controller
{
    public function index(Request $request){
      $params = $request->all('provider_id','voice', 'lang');
      

    
        $history = History::where('user_id',1)->where($params)->orderByDesc('created_at')->paginate(30);

        return view('speech.index', ['history'=>$history]);

        
    }
    public function create(string $audio,string $text, string $lang, string $voice, int $provider_id, int $user_id){

       $history =  History::create([
            'audio' =>$audio,
            'text' => $text,
            'lang' =>$lang,
            'voice' => $voice,
            'provider_id' =>$provider_id,
            'user_id' => $user_id
        ]);
        return $history;
    }
    public function delete(Request $request){
        $history = History::where('user_id',1)->where('id',$request->id)->first();
        Storage::delete($history->audio);
        $history->delete();
       
        return response()->json('file delete');
    }
   
}
