<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $subjects = Subject::all();

        // Transform the subjects using the SubjectResource
        $subjectResource = SubjectResource::collection($subjects);

        // Return the transformed data as JSON:
        return response()->json(['subjects' => $subjectResource], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubjectRequest $request): \Illuminate\Http\JsonResponse
    {
        if($request->validated()){
            $data = $request->all();
            $subject = Subject::create($data);

            // Transform the subject using the SubjectResource:
            $subjectResource = new SubjectResource($subject);

            // Return the transformed data as JSON:
            return response()->json([
                'message' => "New subject successfully added",
                'information' => $subjectResource
            ], 200);
        }
        return response()->json(['message' => "New subject couldn't be added. Check for any errors"], 422);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubjectRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        $subject = Subject::findOrFail($id);

        if($subject && $request->validated()){
            $data = $request->all();
            $subject->update($data);

            // Transform the updated subject using the SubjectResource:
            $subjectResource = new SubjectResource($subject);

            // Return the transformed data as JSON:
            return response()->json([
                'message' => "Subject was successfully updated",
                'information' => $subjectResource
            ], 200);
        }
        return response()->json(['message' => "Subject couldn't be updated. Check for any errors"], 422);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
