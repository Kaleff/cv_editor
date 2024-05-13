<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    /**
     * Get experiences of the current user
     * GET /experience
     */
    public function index(): View {
        $experiences = Experience::where('author_id', Auth::id());
        return view('experience.list', ['experiences' => $experiences]);
    }

    /**
     * Show the particular experience
     * GET /experience/{id}
     */
    public function show(int $id): View {
        $experience = Experience::find($id);
        return view('experience.show', ['experience' => $experience]);
    }

    /**
     * Delete the particular experience
     * DELETE /experience/{id}
     */
    public function destroy(int $id): RedirectResponse {
        Experience::destroy($id);
        return redirect('/experience');
    }

    /**
     * Show the form for the creation of new experience
     * GET /experience/create
     */
    public function create(): View {
        return view('experience.form');
    }

    /**
     * Show the form for the edit of the existing experience
     * GET /experience/{id}/edit
     */
    public function edit(int $id): View {
        $experience = Experience::find($id);
        return view('experience.form', ['experience' => $experience]);
    }

    /**
     * Store and validate new Experience
     * POST /experience
     */
    public function store(ExperienceRequest $request): RedirectResponse {
        $validatedData = $request->validated();
        Experience::create($validatedData);
        return redirect('/experience');
    }

    /**
     * Edit and validate the data about the existing experience
     * PUT/PATCH /experience/{id}
     */
    public function update(int $id, ExperienceRequest $request): RedirectResponse {
        $validatedData = $request->validated();
        $experience = Experience::find($id);
        $experience->name = $validatedData->name;
        $experience->phone = $validatedData->phone;
        $experience->address = $validatedData->address;
        $experience->save();
        return redirect('/experience');
    }
}
