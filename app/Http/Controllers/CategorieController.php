<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::withCount('produits')->latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|unique:categories',
            'description' => 'nullable'
        ]);

        Categorie::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function edit(Categorie $categorie)
    {
        return view('categories.edit', compact('categorie'));
    }

    public function update(Request $request, Categorie $categorie)
    {
        $validated = $request->validate([
            'nom' => 'required|unique:categories,nom,' . $categorie->id,
            'description' => 'nullable'
        ]);

        $categorie->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Catégorie mise à jour avec succès.'
            ]);
        }

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function destroy(Categorie $category)
    {
        try {
            if ($category->produits()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Impossible de supprimer une catégorie contenant des produits.'
                ], 422);
            }

            $category->delete();

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Catégorie supprimée avec succès.'
                ]);
            }

            return redirect()->route('categories.index')
                ->with('success', 'Catégorie supprimée avec succès.');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Une erreur est survenue lors de la suppression.'
                ], 500);
            }

            return redirect()->route('categories.index')
                ->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }
} 