<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\IssueResource;
use App\Models\Issue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function view(): JsonResponse
    {
        $issues = Issue::all();
        //        $issues = Issue::where('user_id', auth()->user()->id)->get();
        if ($issues->count() > 0) {
            return $this->success(data: IssueResource::collection($issues));
        }

        return $this->error('Not Found', 404);

    }

    public function store(Request $request): JsonResponse
    {
        $issue = Issue::create([
            //            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'is_solved' => $request->is_solved,

        ]);

        return $this->success(data: new IssueResource($issue));
    }
}
