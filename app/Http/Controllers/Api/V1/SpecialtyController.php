<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpecialtyRequest;
use App\Http\Resources\SpecialtyResource;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $specialties = Specialty::all();

        // Transform the specialties using the SpecialtyResource:
        $subjectResource = SpecialtyResource::collection($specialties);

        // Return the transformed data as JSON:
        return response()->json(['specialties' => $subjectResource], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecialtyRequest $request): \Illuminate\Http\JsonResponse
    {
        if($request->validated()){
            $data = $request->all();
            $specialty = Specialty::create($data);

            // Transform the specialty using the SpecialtyResource:
            $specialtyResource = new SpecialtyResource($specialty);

            // Return the transformed data as JSON:
            return response()->json([
                'message' => "New specialty successfully added",
                'information' => $specialtyResource
            ], 200);
        }
        return response()->json(['message' => "New specialty couldn't be added. Check for any errors in the data"], 422);
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialty $specialty): \Illuminate\Http\JsonResponse
    {
        // Transform the specialty using the SpecialtyResource:
        $specialtyResource = new SpecialtyResource($specialty);

        return response()->json(['specialty' => $specialtyResource], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialty $specialty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty)
    {
        //
    }
}
