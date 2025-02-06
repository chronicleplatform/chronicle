@if(app()->isLocal())

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Wave Installation</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.4/tailwind.min.css">
    </head>
    <body class="bg-zinc-50">

        @if(Request::get('complete'))

            @php
            

                \Illuminate\Support\Facades\Artisan::call('db:seed', [
                '--force' => true
                ]);

                \Illuminate\Support\Facades\Artisan::call('storage:link');

                Auth::login(\App\Models\User::first());

                @endphp

                <div class="flex flex-col items-center justify-center w-screen h-screen">
                <svg class="-mt-12 w-9 h-9" viewBox="0 0 100 150" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill="#000" d="M0 50h50v50H0zM50 0h50v50H50zM50 100h50v50H50z"/></svg>
                <div class="flex flex-col items-center w-full max-w-lg p-10 mx-auto mt-8 bg-white border shadow-xl rounded-xl border-zinc-100">
                    <h1 class="text-2xl font-semibold text-black">Successfully Installed 🎉</h1>
                    <p class="mt-5 text-zinc-500">Click continue below to view your new website.</p>
                    <a href="/" class="flex justify-center w-full px-4 py-2 mt-8 text-lg font-medium text-white transition duration-150 ease-in-out bg-gray-900 border border-transparent rounded-md hover:bg-gray-800 focus:outline-none focus:border-gray-900 focus:shadow-outline-wave active:bg-gray-900">
                        Continue
                    </a>
                </div>
            </div>

        @else

            @php

                try {
                    $user = \App\Models\User::first();
                    header('Location: /');
                    exit;
                } catch (\Illuminate\Database\QueryException $e) {
                    // Continue with the installation process
                }

                if (!\Illuminate\Support\Facades\File::exists(database_path('database.sqlite'))) {
                    \Illuminate\Support\Facades\File::put(database_path('database.sqlite'), '');
                }
                \Illuminate\Support\Facades\Artisan::call('migrate', [
                    '--force' => true
                    ]);
            @endphp

            <div class="flex flex-col items-center justify-center w-screen h-screen">
                <svg class="-mt-12 w-9 h-9" viewBox="0 0 100 150" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill="#000" d="M0 50h50v50H0zM50 0h50v50H50zM50 100h50v50H50z"/></svg>
                <div class="flex flex-col items-center w-full max-w-lg p-10 mx-auto mt-8 bg-white border shadow-sm rounded-2xl border-zinc-100">
                    <h1 class="text-2xl font-semibold text-black">Welcome to Chronicle</h1>
                    <p class="mt-5 text-zinc-500">Ready to get started? click the Install button below.</p>
                    <a href="/install?complete=true" class="flex justify-center w-full px-4 py-2 mt-8 text-lg font-medium text-white transition duration-150 ease-in-out bg-gray-900 border border-transparent rounded-md hover:bg-gray-800 focus:outline-none focus:border-gray-900 focus:shadow-outline-wave active:bg-gray-900">
                        Install Chronicle
                    </a>
                </div>
            </div>

        @endif

    </body>
    </html>


@endif
