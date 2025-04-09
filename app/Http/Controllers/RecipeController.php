<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RecipeController extends Controller
{
    // Show all recipes (public)
    public function index()
    {
        $recipes = Recipe::with('user')->latest()->paginate(10);
        return view('recipes.index', compact('recipes'));
    }

    // Show single recipe (public)
    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    // Show create form (protected by auth middleware)
    public function create()
    {
        //dd('Reached create method'); // Should see this message
        return view('recipes.create');
    }

    // Store new recipe (protected by auth middleware)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'type' => 'required|in:French,Italian,Chinese,Indian,Mexican,others',
            'cookingtime' => 'required|integer|min:1',
            'ingredients' => 'required',
            'instructions' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('recipe_images', 'public');
            $validated['image'] = $imagePath;
        }

        
        $validated['uid'] = Auth::id();

        Recipe::create($validated);

        return redirect()->route('recipes.index')->with('success', 'Recipe created!');
    }

    // Show edit form (protected by auth middleware)
    public function edit(Recipe $recipe)
    {
        // Manual authorization check
        if ($recipe->uid !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('recipes.edit', compact('recipe'));
    }

    // Update recipe (protected by auth middleware)
    public function update(Request $request, Recipe $recipe)
    {
        // Manual authorization check
        if ($recipe->uid !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'type' => 'required|in:French,Italian,Chinese,Indian,Mexican,others',
            'cookingtime' => 'required|integer|min:1',
            'ingredients' => 'required',
            'instructions' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($recipe->image) {
                Storage::disk('public')->delete($recipe->image);
            }
            $imagePath = $request->file('image')->store('recipe_images', 'public');
            $validated['image'] = $imagePath;
        }

        $recipe->update($validated);

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recipe updated!');
    }

    // Delete recipe (protected by auth middleware)
    public function destroy(Recipe $recipe)
    {
        // Manual authorization check
        if ($recipe->uid !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Delete image if exists
        if ($recipe->image) {
            Storage::disk('public')->delete($recipe->image);
        }
        
        $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recipe deleted!');
    }

    // Search recipes (public)
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        if (empty($query)) {
            return redirect()->route('recipes.index');
        }
        
        $recipes = Recipe::where('name', 'like', "%$query%")
                    ->orWhere('type', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%")
                    ->orWhere('ingredients', 'like', "%$query%")
                    ->paginate(10)
                    ->appends(['query' => $query]); // Preserve query in pagination links
                    
        return view('recipes.index', [
            'recipes' => $recipes,
            'query' => $query
        ]);
    }
}