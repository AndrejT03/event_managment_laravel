<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrganizerRequest;
use App\Http\Requests\UpdateOrganizerRequest;
use App\Models\Organizer;
use App\Repositories\OrganizerRepositoryInterface;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected OrganizerRepositoryInterface $organizerRepository;
    public function __construct(OrganizerRepositoryInterface $organizerRepository){
        $this->organizerRepository = $organizerRepository;
    }

    public function index()
    {
        $organizers = $this->organizerRepository->paginate(10);
        return view('organizers.index', compact('organizers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('organizers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizerRequest $request)
    {
        $this->organizerRepository->create($request->validated());
        return redirect()->route('organizers.index')
            ->with('success', 'Organizer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $organizer = $this->organizerRepository->find($id);
        return view('organizers.show', compact('organizer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $organizer = $this->organizerRepository->find($id);
        return view('organizers.edit', compact('organizer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizerRequest $request, int $id)
    {
        $organizer = $this->organizerRepository->find($id);
        $this->organizerRepository->update($organizer, $request->validated());

        return redirect()->route('organizers.index')
            ->with('success', 'Organizer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $organizer = $this->organizerRepository->find($id);
        $this->organizerRepository->delete($organizer);
        return redirect()->route('organizers.index')
            ->with('success', 'Organizer deleted successfully.');
    }
}
