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
        </style>

     
    </head>
    <body class="antialiased">
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
<div class="flex  justify-center items-center px-4 sm:px-6 py-11">

                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                      <a href="#" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Синтез текста на русском языке</a>
        
                      <a href="#" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Синтез текста на английском языке</a>
        
                    </div>
                </div>
               
                </div>
                <div class="flex sub__speech justify-center items-center px-4 sm:px-6 py-6">
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                      <a href="#" class="bg-red-900 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Яндекс</a>
        
                      <a href="#" class="text-green-300 hover:bg-green-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">ЦНТ</a>
        
                    </div>
                </div>
                
           
            </div>
            <div class="form__block  mx-auto  w-1/2 sm:px-6" id="yandexRu">
               
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                          <div class="grid grid-cols-6 gap-6">
                      
                            <div class="col-span-6 sm:col-span-3">
                              <label for="country" class="block text-sm font-medium text-gray-700">Голос</label>
                              <select id="country" name="country" v-model="voice"  autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                                <option value='alena' >Алена</option>
                                <option value='filipp'>Филипп</option>
                              </select>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="country" class="block text-sm font-medium text-gray-700">Эмоция</label>
                                <select id="country" name="country" v-model="emotion" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                                  <option value='neutral'>Нейтрально</option>
                                  <option value='good'>Радость</option>
                                  <option>Злость</option>
                                </select>
                              </div>
                        </div>
                        <div class="col-span-6 sm:col-span-3 pt-5">
                            <label for="country" class="block text-sm font-medium text-gray-700">Скорость</label>
                        <input class="rounded-lg overflow-hidden appearance-none bg-gray-400" v-model="speed" type="range" min="0.1" max="3.0" step="0.1" value="1.0" />
                    </div>
                        <div class="col-span-6 sm:col-span-3 pt-5">
                            <label for="about" class="block text-sm font-medium text-gray-700">
                              Текст
                            </label>
                            <div class="mt-1">
                              <textarea id="about" name="about" rows="10" v-model="text"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-gray-900 focus:border-gray-500 sm:text-sm" placeholder="you@example.com"></textarea>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">
                              Limit:
                            </p>
                          </div>
                          <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <span v-if ="audio"> <audio controls>
                              <source :src="audio">
                             </audio></span>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500" @click="Yandex">
                                Синтезировать
                            </button>
                          </div>
                
            </div>
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

            </script>
            <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js "></script>
            
            <script src="{{ asset('js/speech.js')}}"></script>


    </body>
</html>
