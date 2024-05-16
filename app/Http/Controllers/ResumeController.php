<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeRequest;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ResumeController extends Controller
{
    /**
     * Get info for displaying on a resume
     * Created separate helper function since this code is used in several places
     */
    private function getResumeData(int $id) {
        $resume = Resume::find($id);
        $resumeExperiences = $resume->experiences()->where('type', '!=', 'Education')->get()->sortByDesc('start_date', SORT_NATURAL);
        $educations = $resume->experiences()->where('type', 'Education')->get()->sortByDesc('start_date', SORT_NATURAL);
        $userId = Auth::id();
        $user = User::find($userId);
        return ['resume' => $resume, 'experiences' => $resumeExperiences, 'user' => $user, 'educations' => $educations];
    }

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
        return view('resume.show', $this->getResumeData($id));
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

    /**
     * Print/download Resume as a PDF File
     */
    public function print(int $id) {
        $data = $this->getResumeData($id);
        $pdf = Pdf::loadView('resume.document', $data);
        return $pdf->download($data['resume']['name'].".pdf");
    }
}
