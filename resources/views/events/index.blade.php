<h1>Events</h1>

<form method="GET" action="{{ route('events.index') }}">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name...">
    <button type="submit">Search</button>
</form>

<a href="{{ route('events.create') }}">
    <button>Create Event</button>
</a>

<table border="1">
    <thead>
    <tr>
        <th>Event Name</th>
        <th>Date</th>
        <th>Type</th>
        <th>Organizer</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($events as $event)
        <tr>
            <td>{{ $event->name }}</td>
            <td>{{ $event->date->format('Y-m-d') }}</td>
            <td>
                {{ $event->type instanceof \BackedEnum ? ucfirst($event->type->value) : ucfirst($event->type) }}
            </td>
            <td>{{ $event->organizer->full_name }}</td>
            <td>
                <a href="{{ route('events.show', $event->id) }}">View</a>

                <a href="{{ route('events.edit', $event->id) }}">Edit</a>

                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this event?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div>
    {{ $events->links() }}
</div>
