<h1>Create New Event</h1>

<form action="{{ route('events.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Event Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
        @error('name')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="description">Description</label>
        <textarea id="description" name="description">{{ old('description') }}</textarea>
        @error('description')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="date">Event Date</label>
        <input type="date" id="date" name="date" value="{{ old('date') }}">
        @error('date')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="type">Event Type</label>
        <select id="type" name="type">
            <option value="">Select type</option>
            <option value="seminar" {{ old('type') == 'seminar' ? 'selected' : '' }}>Seminar</option>
            <option value="workshop" {{ old('type') == 'workshop' ? 'selected' : '' }}>Workshop</option>
            <option value="lecture" {{ old('type') == 'lecture' ? 'selected' : '' }}>Lecture</option>
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
                    {{ old('organizer_id') == $organizer->id ? 'selected' : '' }}>
                    {{ $organizer->full_name }}
                </option>
            @endforeach
        </select>
        @error('organizer_id')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <button type="submit">Create Event</button>
    </div>
</form>

<a href="{{ route('events.index') }}">Back to Events</a>
