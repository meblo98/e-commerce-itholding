<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Exception;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            //limiter a 10
            $marques = Marque::limit(10)->get();
            return view('index', compact('marques'));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $marque = Marque::create();
            $marque->nom = $request->input('nom');
            $marque->description = $request->input('description');
            if ($request->hasFile('logo')) {
                $marque->logo = $this->storeImage($request->file('logo'));
            }
            $marque->save();
            return response()->json($marque, 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Marque $marque)
    {
        try {
            return view('index', compact('marque'));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marque $marque) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marque $marque)
    {
        try {
            $marque->nom = $request->input('nom');
            $marque->description = $request->input('description');
            if ($request->hasFile('logo')) {
                $marque->logo = $this->storeImage($request->file('logo'));
            }
            $marque->save();
            return response()->json($marque, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marque $marque)
    {
        try {
            $marque->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function storeImage($image)
    {
        return $image->store('marques', 'public');
    }
}
