<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Eredmény</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            height: 80px;
            margin-bottom: 10px;
        }

        h1, h2, h3 {
            margin: 5px 0;
        }

        .category {
            margin-bottom: 40px;
            page-break-inside: avoid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            page-break-inside: avoid;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
        }

        /* PRINT OPTIMIZATION */
        @media print {
            body {
                margin: 10mm;
            }

            .category {
                page-break-inside: avoid;
            }

            table {
                page-break-inside: avoid;
            }

            tr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ public_path('logo.png') }}" class="logo">
    <h1>{{ $competition->name }}</h1>
    <h3>{{ $competition->date }} | {{ $competition->venue }}</h3>
</div>

@foreach($categories as $categoryName => $entries)

    <div class="category">

        <h2>{{ $categoryName }}</h2>

        <table>
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Rider</th>
                    <th>Horse</th>
                    <th>Dressage</th>
                    <th>Jumping</th>
                    <th>Cross Country</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($entries->sortBy('rank')->values() as $index => $entry)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $entry->rider_name }}</td>
                        <td>{{ $entry->horse_name }}</td>
                        <td>fsfj</td>
                        <td>gdsgfj</td>
                        <td>ghsdfjshgf</td>
                        <td><strong>{{ $entry->mark }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endforeach

</body>
</html>