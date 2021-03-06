<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Provider;
use Illuminate\Support\Facades\Storage;
use App\Models\UserAccountProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SpeechController extends Controller
{
   public function index(Request $request){

    $text = 'test';

    $account = UserAccountProvider::where('id',1)->first();
     $FORMAT_PCM = "lpcm";
   $FORMAT_OPUS = "oggopus";
   $folderId = 'aje6dhp0jmblr6hjltfi';

    $url = "https://tts.api.cloud.yandex.net/speech/v1/tts:synthesize";
    $post = "text=" .  $text . "&lang=ru-RU&voice=filipp&speed=0.9&sampleRateHertz=48000&format=" .$FORMAT_OPUS;
    $headers = ['Authorization: Api-Key AQVNxmxyCdl12aM69fK5FmN0Ddkz7TwBaUEWsYjW'];
    $ch = curl_init();
    return $ch;
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    if ($post !== false) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    
    return $response = curl_exec($ch);
    if (curl_errno($ch)) {
        print "Error: " . curl_error($ch);
    }
    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
        $decodedResponse = json_decode($response, true);
        echo "Error code: " . $decodedResponse["error_code"] . "\r\n";
        echo "Error message: " . $decodedResponse["error_message"] . "\r\n";
    } else {
        $respons = file_put_contents("speech.ogg", $response);
        Storage::put('/'.Str::random(3).'.ogg', $response);
        curl_close($ch);
        return $response;
    }
   
   }
   public function cnt(){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://cloud.speechpro.com/vksession/rest/session',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'
    {
    "domain_id": 5062,
    "password": "wfyCbhpo9!",
    "username": "mironov.ilya20160@yandex.ru"
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Accept: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);

    $session_id  = json_decode($response);
    if($session_id->{'session_id'}){
    Session::push('cnt_session_id',$session_id->{'session_id'});

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://cloud.speechpro.com/vktts/rest/v1/synthesize',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
    "voice_name": "Anna_n",
    "text": {
        "mime": "text/plain",
        "value": "string"
    },
    "audio": "audio/wav"
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Accept: application/json',
        'X-Session-Id: '.$session_id->{'session_id'}
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    
    $data  = json_decode($response);
    Storage::put(Str::random(3).'/aaaaaa.wav', base64_decode($data->{'data'}));
    return $response;
    }
    return response()->json('erorr',401);
   }
   public function microsoft(){

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://eastus.tts.speech.microsoft.com/cognitiveservices/v1',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'<speak version=\'1.0\' xml:lang=\'en-US\'>
        <voice xml:lang=\'en-US\' xml:speed=\'1.6\'  name=\'en-US-MichelleNeural\'>
        <prosody rate="+0.00%">

            my voice is my passport verify memy voice is my passport verify me      my voice is my passport verify me      my voice is my passport verify me      my voice is my passport verify me      my voice is my passport verify me      my voice is my passport verify me      my voice is my 
            </prosody>
            </voice>
    </speak>',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/ssml+xml',
        'X-Microsoft-Outputformat: audio-16khz-128kbitrate-mono-mp3',
        'Ocp-Apim-Subscription-Key: 9ac0ccb63cd642958924ad7b7b9cb58c',
        'User-Agent: curl'
      ),
    ));
    
    $response = curl_exec($curl);

    curl_close($curl);
    Storage::put(Str::random(3).'/asd.wav', $response);
    echo $response;
    
   }
   public function show(Request $request){
  if($request->provider){
  $provider = Provider::where('id',$request->provider)->with('emotions')->with(["voices" => function($q) use($request){
    $q->where('voices.language_id', '=', $request->lang_id);
}])->with('formats')->with('speeds')->first();

    return view('speech.show',compact('provider'));
  }

    return view('speech.show');
   }

   public function check(Request $request){
    $rep =   str_replace('/storage','', $request->audio);
     $result = Storage::disk('public')->exists($rep);
     return $result;
  }
  public function deleteAudio(Request $request){
    $history = History::where('audio',$request->audio)->first();
    if($history){
    $rep =   str_replace('/storage','', $request->audio);
     $result = Storage::disk('public')->delete($rep);
     $history->delete();
    }
     return $result;
  }
}
