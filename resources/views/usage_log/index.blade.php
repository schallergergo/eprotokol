

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Usage Logs</h2>

    {{-- Filter Buttons --}}
    <div class="mb-3">
        <a href="{{ route('usagelog.index') }}" class="btn btn-outline-dark btn-sm me-2">
            All
        </a>

        @foreach($models as $model)
            <a href="{{ route('usagelog.index', ['model' => $model]) }}" 
               class="btn btn-outline-primary btn-sm me-2">
                {{ $model }}
            </a>
        @endforeach
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">User</th>
                        <th scope="col">Model</th>
                        <th scope="col">Action</th>
                        <th scope="col">Model id</th>

                        <th scope="col">Details</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->user->name ?? 'Anonim' }}</td>
                            <td>{{ class_basename($log->model) }}</td>
                             <td>
                                <span class="badge bg-primary">{{ ucfirst($log->action) }}</span>
                            </td>
                            @if ($log->model == 'Result')
                            <td title = "Hover">{{ $log->model_id}}</td>
                            @else 
                            <td>{{ $log->model_id}}</td>
                            @endif
                            

                           
                            <td>{{ Str::limit(json_encode($log->comment), 50) }}</td>
                            <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No logs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
