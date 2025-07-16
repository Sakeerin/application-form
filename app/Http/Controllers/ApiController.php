<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        $position = $request->position ? $request->position : 'all';
        $start = $request->start . ' 00:00:00';
        $end   = $request->end . ' 23:59:59';
        $app = Application::with([
            'educations',
            'skillLangs',
            'skillPrograms',
            'trainings',
            'workExperiences'
        ])->whereBetween('created_at', [$start, $end]);

        if ($position !== 'all') {
            $app->where('position', $position);
        }

        $applications = $app->orderBy('id', 'desc')->get();

        if (!$applications) {
            return response()->json([
                'message' => 'Application not found',
                'status' => 'error'
            ], 404);
        }
        return response()->json([
            'application' => $applications,
            'status' => 'success'
        ]);
    }

    public function show($id)
    {
        $app = Application::with([
            'educations',
            'skillLangs',
            'skillPrograms',
            'trainings',
            'workExperiences'
        ])->find($id);

        if (!$app) {
            return response()->json([
                'message' => 'Application not found',
                'status' => 'error'
            ], 404);
        }

        return response()->json([
            'application' => $app,
            'status' => 'success'
        ]);
    }   

    public function update(Request $request, $id)
    {
        $app = Application::find($id);
        if (!$app) {
            return response()->json([
                'message' => 'Application not found',
                'status' => 'error'
            ], 404);
        }

        // Update application logic here
        $app->application_status = $request->input('status');
        $app->save();

        return response()->json([
            'message' => 'Application updated successfully',
            'status' => 'success'
        ], 200);
    }   
}
