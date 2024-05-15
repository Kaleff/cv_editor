<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeRequest;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    /**
     * Get resumes of the current user
     * GET /resume
     */
    public function index(): View {
        $userId = Auth::id();
        $user = User::find($userId);
        $resumes = $user->resumes()->get();
        return view('resume.list', ['resumes' => $resumes]);
    }

    /**
     * Show the particular resume
     * GET /resume/{id}
     */
    public function show(int $id): View {
        $resume = Resume::find($id);
        $resumeExperiences = $resume->experiences()->where('type', '!=', 'Education')->get();
        $educations = $resume->experiences()->where('type', 'Education')->get();
        $userId = Auth::id();
        $user = User::find($userId);
        return view('resume.show', ['resume' => $resume, 'experiences' => $resumeExperiences, 'user' => $user, 'educations' => $educations]);
    }

    /**
     * Delete the particular resume
     * DELETE /resume/{id}
     */
    public function destroy(int $id): RedirectResponse {
        Resume::destroy($id);
        return to_route('resume_list');
    }

    /**
     * Show the form for the creation of new resume
     * GET /resume/create
     */
    public function create(): View {
        return view('resume.form', ['edit' => false, 'resume' => false]);
    }

    /**
     * Show the form for the edit of the existing resume
     * GET /resume/{id}/edit
     */
    public function edit(int $id): View {
        $resume = Resume::find($id);
        return view('resume.form', ['resume' => $resume, 'edit' => true]);
    }

    /**
     * Store and validate new Resume
     * POST /resume
     */
    public function store(ResumeRequest $request): RedirectResponse {
        $validatedData = $request->validated();
        $validatedData['user_id'] = Auth::id();
        Resume::create($validatedData);
        return to_route('resume_list');
    }

    /**
     * Edit and validate the data about the existing resume
     * POST /resume/{id}/update
     */
    public function update(int $id, ResumeRequest $request): RedirectResponse {
        $validatedData = $request->validated();
        $resume = Resume::find($id);
        $resume->name = $validatedData['name'];
        $resume->phone = $validatedData['phone'];
        $resume->address = $validatedData['address'];
        $resume->save();
        return to_route('resume_list');
    }
}
