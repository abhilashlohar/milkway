<option value="">--Select--</option>
@foreach ($streams  as $stream)
<option value="{{ $stream->id }}">{{ $stream->name }}</option>
@endforeach