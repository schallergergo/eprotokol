<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start List</title>
    <link rel="stylesheet" href="/css/print.css">
</head>
<body>
    <div class="content">
        <h4>{{$event->event_name}}</h4>
        <table class="start-list">
            <thead>
                <tr>
                    <th class="">-</th>
                    <th class="">-</th>
                    <th class="nowrap">Lovas</th>
                    <th class="nowrap">Ló</th>
                    <th class="nowrap">Klub</th>
                    <th class="nowrap">Kategória</th>

                </tr>
            </thead>
            <tbody>
                @foreach($event->start->sortBy("start_time") as $start)
               <tr>
                    <td class="">{{$start->rank}}</td>
                    <td class="">{{substr($start->start_time,0,5)}}</td>
                    <td class="nowrap">{{$start->rider_name}} ({{$start->rider_id}})</td>
                    <td class="nowrap">{{$start->horse_name}} ({{$start->horse_id}})</td>
                    <td class="nowrap">{{$start->club}}</td>
                    <td class="nowrap">{{$start->category}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>
</html>
