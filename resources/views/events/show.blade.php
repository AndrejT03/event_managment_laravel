<h1>{{ $event->name }}'s Details</h1>

<table border="1">
    <tr>
        <th>Event Name</th>
        <td>{{ $event->name }}</td>
    </tr>
    <tr>
        <th>Description</th>
        <td>{{ $event->description }}</td>
    </tr>
    <tr>
        <th>Date</th>
        <td>{{ $event->date->format('Y-m-d') }}</td>
    </tr>
    <tr>
        <th>Type</th>
        <td>
            {{ $event->type instanceof \BackedEnum ? ucfirst($event->type->value) : ucfirst($event->type) }}
        </td>
    </tr>
</table>

<h2>Organizer</h2>
<table border="1">
    <tr>
        <th>Name</th>
        <td>
            <a href="{{ route('organizers.show', $event->organizer->id) }}">
                {{ $event->organizer->full_name }}
            </a>
        </td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{ $event->organizer->email }}</td>
    </tr>
    <tr>
        <th>Phone</th>
        <td>{{ $event->organizer->phone }}</td>
    </tr>
</table>

<a href="{{ route('events.index') }}">Back to Events</a>
