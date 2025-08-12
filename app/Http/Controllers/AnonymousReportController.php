<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnonymousReport;
use App\Models\AnonymousReportAttachment;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AnonymousReportController extends Controller
{
    // Show list of all reports with category and attachments
    public function index()
    {
        $reports = AnonymousReport::with(['category', 'attachments'])->get();

        return Inertia::render('Reports/Index', [
            'reports' => $reports,
        ]);
    }

    // Show the form to submit a new report
    public function create()
    {
        $categories = \App\Models\Category::orderBy('name')->get();

        return Inertia::render('Reports/AnonymousReport', [
            'categories' => $categories,
        ]);
    }

    // Store a new anonymous report
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cat_id' => 'required|exists:categories,cat_id',
            'location' => 'required|string|max:255',
            'attachments.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,mp3,wav|max:20480',
        ]);

        $report = AnonymousReport::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'cat_id' => $validatedData['cat_id'],
            'location' => $validatedData['location'],
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('public/report_attachments');

                AnonymousReportAttachment::create([
                    'report_id' => $report->reprt_id, // your PK field
                    'file_path' => Storage::url($path),
                    'file_type' => $this->getFileType($file),
                    'original_filename' => $file->getClientOriginalName(),
                ]);
            }
        }

        return to_route('report.create')->with('success', 'Report submitted successfully.');
    }

    // Helper method to determine the file type of the attachment
    private function getFileType($file)
    {
        $mime = $file->getClientMimeType();
        if (str_starts_with($mime, 'image')) {
            return 'image';
        } elseif (str_starts_with($mime, 'video')) {
            return 'video';
        } elseif (str_starts_with($mime, 'audio')) {
            return 'audio';
        }
        return 'other';
    }

    // Show a specific report (optional)
    public function show($reprt_id)
    {
        $report = AnonymousReport::with(['category', 'attachments'])
                    ->where('reprt_id', $reprt_id)
                    ->firstOrFail();

        return Inertia::render('Reports/Show', [
            'report' => $report,
        ]);
    }
}
