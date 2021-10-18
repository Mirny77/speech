<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\UserAccountProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Controllers\HistoryController;
use App\Models\History;

class YandexJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $text;
    protected $lang;
    protected $speed;
    protected $voice;
    protected $emotion;
    protected $account;
    protected $FORMAT_OPUS;
    protected $rand;
 


    public function __construct($text,$lang,$speed,$voice,$emotion,$account,$FORMAT_OPUS,$rand)
    {
        $this->text= $text;
        $this->lang = $lang;
        $this->speed= $speed;
        $this->voice = $voice;
        $this->emotion= $emotion;
        $this->rand= $rand;
        $this->account = $account;
        $this->FORMAT_OPUS = $FORMAT_OPUS;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = "https://tts.api.cloud.yandex.net/speech/v1/tts:synthesize";
        $post = "text=" .  $this->text . "&lang=".$this->lang."&voice=".$this->voice."&emotion=".$this->emotion."&speed=".$this->speed."&sampleRateHertz=48000&format=" .$this->FORMAT_OPUS;
        $headers = ['Authorization: Api-Key '. $this->account->token];
        $ch = curl_init();
   
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
        
        
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            print "Error: " . curl_error($ch);
        }
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
            $decodedResponse = json_decode($response, true);
            echo "Error code: " . $decodedResponse["error_code"] . "\r\n";
            echo "Error message: " . $decodedResponse["error_message"] . "\r\n";
        } else {
            
          
            Storage::put('public/yandex/'. $this->rand .'.ogg', $response);
            $audio = '/storage/yandex/'. $this->rand .'.ogg';
            $histoty = new HistoryController();
            $histoty->create($audio,$this->text,$this->lang,$this->voice,1,1);
            curl_close($ch);
           
        }
    }
}
