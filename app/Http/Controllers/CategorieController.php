<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Http\Requests\StorecategorieRequest;
use App\Http\Requests\UpdatecategorieRequest;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorecategorieRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(category $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecategorieRequest $request, category $categorie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $categorie)
    {
        //
    }
}
