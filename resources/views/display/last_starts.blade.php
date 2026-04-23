<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eventing Standings</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #fff;
            color: #fff;
            font-size: 1.2rem;
        }

        .card {
            background-color: #fff;
            border: none;
        }

        .border {
            border-color: #444 !important;
        }
    </style>
</head>
<body>

<input type="hidden" name="competition_id" value="{{$competition->id}}">
<div class="container-fluid p-4">

    <div class="card">

        <div class="card-header text-center fs-4">
           <span>{{$event->competition->name}}</span>  - <span id='event_name'>{{$event->event_name}}</span>
        </div>

        <div class="card-body">

            @foreach ($starts as $start)

                <div class="row mb-3 border align-items-center text-center">

                    <div class="col-md-2 p-2">
                        {{$start->rider_name}} ({{$start->rider_id}})
                    </div>

                    <div class="col-md-2 p-2 ">
                        {{$start->horse_name}} ({{$start->horse_id}})
                    </div>

                    <div class="col-md-2 p-2 ">
                        {{$start->club}}
                    </div>

                    <div class="col-md-2 p-2">
                        {{$start->category}}
                    </div>

                    <div class="col-md-2 p-2">
                        @if ($start->eliminated)
                            {{ __("Eliminated!") }}
                        @else
                            {{$start->mark}}p - {{number_format($start->percent, 3)}}%
                            @if ($start->collective != 0)
                                - {{$start->collective}}p
                            @endif
                        @endif
                    </div>

                    <div class="col-md-2 p-2">
                        {{-- Assuming $start has related results --}}
                        @foreach($start->result as $result)

                            @if ($result->eliminated)
                                {{ __("Eliminated!") }}
                            @else
                                <span title="{{__('Judge')}}">
                                    {{$result->position}}:
                                </span>
                                <span title="{{__('Point')}}">
                                    {{$result->mark}}p
                                </span> -
                                <span title="{{__('Percentage')}}">
                                    {{$result->percent}}%
                                </span> -
                                <span title="{{__('Collective mark')}}">
                                    {{$result->collective}}p
                                </span>
                            @endif

                        @endforeach
                    </div>

                </div>

            @endforeach

        </div>
    </div>

</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
let data = [];
let step = 0;

// 🔁 Fetch data from backend
async function fetchData() {
    try {
        const competitionId = document.querySelector('input[name="competition_id"]').value;

        const response = await fetch(`/ajax/getCompetitionStarts/${competitionId}`);
        data = await response.json();

    } catch (error) {
        console.error('Fetch error:', error);
    }
}

// 🎯 Render current event
function render() {
    if (!data.length) return;

    const index = step % data.length;
    const event = data[index];

    // Update event name
    document.getElementById('event_name').innerText = event.event_name;

    const container = document.querySelector('.card-body');
    container.innerHTML = '';

    event.starts.forEach(start => {
        let resultsHtml = '';

        start.result.forEach(result => {
            if (result.eliminated) {
                resultsHtml += `Eliminated! `;
            } else {
                resultsHtml += `
                    <span title="Judge">${result.position}:</span>
                    <span title="Point">${result.mark}p</span> -
                    <span title="Percentage">${result.percent}%</span> -
                    <span title="Collective mark">${result.collective}p</span><br>
                `;
            }
        });

        const row = `
            <div class="row mb-3 border align-items-center text-center">

                <div class="col-md-2 p-2">
                    ${start.rider_name} (${start.rider_id})
                </div>

                <div class="col-md-2 p-2">
                    ${start.horse_name} (${start.horse_id})
                </div>

                <div class="col-md-2 p-2">
                    ${start.club}
                </div>

                <div class="col-md-2 p-2">
                    ${start.category}
                </div>

                <div class="col-md-2 p-2">
                    ${
                        start.eliminated
                        ? 'Eliminated!'
                        : `${start.mark}p - ${Number(start.percent).toFixed(3)}% ${start.collective != 0 ? '- ' + start.collective + 'p' : ''}`
                    }
                </div>

                <div class="col-md-2 p-2">
                    ${resultsHtml}
                </div>

            </div>
        `;

        container.insertAdjacentHTML('beforeend', row);
    });

    step++;
}

// ⏱️ Poll + rotate
async function init() {
    await fetchData();
    render();

    // rotate every 5 seconds
    setInterval(render, 10000);

    // refresh data every 30 seconds
    setInterval(fetchData, 60000);
}

init();
</script>

</body>
</html>