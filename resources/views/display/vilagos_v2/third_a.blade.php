<div class="display p-2">

  <!-- Mode -->
  <div class="form-group d-flex align-items-center mb-2">
    <label class="mb-0 mr-2" style="min-width: 130px;">Display mode</label>
    <select class="mode-select form-control">
      <option value="default">Default display</option>
      <option value="event">Event display</option>
      <option value="rider">Current rider</option>
      <option value="result">Result</option>
      <option value="info">Info display</option>
    </select>
  </div>

  <!-- Event -->
  <div class="form-group d-flex align-items-center mb-2">
    <label class="mb-0 mr-2" style="min-width: 130px;">Event</label>
    <select class="event-select form-control">
      <option value="">Select Event</option>
      @foreach($competition->event as $event)
        <option value="{{ $event->id }}">{{ $event->event_name }}</option>
      @endforeach
    </select>
  </div>

  <!-- Completed -->
  <div class="form-group d-flex align-items-center mb-2">
    <label class="mb-0 mr-2" style="min-width: 130px;">Completed</label>
    <select class="start-select-completed form-control" disabled>
      <option value="">Completed</option>
    </select>
  </div>

  <!-- Pending -->
  <div class="form-group d-flex align-items-center mb-2">
    <label class="mb-0 mr-2" style="min-width: 130px;">Pending</label>
    <select class="start-select-pending form-control" disabled>
      <option value="">Started</option>
    </select>
  </div>

  <!-- Button -->
  <button class="btn btn-secondary btn-block refresh-starts">
    Refresh starts
  </button>
<a href="/display/vilagos/{{$competition->id}}">Automatic display</a>
<a href="/display/vilagos_v2_fullscreen/{{$competition->id}}">Full screen</a>
<a href="/display/last_starts/{{$competition->id}}">Last starts</a>

</div>