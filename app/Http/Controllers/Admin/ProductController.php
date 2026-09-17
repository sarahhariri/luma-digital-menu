<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Extra;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->with('category')
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view(
            'admin.products.create',
            compact('categories')
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateProduct($request);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_featured'] =
            $request->boolean('is_featured');
        $validated['is_active'] =
            $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $validated['image'] =
                $this->uploadImage($request);
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orWhere('id', $product->category_id)
            ->orderBy('order')
            ->get();
            $product->load('sizes', 'extras');

            $extras = Extra::query()
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.products.edit',
            compact('product', 'categories', 'extras')
        );
    }

    public function update(
        Request $request,
        Product $product
    ): RedirectResponse {
        $validated = $this->validateProduct(
            $request,
            $product
        );

        $validated['slug'] = Str::slug($validated['name']);
        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_featured'] =
            $request->boolean('is_featured');
        $validated['is_active'] =
            $request->boolean('is_active');

        if ($request->hasFile('image')) {
            $newImage = $this->uploadImage($request);

            if (
                $product->image &&
                File::exists(public_path($product->image))
            ) {
                File::delete(public_path($product->image));
            }

            $validated['image'] = $newImage;
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $image = $product->image;

        $product->delete();

        if (
            $image &&
            File::exists(public_path($image))
        ) {
            File::delete(public_path($image));
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    private function validateProduct(
        Request $request,
        ?Product $product = null
    ): array {
        return $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('products', 'name')
                    ->ignore($product?->id),
            ],
            'description' => [
                'nullable',
                'string',
                'max:500',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:999999.99',
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'order' => [
                'nullable',
                'integer',
                'min:0',
            ],
            'is_featured' => [
                'nullable',
                'boolean',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);
    }

    private function uploadImage(Request $request): string
    {
        $directory = public_path('assets/images/products');

        File::ensureDirectoryExists($directory);

        $image = $request->file('image');

        $imageName = Str::uuid()
            . '.'
            . $image->extension();

        $image->move($directory, $imageName);

        return 'assets/images/products/' . $imageName;
    }

    public function syncExtras(
    Request $request,
    Product $product
): RedirectResponse {
    $validated = $request->validate([
        'extras' => ['nullable', 'array'],
        'extras.*' => [
            'integer',
            'exists:extras,id',
        ],
    ]);

    $product->extras()->sync(
        $validated['extras'] ?? []
    );

    return back()->with(
        'success',
        'Product extras updated successfully.'
    );
}
}