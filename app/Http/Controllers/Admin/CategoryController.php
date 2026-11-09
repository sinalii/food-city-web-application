<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index', ['categories' => Category::with(['products:id,category_id,name,brand,stock_quantity'])->withCount('products')->orderBy('sort_order')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:255'], 'code' => ['required', 'string', 'max:30', 'alpha_dash', 'unique:categories,code'], 'description' => ['nullable', 'string'], 'image' => ['nullable', 'image', 'max:5120']]);
        $image = $request->file('image')?->store('categories', 'public');
        Category::create(['name' => $data['name'], 'code' => strtoupper($data['code']), 'description' => $data['description'] ?? null, 'image_path' => $image, 'sort_order' => (int) Category::max('sort_order') + 1, 'is_active' => true]);

        return back()->with('success', 'Category added.');
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $request->validate(['name' => ['required', 'string', 'max:255'], 'code' => ['required', 'string', 'max:30', 'alpha_dash', 'unique:categories,code,'.$category->id], 'description' => ['nullable', 'string'], 'image' => ['nullable', 'image', 'max:5120'], 'is_active' => ['nullable', 'boolean']]);
        $category->fill(['name' => $data['name'], 'code' => strtoupper($data['code']), 'description' => $data['description'] ?? null, 'is_active' => $request->boolean('is_active')]);
        if ($request->hasFile('image')) {
            if ($category->image_path) Storage::disk('public')->delete($category->image_path);
            $category->image_path = $request->file('image')->store('categories', 'public');
        }
        $category->save();

        return back()->with('success', 'Category updated.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        abort_if($category->products()->exists(), 422, 'Move or delete this category’s products before deleting it.');
        if ($category->image_path) Storage::disk('public')->delete($category->image_path);
        $category->delete();

        return back()->with('success', 'Category deleted.');
    }
}
