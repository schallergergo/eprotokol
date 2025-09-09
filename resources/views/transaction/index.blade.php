

@extends('layouts.app')

@section('content')
<div class="container my-4">
    {{-- Summary Header --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
            <div>
                <h2 class="mb-0">{{ $competition->name }} {{ __("Transactions") }}</h2>
                <div class="d-flex gap-3 mt-1">
                    <span id="startFeeTotal" class="badge bg-success">
                        {{ __("Start fee") }}: {{ $start_fee }}
                    </span>
                    <span id="boxFeeTotal" class="badge bg-success">
                        {{ __("Box fee") }}: {{ $box_fee }}
                    </span>
                </div>
            </div>
            <div>
                <a href="{{ url('/finance/show/' . $competition->id) }}" class="btn btn-outline-secondary">
                    {{ __("Back") }}
                </a>
            </div>
        </div>

        <div class="card-body">
            {{-- Header Row --}}
            <div class="row mb-2 border bg-light d-none d-md-flex py-2">
                <div class="col-md-4 fw-bold">{{ __("Comment") }}</div>
                <div class="col-md-2 fw-bold">{{ __("Type") }}</div>
                <div class="col-md-2 fw-bold">{{ __("Amount") }}</div>
                <div class="col-md-2 fw-bold">{{ __("Created") }}</div>
                <div class="col-md-2 fw-bold">{{ __("Detail") }}</div>
            </div>

            @foreach ($transactions as $transaction)
                <div class="mb-3 border rounded">
                    {{-- Summary Row --}}
                    <div class="row align-items-center py-2 px-2">
                        <div class="col-md-4">
                            <div class="fw-medium">{{ $transaction->comment }}</div>
                        </div>
                        <div class="col-md-2">
                            <div>{{ $transaction->type }}</div>
                        </div>
                        <div class="col-md-2">
                            <div>{{ $transaction->amount }}</div>
                        </div>
                        <div class="col-md-2">
                            <div>{{ $transaction->created_at }}</div>
                        </div>
                        <div class="col-md-2">
                            {{-- toggle collapse --}}
                            <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#detail-{{ $transaction->id }}" aria-expanded="false" aria-controls="detail-{{ $transaction->id }}">
                                {{ __("Details") }}
                            </button>
                        </div>
                    </div>

                    {{-- Expanded Details --}}
                    <div class="collapse" id="detail-{{ $transaction->id }}">
                        <div class="card-body border-top">
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <h5 class="mb-1">{{ $transaction->type }} : <span class="text-primary">{{ $transaction->amount }}</span></h5>
                                    <small class="text-muted">{{ __("Created at") }}: {{ $transaction->created_at }}</small>
                                    <div class="mt-2">
                                        <strong>{{ __("Comment") }}:</strong> {{ $transaction->comment }}
                                    </div>
                                </div>
                            </div>

                            {{-- Start Fees --}}
                            @if (!empty($transaction->start_fee) && count($transaction->start_fee))
                                <div class="mb-3">
                                    <h6>{{ __("Start Fees") }}</h6>
                                    <ul class="list-group">
                                        @foreach ($transaction->start_fee as $startfee)
                                            @php
                                                $start = $startfee->start;
                                            @endphp
                                            <li class="list-group-item">
                                                <div><strong>{{ $start->rider_name }}</strong> &mdash; {{ $start->horse_name }}</div>
                                                <div class="small text-muted">
                                                    {{ __("Club") }}: {{ $start->club ?? '—' }}
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Box Fees --}}
                            @if (!empty($transaction->box_fee) && count($transaction->box_fee))
                                <div class="mb-3">
                                    <h6>{{ __("Box Fees") }}</h6>
                                    <ul class="list-group">
                                        @foreach ($transaction->box_fee as $boxfee)
                                            <li class="list-group-item">
                                                <div><strong>{{ $boxfee->rider_name }}</strong> &mdash; {{ $boxfee->horse_name }}</div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>


@endsection