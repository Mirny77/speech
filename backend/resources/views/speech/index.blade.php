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
        

     
    </head>
    <body class="antialiased">
        <div class="flex items-center justify-center py-11 px-12 ">
            <div class="md:w-100 rounded-md shadow-lg py-4 px-5 w-full bg-white dark:bg-gray-800">
               @foreach ($history as $h)
               <div class="pt-6 relative">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-2 h-2 rounded-full bg-purple-400"></div>
                        <span tabindex="0" class="focus:outline-none text-purple-400 text-xs italic font-normal pl-1">{{$h->created_at}}</span>
                    </div>
                    <button aria-label="dropdown" class="cursor-pointer py-2  focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-full focus:ring-gray-500" onclick="dropdownHandler(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="4" viewBox="0 0 16 4" fill="none">
                            <path d="M2.11191 2.83331C2.56925 2.83331 2.94 2.46021 2.94 1.99997C2.94 1.53973 2.56925 1.16663 2.11191 1.16663C1.65456 1.16663 1.28381 1.53973 1.28381 1.99997C1.28381 2.46021 1.65456 2.83331 2.11191 2.83331Z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M7.90854 2.83331C8.36588 2.83331 8.73663 2.46021 8.73663 1.99997C8.73663 1.53973 8.36588 1.16663 7.90854 1.16663C7.45119 1.16663 7.08044 1.53973 7.08044 1.99997C7.08044 2.46021 7.45119 2.83331 7.90854 2.83331Z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13.705 2.83331C14.1623 2.83331 14.5331 2.46021 14.5331 1.99997C14.5331 1.53973 14.1623 1.16663 13.705 1.16663C13.2477 1.16663 12.877 1.53973 12.877 1.99997C12.877 2.46021 13.2477 2.83331 13.705 2.83331Z" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="absolute z-40 right-0">
                            <div class="rounded bg-white shadow-xl">
                                <ul class="hidden mt-1">
                                    <a href="javascript:void(0)" class="focus:outline-none focus:underline"><li class="hover:text-white cursor-pointer hover:bg-indigo-700 p-2">Delete</li></a>
                                    <a href="javascript:void(0)" class="focus:outline-none focus:underline"><li class="hover:text-white cursor-pointer hover:bg-indigo-700 p-2">Edit</li></a>
                                </ul>
                            </div>
                        </div>
                    </button>
                </div>
               <p tabindex="0" class="focus:outline-none text-gray-600 dark:text-gray-100 text-sm leading-none pt-2 "></p>
                <p tabindex="0" class="focus:outline-none text-xs italic pt-1 leading-3 text-gray-400">Discussion on the template design</p>
                <div class="flex items-center justify-left">
                    <audio controls>
                        <source src="http://speech.local{{$h->audio}}">
                       </audio>
                    <div tabindex="0" class="focus:outline-none text-green-700 bg-green-100 py-1 px-2 rounded text-xs leading-3 mt-2">Completed</div>
                </div>
            </div>
       
               @endforeach
              

            </div>
        </div>
    </body>
</html>
