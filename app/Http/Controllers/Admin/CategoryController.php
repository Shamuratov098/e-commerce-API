<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly CategoryService $categoryService
    ) {}

    /**
     * Display a listing of categories.
     */
    public function index(): View
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);

        return $this->view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create(): View
    {
        return $this->view('categories.create');
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:categories,title',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $this->categoryService->store($validated);

        return $this->success('admin.categories.index', 'Kategoriya muvaffaqiyatli yaratildi!');
    }

    /**
     * Show the form for editing the category.
     */
    public function edit(Category $category): View
    {
        return $this->view('categories.edit', compact('category'));
    }

    /**
     * Update the category.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
            'slug' => 'nullable|string|max:255|unique:categories,slug,'.$category->id,
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $this->categoryService->update($category, $validated);

        return $this->success('admin.categories.index', 'Kategoriya muvaffaqiyatli yangilandi!');
    }

    /**
     * Remove the category.
     */
    public function destroy(Category $category): RedirectResponse
    {
        // Check if category has products
        if ($category->products()->count() > 0) {
            return $this->errorBack('Bu kategoriyada mahsulotlar mavjud. Avval ularni o\'chiring yoki boshqa kategoriyaga ko\'chiring.');
        }

        $this->categoryService->destroy($category);

        return $this->successBack('Kategoriya muvaffaqiyatli o\'chirildi!');
    }
}
