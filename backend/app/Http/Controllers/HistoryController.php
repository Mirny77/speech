<?php

namespace App\Http\Controllers;

use App\Filters\HistoryFilter;
use App\Models\History;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HistoryController extends Controller
{
    public function index(HistoryFilter $request){

      

        $history = History::filter($request)->where('user_id',1)->orderByDesc('created_at')->with('provider')->paginate(30);
       
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
    public function delete(int $id){
        $history = History::where('user_id',1)->where('id',$id)->first();
        if($history){
            $rep =   str_replace('/storage','', $history->audio);
           Storage::disk('public')->delete($rep);
      
        $history->delete();
        }
        return redirect('/');
    }
   
}
