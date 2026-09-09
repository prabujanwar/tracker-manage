<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LifeArea\StoreLifeAreaRequest;
use App\Http\Requests\LifeArea\UpdateLifeAreaRequest;
use App\Models\LifeArea;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LifeAreaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $request->user()->lifeAreas()->orderBy('name')->get(),
        ]);
    }

    public function store(StoreLifeAreaRequest $request): JsonResponse
    {
        $lifeArea = $request->user()->lifeAreas()->create($request->validated());

        return response()->json([
            'success' => true,
            'data' => ['life_area' => $lifeArea],
        ], 201);
    }

    public function update(UpdateLifeAreaRequest $request, LifeArea $lifeArea): JsonResponse
    {
        abort_unless($lifeArea->user_id === $request->user()->id, 404);
        $lifeArea->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => ['life_area' => $lifeArea->fresh()],
        ]);
    }

    public function destroy(Request $request, LifeArea $lifeArea): JsonResponse
    {
        abort_unless($lifeArea->user_id === $request->user()->id, 404);
        abort_if($lifeArea->is_default, 422, 'Default life areas cannot be deleted.');
        $lifeArea->delete();

        return response()->json(['success' => true, 'data' => null]);
    }
}
