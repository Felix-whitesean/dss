<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital safe space - Terms and conditions</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <link href="{{asset('images/logo.png')}}" rel="icon">
    <style>

    </style>
</head>
<body class="!important w-screen pt-0 h-screen bg-gray-200 m-0 p-0 relative">
    <div class="flex flex-col mt-0 md:-mt-[62px] sm:-mt-[69px] min-h-0 h-full p-0 m-0 overflow-hidden">
        <!-- Fixed Header -->
        <div class="">
            @include('components.home.header')
        </div>

        <div class="flex-1 overflow-y-auto sm:px-6 px-2 sm:py-8 py-4 bg-background">
            <div class="sm:max-w-[80%] w-full text-[2px] sm:px-40 px-8 py-24 bg-white mx-auto">
                {!! $content !!}
            </div>
        </div>

        <div class="shrink-0 px-6 py-6 backdrop-blur-2xl">
            <form method="POST" class="flex justify-center" action="{{ route('terms.accept') }}">
                @csrf
                <button type="submit" class="px-20 py-3 bg-green-700 text-white rounded-s hover:text-white hover:bg-green-800">
                    I Agree
                </button>
            </form>
        </div>
    </div>

</body>
</html>
