<?php

namespace App\Jobs;

use App\Http\Controllers\HistoryController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
class CntJob implements ShouldQueue
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

    public function __construct($account,$lang,$text,$rand,$voice)
    {
        $this->text= $text;
        $this->lang = $lang;
        $this->rand= $rand;
        $this->account = $account;
        $this->voice = $voice;

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
        "domain_id":"'.$this->account->domain_id.'",
        "password": "'.$this->account->password.'",
        "username": "'.$this->account->username.'"
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Accept: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        info($this->account);
      
        curl_close($curl);
    
        $session_id  = json_decode($response);
        if($session_id->{'session_id'}){
       
    
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
        "voice_name":"'.$this->voice.'" ,
        "text": {
            "mime": "text/plain",
            "value": "'.$this->text.'"
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
        
        Storage::put('public/cnt/'. $this->rand .'.wav', base64_decode($data->{'data'}));
        $audio = '/storage/cnt/'. $this->rand .'.wav';
        $histoty = new HistoryController();
        $histoty->create($audio,$this->text,$this->lang,$this->voice,2,1);
        $curl = curl_init();

          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://cloud.speechpro.com/vksession/rest/session',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
              'X-Session-Id:'.$session_id->{'session_id'}
            ),
          ));

          curl_close($curl);
        
                  }
        return response()->json('erorr',401);
    }
}
