<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PersonalityStoreRequest;
use App\Http\Requests\Api\PersonalityUpdateRequest;
use App\Http\Resources\Api\PersonalityCollection;
use App\Http\Resources\Api\PersonalityResource;
use App\Models\Personality;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PersonalityController extends Controller
{
    public function index(Request $request): PersonalityCollection
    {
        $personalities = Personality::all();

        return new PersonalityCollection($personalities);
    }

    public function store(PersonalityStoreRequest $request): PersonalityResource
    {
        $personality = Personality::create($request->validated());

        return new PersonalityResource($personality);
    }

    public function show(Request $request, Personality $personality): PersonalityResource
    {
        return new PersonalityResource($personality);
    }

    public function update(PersonalityUpdateRequest $request, Personality $personality): PersonalityResource
    {
        $personality->update($request->validated());

        return new PersonalityResource($personality);
    }

    public function destroy(Request $request, Personality $personality): Response
    {
        $personality->delete();

        return response()->noContent();
    }
}
