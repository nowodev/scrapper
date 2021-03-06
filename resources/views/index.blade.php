<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Scrapper</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>

    <body class="antialiased">
        <div class="container mx-auto pt-12 px-12 max-w-2xl">
            @if ($message = Session::get('success'))
                <div>
                    <button type="button">×</button>
                    <strong class="text-green-500">{{ $message }}</strong>
                </div>
            @endif

            <h1 class="text-3xl font-bold text-center mb-8">Puppeteer Web Scrapper</h1>

            <form action="{{ route('store') }}" method="POST">
                @csrf

                <div class="space-y-4">
                    <div>
                        @foreach ($errors->all() as $errors)
                            <li class="text-sm text-red-600">
                                {{ $errors }}
                            </li>
                        @endforeach
                    </div>

                    <div class="space-y-3">
                        <label for="selector">Selector</label>
                        <input type="text" id="selector" class="w-full md:w-2/3 flex border rounded-md py-1.5 px-2" name="selector"
                               value="{{ old('selector') }}">
                    </div>

                    <div class="space-y-3">
                        <label for="url">URL</label>
                        <input type="url" id="url" name="url" class="w-full md:w-2/3 flex border rounded-md py-1.5 px-2"
                               value="{{ old('url') }}">
                    </div>

                    <button type="submit"
                            class="bg-sky-400 px-3 py-1 flex items-center rounded-lg hover:bg-sky-600 font-bold text-white">
                        Search
                    </button>
                </div>
            </form>

            <hr class="my-20">

            <ul>
                @forelse($scrappedData as $data)
                    <li>
                        {{ $loop->iteration }}. {{ $data->content }}
                    </li>
                @empty
                    <li>No Record Found</li>
                @endforelse
            </ul>

            <div class="flex justify-end my-10">
                {{ $scrappedData->links() }}
            </div>
        </div>
    </body>
</html>
