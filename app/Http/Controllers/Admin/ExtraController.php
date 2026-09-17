<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ExtraController extends Controller
{
    public function index(): View
    {
        $extras = Extra::query()
            ->withCount('products')
            ->orderBy('order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.extras.index',
            compact('extras')
        );
    }

    public function create(): View
    {
        return view('admin.extras.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateExtra($request);

        $data['is_active'] = $request->boolean('is_active');

        Extra::create($data);

        return redirect()
            ->route('admin.extras.index')
            ->with('success', 'Extra created successfully.');
    }

    public function edit(Extra $extra): View
    {
        return view(
            'admin.extras.edit',
            compact('extra')
        );
    }

    public function update(
        Request $request,
        Extra $extra
    ): RedirectResponse {
        $data = $this->validateExtra($request, $extra);

        $data['is_active'] = $request->boolean('is_active');

        $extra->update($data);

        return redirect()
            ->route('admin.extras.index')
            ->with('success', 'Extra updated successfully.');
    }

    public function destroy(Extra $extra): RedirectResponse
    {
        $extra->products()->detach();
        $extra->delete();

        return redirect()
            ->route('admin.extras.index')
            ->with('success', 'Extra deleted successfully.');
    }

    private function validateExtra(
        Request $request,
        ?Extra $extra = null
    ): array {
        return $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('extras', 'name')
                    ->ignore($extra?->id),
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'order' => [
                'required',
                'integer',
                'min:0',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);
    }
}