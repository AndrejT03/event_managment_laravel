<h1>Edit Event</h1>

<form action="{{ route('events.update', $event->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Event Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $event->name) }}">
        @error('name')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description">{{ old('description', $event->description) }}</textarea>
        @error('description')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="date">Event Date</label>
        <input type="date" id="date" name="date"
               value="{{ old('date', $event->date->format('Y-m-d')) }}">
        @error('date')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="type">Event Type</label>
        <select id="type" name="type">
            @php
                $currentType = $event->type instanceof \BackedEnum ? $event->type->value : $event->type;
            @endphp
            <option value="">Select type</option>
            <option value="seminar" {{ old('type', $currentType) == 'seminar' ? 'selected' : '' }}>Seminar</option>
            <option value="workshop" {{ old('type', $currentType) == 'workshop' ? 'selected' : '' }}>Workshop</option>
            <option value="lecture" {{ old('type', $currentType) == 'lecture' ? 'selected' : '' }}>Lecture</option>
        </select>
        @error('type')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="organizer_id">Organizer</label>
        <select id="organizer_id" name="organizer_id">
            <option value="">Select organizer</option>
            @foreach($organizers as $organizer)
                <option value="{{ $organizer->id }}"
                    {{ old('organizer_id', $event->organizer_id) == $organizer->id ? 'selected' : '' }}>
                    {{ $organizer->full_name }}
                </option>
            @endforeach
        </select>
        @error('organizer_id')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <button type="submit">Update Event</button>
    </div>
</form>

<a href="{{ route('events.index') }}">Back to Events</a>
