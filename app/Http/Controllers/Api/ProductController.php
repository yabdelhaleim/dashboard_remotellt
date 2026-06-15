<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    // GET /api/products
    public function index(): JsonResponse
    {
        $products = Product::with('packages')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn($p) => $this->format($p));

        return response()->json($products);
    }

    // GET /api/products/{slug}
    public function show(string $slug): JsonResponse
    {
        $product = Product::with('packages')->where('slug', $slug)->firstOrFail();
        return response()->json($this->format($product));
    }

    // POST /api/products
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'slug'         => 'required|string|unique:products,slug',
            'name'         => 'required|string|max:255',
            'description'  => 'nullable|string',
            'icon'         => 'nullable|string',
            'external_url' => 'nullable|url',
            'sort_order'   => 'nullable|integer',
        ]);

        $product = Product::create($data);
        return response()->json($this->format($product->load('packages')), 201);
    }

    // PUT /api/products/{id}
    public function update(Request $request, int $id): JsonResponse
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'slug'         => 'sometimes|string|unique:products,slug,' . $id,
            'name'         => 'sometimes|string|max:255',
            'description'  => 'nullable|string',
            'icon'         => 'nullable|string',
            'external_url' => 'nullable',
            'sort_order'   => 'nullable|integer',
            'is_active'    => 'sometimes|boolean',
        ]);

        $product->update($data);
        return response()->json($this->format($product->load('packages')));
    }

    // DELETE /api/products/{id}
    public function destroy(int $id): JsonResponse
    {
        Product::findOrFail($id)->delete();
        return response()->json(['ok' => true]);
    }

    // POST /api/products/{id}/packages
    public function addPackage(Request $request, int $id): JsonResponse
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name'        => 'required|string',
            'price'       => 'required|numeric|min:0',
            'features'    => 'nullable|array',
            'highlighted' => 'nullable|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $pkg = $product->packages()->create($data);
        return response()->json($pkg, 201);
    }

    // DELETE /api/packages/{id}
    public function removePackage(int $id): JsonResponse
    {
        Package::findOrFail($id)->delete();
        return response()->json(['ok' => true]);
    }

    // PUT /api/packages/{id}
    public function updatePackage(Request $request, int $id): JsonResponse
    {
        $pkg = Package::findOrFail($id);

        $data = $request->validate([
            'name'        => 'sometimes|string',
            'price'       => 'sometimes|numeric|min:0',
            'features'    => 'nullable|array',
            'highlighted' => 'sometimes|boolean',
            'sort_order'  => 'nullable|integer',
        ]);

        $pkg->update($data);
        return response()->json($pkg);
    }

    // ---------------------------------------------------------------
    private function format(Product $p): array
    {
        return [
            'id'           => (string) $p->id,
            'slug'         => $p->slug,
            'name'         => $p->name,
            'description'  => $p->description,
            'icon'         => $p->icon,
            'externalUrl'  => $p->external_url ?? '',
            'is_active'    => $p->is_active,
            'sort_order'   => $p->sort_order,
            'packages'     => $p->packages->map(fn($pkg) => [
                'id'          => (string) $pkg->id,
                'name'        => $pkg->name,
                'price'       => (float) $pkg->price,
                'features'    => $pkg->features ?? [],
                'highlighted' => (bool) $pkg->highlighted,
            ])->values()->toArray(),
        ];
    }
}
