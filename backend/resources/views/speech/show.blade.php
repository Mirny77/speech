<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <!-- Styles -->
        <style>
            @media screen and (-webkit-min-device-pixel-ratio: 0) {
             
                input[type="range"]::-webkit-slider-thumb {
                    width: 15px;
                    -webkit-appearance: none;
                      appearance: none;
                    height: 15px;
                    cursor: ew-resize;
                    background: #FFF;
                    box-shadow: -405px 0 0 400px #605E5C;
                    border-radius: 50%;
                    
                }
            }
            .color__white{
              color:#FFF !important;
            }
          
        </style>
<style>
  .loader {
    border-top-color: #ad1e1e;
    -webkit-animation: spinner 1.5s linear infinite;
    animation: spinner 1.5s linear infinite;
  }
  
  @-webkit-keyframes spinner {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }
  
  @keyframes spinner {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  </style>

</div> 
     
    </head>
    <body class="antialiased font-sans	 ">
        <div class="wrapper">
          
            <div class="relative  bg-white">
                <div class=" mx-auto px-4 sm:px-6">
                  <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
                    <div class="flex justify-start ">
                      <a href="/">
                        <span class="sr-only">Speech</span>
                        <h1 class="  text-yellow-400 font-bold hover:text-yellow-600 text-4xl"> Speech</h1>
                        {{-- <img class="h-8 w-auto sm:h-10" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt=""> --}}
                      </a>
                    </div>
              
                    <nav class="flex flex-initial   justify-center	lg:flex-1">
                      
              
                      <a href="/" class="text-lg mr-7 font-medium text-gray-500 hover:text-gray-900">
                        История
                      </a>
                      <a href="/speech" class="text-lg font-medium text-gray-500 hover:text-gray-900">
                        Синтезировать текст
                      </a>
      
                    </nav>
                  </div>
                </div>
                <div class="flex  justify-center items-center px-4 sm:px-6 text-3xl	font-semibold font-mono  py-11">
                  Выберете язык, на которм будете синтезировать текст:
                 </div>
<div class="flex  justify-center items-center px-4 sm:px-6 py-11">
            
                <div class=" md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                      <button class="text-white-300 bg-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium" onclick='speech(".ru-RU")'>Синтез текста на русском языке</button>
        
                      <button class="text-white-300  bg-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium" onclick='speech(".en-EN")'>Синтез текста на английском языке</button>
        
                    </div>
                </div>
               
                </div>
                <div class="flex sub__speech justify-center items-center px-4 sm:px-6 py-6 ">
                <div class="hidden ru-RU">
                    <div class="ml-10 flex items-baseline space-x-4">
                      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                      <a href="/speech?provider=1&lang_id=1" class=" speech_href speech_href__red text-red-500 hover:bg-red-700 hover:text-white px-3 py-2 rounded-md text-xl font-semibold" >Яндекс</a>
        
                      <a href="/speech?provider=2&lang_id=2" class=" speech_href speech_href__green__1 text-green-500 hover:bg-green-700 hover:text-white px-3 py-2 rounded-md text-xl font-semibold" >ЦНТ</a>
        
                    </div>
                </div>
                <div class="hidden en-EN">
                  <div class="ml-10 flex items-baseline space-x-4 ">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                    <a href="/speech?provider=2&lang_id=3" class="speech_href speech_href__green__2 text-green-500 hover:bg-green-700 hover:text-white px-3 py-2 rounded-md text-xl font-semibold" >ЦНТ</a>
      
                    <a href="/speech?provider=3&lang_id=4" class=" speech_href speech_href__blue text-blue-500 hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md text-xl font-semibold" >Microsoft</a>
      
                  </div>
              </div>
                
           
            </div>
            <div class=" hidden form__block  mx-auto  w-1/2 sm:px-6" id="yandexRu">
            @if(isset($_GET['provider']))
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                          <div class="grid grid-cols-6 gap-6">
                            
                            <div class="col-span-6 sm:col-span-3">
                              <label for="country" class="block text-sm font-medium text-gray-700">Голос</label>
                              <select id="country" name="country" v-model="voice"  autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                                <option disabled value="">Выберите голос</option>
                                @foreach ($provider->voices as $v)

                              <option value='{{$v->value}}'  >{{$v->key}}</option>
                              @endforeach
                              
                              </select>
                            </div>
                         
                            @if(count($provider->emotions))
                            <div class="col-span-6 sm:col-span-3">
                                <label for="country" class="block text-sm font-medium text-gray-700">Эмоция</label>
                                <select id="country" name="country" v-model="emotion" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                                  <option disabled value="">Выберите эмоцию</option>
                                  @foreach ($provider->emotions as $e)
                                  <option value='{{$e->value}}'>{{$e->value}}</option>
                                  @endforeach
                               
                                </select>
                              </div>
                              @endif
                        </div>
                        @if(count($provider->speeds))
                        <div class="col-span-6 sm:col-span-3 pt-5">
                            <label for="country" class="block text-sm font-medium text-gray-700">Скорость @{{speed}}</label>
                        <input class="rounded-lg overflow-hidden appearance-none bg-gray-400" v-model="speed" type="range" min="0.1" max="3.0" step="0.1" value="1.0" />
                    </div>
                    @endif
                        <div class="col-span-6 sm:col-span-3 pt-5">
                            <label for="about" class="block text-sm font-medium text-gray-700">
                              Текст
                            </label>
                            <div class="mt-1">
                              <textarea id="about" name="about" rows="10" v-model="text"  class=" mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-900 focus:border-gray-500 sm:text-sm" placeholder="Введите текст"></textarea>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                              Limit: @{{text.length}}/{{$provider->limit}} символов
                            </p>
                          </div>
              
                          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <span class="text-red-500 mr-10" v-if="text.length >= limit">Лимит символов превышен</span>
                            <div class=" flex justify-center items-center" v-if="loader">
                              <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-yellow-500"></div>
                            </div>
                            <span v-if ="audio"> <audio controls>
                              <source :src="audio">
                             </audio> </span>
                             <button  v-if ="audio" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded" @click="Delete">Удалить</button>
                            <button v-if="!loader" type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" @click="Yandex">
                                Синтезировать
                            </button>
                          </div>
                
            </div>
            @endif
          </div>
        </div>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
        <script>
            function history(h){
                $( ".history__item__sub_"+h ).toggle( "hidden")

            }
            function speech(h){
              $(this).toggle("bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium R")
              if(h == ".ru-RU"){ 
                   $(".form__block").addClass( "hidden")
                 $(".ru-RU").removeClass( "hidden")
                 $(".en-EN").addClass( "hidden")
              }
            
               else{
                $(".en-EN").removeClass( "hidden")
                 $(".ru-RU").addClass( "hidden")
                 $(".form__block").addClass( "hidden")

                    }
                    }
       
                    
	    var paramsString = document.location.search;
	    var searchParams = new URLSearchParams(paramsString);
      
        var p= searchParams.get("lang_id")
        if(p){
          $(".form__block").removeClass( "hidden")
        }
        if(p==1 || p==2){
          $(".ru-RU").removeClass( "hidden")  
          $(".en-EN").addClass( "hidden")      
         }else if((p==3 || p==4)){
          $(".en-EN").removeClass( "hidden")  
          $(".ru-RU").addClass( "hidden") 
         }
         if (p==1){
          $(".speech_href__red").addClass( "bg-red-700")
          $(".speech_href__red").addClass( "color__white")
         }else if(p==4){
          $(".speech_href__blue").addClass( "bg-blue-700")
          $(".speech_href__blue").addClass( "color__white")
         }else if(p==2){
          $(".speech_href__green__1").addClass( "bg-green-700")
          $(".speech_href__green__1").addClass( "color__white")
         }else if(p==3){
          $(".speech_href__green__2").addClass( "bg-green-700")
          $(".speech_href__green__2").addClass( "color__white")
         }
  
    </script>
     
        

            <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js "></script>
            <script>
              @if(isset($_GET['provider']))
              const speechYandexRU = new Vue({
    el: '#yandexRu',

    data: {
      text:'',
      voice:'',
      speed: '1.0',
      emotion: '',
      audio:'',
      interval:'',
      it:null,
      loader:false,
      limit : {{$provider->limit}}
 
    },
    methods: {

      async Audio(data){
        this.interval =  await setInterval(  () => {
          if(this.audio.length<=0){
        axios.post('/api/check',{'audio':data}).then(((response=>{
          if(response.data==1){
            this.audio = data
            this.loader = false
            clearInterval(this.interval )
          }
        } 
       
                  
              
        )))

          }else{
            clearInterval(this.interval )
          }
          
         
          
      }, 1000);
       
       
      },
        async Yandex(){
          if(this.text&&this.voice&&(this.text.length<=this.limit)){
  
            let speech = {
                voice: this.voice,
                text: this.text,
                speed: this.speed,
                emotion: this.emotion,
                lang:@if(isset($_GET['lang_id'])){{$_GET['lang_id']}}@endif
            }
            clearInterval(this.interval )
            this.audio = ''
           this.loader = true
            await axios.post('/api/{{mb_strtolower($provider->name)}}',speech).then(((  response => {
                if(response.data && !this.audio.length){
                 
                    this.Audio(response.data) 
                  
                    
              
                        
                      }
                })))
          }
        },
        Delete(){
          if(this.audio){
            axios.post('/api/delete',{'audio':this.audio})
            this.audio=''
           console.log('asd')
          }
        }
   
    },
    beforeDestroy(){
      clearInterval(this.interval )
 }
    
  });
  @endif

              </script>
            <script src="{{ asset('js/speech.js')}}"></script>


    </body>
</html>
