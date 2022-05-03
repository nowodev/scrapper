<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Scrapper</title>
    </head>
    <body>
        <div>
            <form action="{{ route('store') }}" method="POST">
                @csrf

                <div>
                    @foreach ($errors->all() as $errors)
                        <li>
                            {{ $errors }}
                        </li>
                    @endforeach

                </div>
                <div>
                    <label for="selector">Selector</label>
                    <input type="text" id="selector" name="selector" value="{{ old('selector') }}">
                </div>

                <div>
                    <label for="url">URL</label>
                    <input type="url" id="url" name="url" value="{{ old('url') }}">
                </div>

                <button type="submit">Search</button>
            </form>
        </div>
    </body>
</html>
