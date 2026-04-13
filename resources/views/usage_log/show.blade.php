

@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Rider: {{ $start->rider_name }}  
                <small class="text-light">{{ $start->horse_name }}   – {{ $start->club }}</small>
            </h5>
        </div>
        <div class="card-body">
            <p><strong>Event:</strong> {{ $start->event->event_name }}</p>

            {{-- Model-specific data --}}
            @if($model instanceof \App\Models\Result)
                <p><strong>Score:</strong> {{ $model->mark }}</p>
                <p><strong>Percent:</strong> {{ $model->percent }}</p>

            @elseif($model instanceof \App\Models\TrainingSession)
                <p><strong>Date:</strong> {{ $model->date->format('Y-m-d') }}</p>
                <p><strong>Duration:</strong> {{ $model->duration }} minutes</p>
                <p><strong>Trainer:</strong> {{ $model->trainer->name }}</p>

            @elseif($model instanceof \App\Models\MedicalCheck)
                <p><strong>Checkup Date:</strong> {{ $model->date->format('Y-m-d') }}</p>
                <p><strong>Vet:</strong> {{ $model->vet->name }}</p>
                <p><strong>Notes:</strong> {{ $model->notes }}</p>
            @else
                <p class="text-muted">No extra details available for this model.</p>
            @endif
        </div>
    </div>
</div>

@endsection
