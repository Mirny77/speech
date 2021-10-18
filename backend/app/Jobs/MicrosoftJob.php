<?php

namespace App\Jobs;
use App\Http\Controllers\HistoryController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
class MicrosoftJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $text;
    protected $lang;
    protected $voice;
    protected $account;
    protected $rand;
    protected $speed;

    public function __construct($account,$lang,$text,$rand,$voice,$speed)
    {
        $this->text= $text;
        $this->lang = $lang;
        $this->rand= $rand;
        $this->account = $account;
        $this->voice = $voice;
        $this->speed = $speed;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
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
          CURLOPT_POSTFIELDS =>'<speak version=\'1.0\' xml:lang=\''.$this->lang.'\'>
            <voice xml:lang=\''.$this->lang.'\'   name=\''.$this->voice.'\'>
            <prosody rate="'.$this->speed.'%">
                    '.$this->text.'    
                </prosody>
                </voice>
        </speak>',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/ssml+xml',
            'X-Microsoft-Outputformat: audio-16khz-128kbitrate-mono-mp3',
            'Ocp-Apim-Subscription-Key:'.$this->account->token,
            'User-Agent: curl'
          ),
        ));
        
        $response = curl_exec($curl);
        Storage::put('public/microsoft/'. $this->rand .'.wav', $response);
        $audio = '/storage/microsoft/'. $this->rand .'.wav';
        $histoty = new HistoryController();
        $histoty->create($audio,$this->text,$this->lang,$this->voice,3,1);
        
        curl_close($curl);
        return  $histoty;
    }
}
