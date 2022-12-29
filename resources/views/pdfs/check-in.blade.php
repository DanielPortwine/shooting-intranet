<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <style>
        .font-sans {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        .text-gray-900 {
            color: #2d3748;
        }
        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .w-full {
            width: 100%;
        }
        .w-third {
            width: 33%;
        }
        .m-0 {
            margin: 0;
        }
        .p-1 {
            padding: 1rem;
        }
        table {
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        .float-right {
            float: right;
        }
        .inline-block {
            display: inline-block;
        }
    </style>
</head>
<body>
<div class="font-sans text-gray-900 antialiased">
    <div>
        <div class="inline-block">
            <h3 class="m-0">Welcome to Epic Shooting Club!</h3>
            <h4 class="m-0">{{ \Carbon\Carbon::now()->format('d M Y') }}</h4>
        </div>
        <img class="float-right" src="{!! 'data:image/svg+xml;base64,' . base64_encode(QrCode::size(75)->generate(route('check-in-create', hash('sha256', config('app.check_in_secret') . Carbon\Carbon::now()->format('Y-m-d'))))); !!}">
    </div>
    <p>Please check-in by entering your details on the form or scanning the QR code.</p>
    <table class="w-full">
        <tr>
            <th class="w-third">Signature</th>
            <th class="w-third">Name</th>
            <th class="w-third">Firearm</th>
        </tr>
        @for($x = 0; $x < 27; $x++)
            <tr>
                <td class="p-1"></td>
                <td class="p-1"></td>
                <td class="p-1"></td>
            </tr>
        @endfor
    </table>
</div>
</body>
</html>
