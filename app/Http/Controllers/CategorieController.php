<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Exception;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Categorie::all();
            return view('index', compact('categories'));
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
            $categorie = Categorie::create($request->all());
            return response()->json($categorie, 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        try {
            return view('detail-product', compact('categorie'));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        try {
            $categorie->update($request->all());
            return response()->json($categorie, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        try {
            $categorie->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
