<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Speech</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <!-- Styles -->
        <style>
          .pagination_history .text-sm{
display:none;
} 
.pagination_history .font-medium{
  display:block;
}
button{
  position: relative;
  z-index: 10000000;
}
.md\:space-x-10>:not([hidden])~:not([hidden]) {
    --tw-space-x-reverse: 0;
    /* margin-right: calc(2.5rem * var(--tw-space-x-reverse));  */
     margin-left: 0 !important; 
}
   
          </style>

    </head>
    <body class="antialiased font-sans	">
        <div class="wrapper">
            <div class="relative  bg-white">
                <div class=" mx-auto px-4 sm:px-6">
                  <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
                    <div class="flex justify-start ">
                      <a href="/">
                        <span class="sr-only">Text2Speech</span>
                        <h1 class="  text-yellow-400 font-bold hover:text-yellow-600 text-4xl"> Text2Speech</h1>
                        {{-- <img class="h-8 w-auto sm:h-10" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt=""> --}}
                      </a>
                    </div>
              
                    <nav class="flex w-full pl-10 justify-start">
                      
              
                      <a href="/" class="text-lg mr-7 font-medium text-gray-500 hover:text-gray-900">
                        История
                      </a>
                      <a href="/speech" class="text-lg font-medium text-gray-500 hover:text-gray-900">
                        Синтез
                      </a>
      
                    </nav>
                  </div>
                </div>

                <div class=" mx-auto  flex items-center justify-start history__item	  px-12 pt-11">
                  <div class="w-full mr-40">
                    <form action="/" method="get">  
                    <div class="bg-white flex items-center rounded-full shadow-xl">
                      <input class="rounded-l-full w-full py-4 px-6 text-gray-700 leading-tight focus:outline-none" id="search" value="@if(isset($_GET['search'])) {{$_GET['search']}} @endif" name="search" type="text"  placeholder="Поиск по тексту">
                      
                      <div class="p-4">
                        <button type="submit" class="bg-yellow-500 text-white rounded-full p-2 hover:bg-yellow-400 focus:outline-none w-12 h-12 flex items-center justify-center">
                            &#128270;
                        </button>
                        </div>
                      </div>
                    </form>
                    </div>
                
                  
                
                
              </div>
                <div class=" mx-auto  flex flex-col items-center justify-between history__item	  px-12 py-11">
                    <form action="/" method="get" class="flex w-full items-center justify-between"> 
                        <div class="flex items-center flex-wrap">
                      
                            <div class="pr-5">
                               <span class="mb-6 text-base font-medium font-semibold"> Провайдер:</span>
                            <div class="inline-block relative w-64">
                             
                                <select  name="provider_id" class="block appearance-none w-full rounded-full shadow-xl bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                  <option   selected value=''>ВСЕ</option>
                                  <option value="1"  @if(isset($_GET['provider_id']))@if($_GET['provider_id']==1 ) selected @endif @endif>Яндекс</option>
                                  <option value="2"  @if(isset($_GET['provider_id']))@if($_GET['provider_id']==2 ) selected @endif @endif>ЦРТ</option>
                                  <option value="3" @if(isset($_GET['provider_id']))@if($_GET['provider_id']==3 ) selected @endif @endif>Microsoft</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                          
                              </div>
                        </div>
                        <div class="">
                            <span class="mb-2 text-base font-medium font-semibold"> Язык:</span>
                        <div class="inline-block relative w-64">
                         
                            <select  name="lang" class=" block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline rounded-full shadow-xl">
                              <option  selected value=''>ВСЕ</option>
                              <option value="ru-RU" @if(isset($_GET['lang']))@if($_GET['lang']=='ru-RU' ) selected @endif @endif>Русский</option>
                              <option value="en-EN" @if(isset($_GET['lang']))@if($_GET['lang']=='en-EN' ) selected @endif @endif>Английский</option>
                            
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                      
                          </div>
                          
                    </div>
          
                    
                            <div class="px-4 py-5 bg-white sm:p-6  flex justify-between items-center">
                              <div class="flex  gap-6">

                                <div class="flex items-center justify-between w-50">
                                         <span class="mr-1 text-base font-medium font-semibold"> C:</span>
                                  <input type="date" name="start" id="first-name " @if(isset($_GET['start'])) value="{{$_GET['start']}}" @endif autocomplete="given-name" class=" block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline rounded-full shadow-xl">
                                </div>
                  
                                <div class="flex items-center justify-between w-50">
                                  <span class="mr-1 text-base font-medium font-semibold"> По:</span>
                                  <input type="date" name="end" id="last-name" @if(isset($_GET['end'])) value="{{$_GET['end']}}" @endif autocomplete="family-name" class=" block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline rounded-full shadow-xl">
                                </div>
                              </div>
                   
      
                            </div>
                            <button class=" ml-5 bg-gray-900 hover:bg-gray-700 text-white font-bold py-2 px-4 border border-gray-700 rounded"> Применить </button>
                            <a href="/" class=" ml-5 bg-yellow-600 hover:bg-yellow-500 text-white font-bold py-2 px-4 border border-yellow-700 rounded"> Сбросить </a>

                          </form>
                        </div>
                 
                  
                </div>
              
                <!--
                  Mobile menu, show/hide based on mobile menu state.
              
                  Entering: "duration-200 ease-out"
                    From: "opacity-0 scale-95"
                    To: "opacity-100 scale-100"
                  Leaving: "duration-100 ease-in"
                    From: "opacity-100 scale-100"
                    To: "opacity-0 scale-95"
                -->
              
              </div>
              @if(!count($history))
              <div class="flex  justify-center items-center px-4 sm:px-6 text-3xl	font-semibold font-mono  py-11">
                Ничего не найдено
               </div>
              @endif
          
                   @foreach ($history as $h)
                   <div class="flex items-center justify-center  px-12 cursor-pointer " onclick="history({{$h->id}})">
                
                    <div class="md:w-100  py-2 px-5 w-full ">
                   <div class="px-4 py-5 flex items-between justify-between sm:px-6 border-solid border-2 border-light-blue-500 rounded-3xl shadow-xl ">
                      
                
                    <h3 class="text-lg leading-6 font-medium text-gray-500">
                       
                        <audio controls>
                            <source src="{{$h->audio}}">
                           </audio>
                   
                    </h3>
                    <p class="text-lg leading-6 font-medium text-gray-900">
                        <span class=" text-lg font-medium text-yellow-500">Дата:<br></span>
                       <span class="text-gray-500"> {{$h->created_at}} </span> 
                    </p>
                    <p class="text-lg leading-6 font-medium text-gray-900">
                        <span class=" text-lg font-medium text-yellow-500">Провайдер:<br></span>
                        @if( $h->provider->name == 'yandex')
                        <span class=" text-lg font-medium text-gray-900"><span class="text-red-700">Я</span>ндекс</span>   
                        @elseif($h->provider->name == 'Cnt')
                        <span class=" text-lg font-medium text-green-700">ЦРТ</span>
                        @else
                        <span class=" text-lg font-medium text-blue-700">Microsoft</span> 
                        @endif
                        
                    </p>
                    <form action="{{route('speech.delete',['id'=>$h->id])}}" method="post">@csrf
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded">
                        Удалить
                    </button>
                    </form>
                  </div>
              
                  <div class="hidden history__item__sub  history__item__sub_{{$h->id}} px-4 py-5 sm:px-6 border-solid border-4 border-light-blue-500 rounded-3xl  ">
                    <dl>
                      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                          Голос
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$h->voice}}
                        </dd>
                      </div>
                      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                          Язык
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$h->lang}}
                        </dd>
                      </div>

                      <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                          Текст
                        </dt>
                        <dd class="history__item__sub_text mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{$h->text}}                       
                         </dd>
                      </div>
                      <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                         Аудиофайл
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                          <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                          
                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                              <div class="w-0 flex-1 flex items-center">
                                <!-- Heroicon name: solid/paper-clip -->
                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                  <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-2 flex-1 w-0 truncate">
                                    {{$h->audio}}
                                </span>
                              </div>
                              <div class="ml-4 flex-shrink-0">
                                <a href="{{$h->audio}}" class="font-medium text-gray-900 hover:text-gray-900" download>
                                  Скачать
                                </a>
                              </div>
                            </li>
                          </ul>
                        </dd>
                      </div>
                    </dl>
                  </div>
                </div>
          </div>
        </div>
        @endforeach
    </div>
     
                  
     <div class="bg-white px-4 py-3 pagination_history flex items-center justify-between  sm:px-6">
        {!! $history->links() !!}
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
  var paramsString = document.location.search;
  var searchParams = new URLSearchParams(paramsString);

  var s= searchParams.get("search")

  

  if(s){
    tesst = s.split(' ').filter(n=>n)
    function rtt(ttt){
      rtg = false
        tesst.find(e=>{

        if(ttt.toLowerCase().includes(e.toLowerCase())){

           return rtg = true
        }else{

            rtg = false
        }

    })

    return  rtg
  }
  $(".history__item__sub").removeClass( "hidden")
  r = document.querySelectorAll('.history__item__sub_text')
  r.forEach(e=>{
        var span =e
            text =  e
          st = s.toLowerCase().replace(/\s/g, '')
          text = span.innerHTML.split(' ').map(function(el,i) {
          span.innerHTML = text;


        if(el.toLowerCase().includes(st) || rtt(el) ){

        return '<span class="bg-yellow-300">' + el + '</span> ';
        }


        return '<span class="char">' + el + '</span> ';
        }).join('');

        span.innerHTML = text;


  })
    
}
     

            </script>
    </body>
</html>
