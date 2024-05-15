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
     * Delete the particular experience
     * DELETE /experience/{id}
     */
    public function destroy(int $id): RedirectResponse {
        $resume_id = Experience::find($id)['resume_id'];
        Experience::destroy($id);
        return to_route('resume_show', ['resume' => $resume_id]);
    }

    /**
     * Show the form for the creation of new experience
     * GET /experience/create
     */
    public function create(int $id): View {
        return view('experience.form', ['resume_id' => $id, 'edit' => false, 'experience' => false]);
    }

    /**
     * Show the form for the edit of the existing experience
     * GET /experience/{id}/edit
     */
    public function edit(int $id): View {
        $experience = Experience::find($id);
        return view('experience.form', ['experience' => $experience, 'edit' => true]);
    }

    /**
     * Store and validate new Experience
     * POST /experience
     */
    public function store(ExperienceRequest $request): RedirectResponse {
        $validatedData = $request->validated();
        Experience::create($validatedData);
        return to_route('resume_show', ['resume' => $validatedData['resume_id']]);
    }

    /**
     * Edit and validate the data about the existing experience
     * PUT/PATCH /experience/{id}
     */
    public function update(int $id, ExperienceRequest $request): RedirectResponse {
        $validatedData = $request->validated();
        $experience = Experience::find($id);
        $experience->company = $validatedData['company'];
        $experience->start_date = $validatedData['start_date'];
        $experience->end_date = $validatedData['end_date'];
        $experience->location = $validatedData['location'] ? $validatedData['location'] : null;
        $experience->role = $validatedData['role'];
        $experience->type = $validatedData['type'];
        $experience->description = $validatedData['description'];
        $experience->save();
        return to_route('resume_show', ['resume' => $experience['resume_id']]);
    }
}
