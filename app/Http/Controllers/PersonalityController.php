<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonalityPostRequest;
use App\Models\Personality;
use App\Services\PersonalityImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class PersonalityController extends Controller
{
    public function index()
    {
        $personalities = Personality::all()->load('user')->toArray();
        return Inertia::render('Personality/Index', [
            'personalities' => $personalities,
            'isLogged' => auth()->check(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Personality/Store');
    }

    public function store(StorePersonalityPostRequest $request, PersonalityImageService $personalityImageService)
    {
        $imagePath = $request->file('image')->store('public/personalities');
        $image = $personalityImageService->resizeImage($request->file('image'))->save();

        $personality = new Personality();
        $personality->name = $request->name;
        $personality->description = $request->description;
        $personality->birthdate = $request->birthdate;
        $personality->deathdate = $request->deathdate;
        $personality->image = $imagePath;
        $personality->user_id = auth()->id();
        $personality->save();

        return redirect()->route('personality.index')->with('success', 'Personality created successfully');
    }
}
