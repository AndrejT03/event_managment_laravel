<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateEventRequest;
use App\Repositories\EventRepositoryInterface;
use App\Repositories\OrganizerRepositoryInterface;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use App\Http\Requests\StoreEventRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected EventRepositoryInterface $eventRepository;
    protected OrganizerRepositoryInterface $organizerRepository;

    public function __construct(EventRepositoryInterface $eventRepository, OrganizerRepositoryInterface $organizerRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->organizerRepository = $organizerRepository;
    }

    public function index(Request $request) : View|Factory|Application
    {
        $search = $request->query('search');

        $events = $this->eventRepository->paginate(10, $search);

        return view('events.index', compact('events', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View|Factory|Application
    {
        $organizers = $this->organizerRepository->all();
        return view('events.create', compact('organizers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request) : RedirectResponse
    {
        $this->eventRepository->create($request->validated());
        return redirect()->route('events.index')
            ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) : View|Factory|Application
    {
        $event = $this->eventRepository->find($id);
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id) : View|Factory|Application
    {
        $event = $this->eventRepository->find($id);
        $organizers = $this->organizerRepository->all();
        return view('events.edit', compact('event', 'organizers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, int $id) : RedirectResponse
    {
        $event = $this->eventRepository->find($id);
        $this->eventRepository->update($event, $request->validated());
        return redirect()->route('events.index')
            ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id) : RedirectResponse
    {
        $event = $this->eventRepository->find($id);
        $this->eventRepository->delete($event);

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully.');
    }
}
