<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductSizeController extends Controller
{
    public function store(
        Request $request,
        Product $product
    ): RedirectResponse {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('product_sizes')
                    ->where('product_id', $product->id),
            ],
            'price' => ['required', 'numeric', 'min:0'],
            'order' => ['required', 'integer', 'min:0'],
            'is_default' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_default'] = $request->boolean('is_default');
        $data['is_active'] = $request->boolean('is_active');

        if ($data['is_default']) {
            $product->sizes()->update([
                'is_default' => false,
            ]);
        }

        $product->sizes()->create($data);

        return back()->with(
            'success',
            'Product size added successfully.'
        );
    }

    public function update(
        Request $request,
        ProductSize $size
    ): RedirectResponse {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('product_sizes')
                    ->where('product_id', $size->product_id)
                    ->ignore($size->id),
            ],
            'price' => ['required', 'numeric', 'min:0'],
            'order' => ['required', 'integer', 'min:0'],
            'is_default' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_default'] = $request->boolean('is_default');
        $data['is_active'] = $request->boolean('is_active');

        if ($data['is_default']) {
            ProductSize::where('product_id', $size->product_id)
                ->where('id', '!=', $size->id)
                ->update(['is_default' => false]);
        }

        $size->update($data);

        return back()->with(
            'success',
            'Product size updated successfully.'
        );
    }

    public function destroy(
        ProductSize $size
    ): RedirectResponse {
        $size->delete();

        return back()->with(
            'success',
            'Product size deleted successfully.'
        );
    }
}