<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Inertia\Inertia;

Class CategoryController extends Controller
{
    public function view()
    {
        // Fetch all categories with all columns
        $categories = Categories::with('property')->get();

        return Inertia::render('Categories', [
            'categories' => $categories,
        ]);
    }
    
}