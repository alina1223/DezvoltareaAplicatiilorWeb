<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
        public function index()
    {
        $services = Service::with('category')->get();
        return response()->json([
            'success' => true,
            'data' => $services
        ]);
    }

   
    public function show($id)
    {
        $service = Service::with('category')->find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Serviciul nu a fost gasit'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $service
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:service_categories,id',
            'is_active' => 'boolean'
        ]);

        $service = Service::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Serviciul a fost creat cu succes',
            'data' => $service->load('category')
        ], 201);
    }

   
    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Serviciul nu a fost gasit'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric|min:0',
            'category_id' => 'exists:service_categories,id',
            'is_active' => 'boolean'
        ]);

        $service->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Serviciul a fost actualizat cu succes',
            'data' => $service->load('category')
        ]);
    }

   
    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Serviciul nu a fost gasit'
            ], 404);
        }

        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Serviciul a fost sters cu succes'
        ]);
    }

    public function filterByCategory($categoryId)
    {
        $category = ServiceCategory::find($categoryId);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Categoria nu a fost gasita'
            ], 404);
        }

        $services = Service::where('category_id', $categoryId)
                          ->where('is_active', true)
                          ->get();

        return response()->json([
            'success' => true,
            'category' => $category->name,
            'data' => $services
        ]);
    }

    public function sortByPrice($order = 'asc')
    {
        if (!in_array($order, ['asc', 'desc'])) {
            return response()->json([
                'success' => false,
                'message' => 'Ordinea trebuie sa fie asc sau desc'
            ], 400);
        }

        $services = Service::orderBy('price', $order)->get();

        return response()->json([
            'success' => true,
            'order' => $order,
            'data' => $services
        ]);
    }


    public function priceRange($maxPrice)
    {
        $services = Service::where('is_active', true)
                          ->where('price', '<=', $maxPrice)
                          ->orderBy('price', 'asc')
                          ->get();

        return response()->json([
            'success' => true,
            'max_price' => $maxPrice,
            'count' => count($services),
            'data' => $services
        ]);
    }

    public function statistics()
    {
        $totalServices = Service::count();
        $totalCategories = ServiceCategory::count();
        $activeServices = Service::where('is_active', true)->count();
        $averagePrice = Service::avg('price');
        
        $categoriesWithServices = ServiceCategory::withCount('services')->get();

        return response()->json([
            'success' => true,
            'data' => [
                'total_services' => $totalServices,
                'active_services' => $activeServices,
                'total_categories' => $totalCategories,
                'average_price' => round($averagePrice, 2),
                'categories_breakdown' => $categoriesWithServices
            ]
        ]);
    }
}

