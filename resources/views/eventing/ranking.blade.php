<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Eredmény</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
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
            table-layout: fixed; /* keeps columns aligned */
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
            word-wrap: break-word;
        }

        th {
            background-color: #f0f0f0;
        }

        /* Fixed column widths */
        th:nth-child(1), td:nth-child(1) { width: 5%; }   /* Rank */
        th:nth-child(2), td:nth-child(2) { width: 15%; }  /* Rider */
        th:nth-child(3), td:nth-child(3) { width: 15%; }  /* Horse */
        th:nth-child(4), td:nth-child(4) { width: 15%; }  /* Club */

        /* PRINT */
        @media print {
            body {
                margin: 10mm;
            }

            .category {
                page-break-inside: avoid;
            }

            table, tr {
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
                    <th>Club</th>
                    <th>DR</th>

                    <th>Dressage</th>
                    <th>Cross hp</th>
                    <th>Cross time</th>
                    <th>Jump hp</th>
                    <th>Jump time</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($entries->sortBy('rank')->values() as $index => $entry)
                    <tr>
                        <td>{{ $entry->rank }}</td>
                        <td>{{ $entry->rider_name }}</td>
                        <td>{{ $entry->horse_name }}</td>
                        <td>{{ $entry->club ?? '-' }}</td>
                        <td>
                        {{-- Judge scores --}}
                        @foreach($entry->result->sortBy('position') as $result)
                            
                                {{ $result->position }} : {{ number_format($result->mark,1) }} p - {{number_format($result->percent,2)}} % <br>
                            
                        @endforeach
                        </td>
                        <td>{{ number_format($entry->mark,1) }} p - {{number_format($entry->percent,2)}} % <br></td>
                        <td>
                            {{ $entry->eventing_cross->total_fault ?? '-' }} 
                            @if($entry->eventing_cross->time_fault !=0)
                              (  +{{$entry->eventing_cross->time_fault}} )
                            @endif 
                        </td>
                        <td>{{ $entry->eventing_cross->time ?? '-' }}</td>
                        <td>
                            {{ $entry->eventing_show_jumping->total_fault ?? '-' }} 
                            @if($entry->eventing_show_jumping->time_fault !=0)
                              (  +{{$entry->eventing_show_jumping->time_fault}} )
                            @endif 
                        </td>
                        <td>{{ $entry->eventing_show_jumping->time ?? '-' }}</td>
                        <td><strong>{{ $entry->eventing->fault ?? '-' }}</strong></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endforeach

</body>
</html>