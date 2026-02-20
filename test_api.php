<?php
/**
 * FIȘIER DE TESTARE A RUTELOR API PENTRU SERVICII
 * Instrucțiuni: Deschide în browser http://localhost/proiect-laravel/test_api.php
 */

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

// Boot the application
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Test functions
function test_get_all_services() {
    echo "\n" . str_repeat("=", 80) . "\n";
    echo "TEST 1: GET /api/services (Afiseaza toate serviciile)\n";
    echo str_repeat("=", 80) . "\n";
    
    $services = \App\Models\Service::with('category')->get();
    echo json_encode([
        'success' => true,
        'total' => count($services),
        'data' => $services
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    echo "\n";
}

function test_get_single_service($id = 1) {
    echo "\n" . str_repeat("=", 80) . "\n";
    echo "TEST 2: GET /api/services/{$id} (Afiseaza un serviciu dupa ID)\n";
    echo str_repeat("=", 80) . "\n";
    
    $service = \App\Models\Service::with('category')->find($id);
    
    if (!$service) {
        echo json_encode([
            'success' => false,
            'message' => 'Serviciul nu a fost gasit'
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
        echo json_encode([
            'success' => true,
            'data' => $service
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    echo "\n";
}

function test_filter_by_category($categoryId = 1) {
    echo "\n" . str_repeat("=", 80) . "\n";
    echo "TEST 3: GET /api/services/category/{$categoryId} (Filtreaza dupa categorie)\n";
    echo str_repeat("=", 80) . "\n";
    
    $category = \App\Models\ServiceCategory::find($categoryId);
    
    if (!$category) {
        echo json_encode([
            'success' => false,
            'message' => 'Categoria nu a fost gasita'
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
        $services = \App\Models\Service::where('category_id', $categoryId)
                                       ->where('is_active', true)
                                       ->get();
        
        echo json_encode([
            'success' => true,
            'category' => $category->name,
            'count' => count($services),
            'data' => $services
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    echo "\n";
}

function test_sort_by_price($order = 'asc') {
    echo "\n" . str_repeat("=", 80) . "\n";
    echo "TEST 4: GET /api/services/sort/{$order} (Sorteaza dupa pret - {$order})\n";
    echo str_repeat("=", 80) . "\n";
    
    $services = \App\Models\Service::orderBy('price', $order)->get();
    
    echo json_encode([
        'success' => true,
        'order' => $order,
        'count' => count($services),
        'data' => $services
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    echo "\n";
}

function test_price_range($maxPrice = 2000) {
    echo "\n" . str_repeat("=", 80) . "\n";
    echo "TEST 5: GET /api/services/price-range/{$maxPrice} (Servicii cu pret <= {$maxPrice})\n";
    echo str_repeat("=", 80) . "\n";
    
    $services = \App\Models\Service::where('is_active', true)
                                   ->where('price', '<=', $maxPrice)
                                   ->orderBy('price', 'asc')
                                   ->get();
    
    echo json_encode([
        'success' => true,
        'max_price' => $maxPrice,
        'count' => count($services),
        'data' => $services
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    echo "\n";
}

function test_statistics() {
    echo "\n" . str_repeat("=", 80) . "\n";
    echo "TEST 6: GET /api/statistics (Statistici)\n";
    echo str_repeat("=", 80) . "\n";
    
    $totalServices = \App\Models\Service::count();
    $totalCategories = \App\Models\ServiceCategory::count();
    $activeServices = \App\Models\Service::where('is_active', true)->count();
    $averagePrice = \App\Models\Service::avg('price');
    
    $categoriesWithServices = \App\Models\ServiceCategory::withCount('services')->get();
    
    echo json_encode([
        'success' => true,
        'data' => [
            'total_services' => $totalServices,
            'active_services' => $activeServices,
            'total_categories' => $totalCategories,
            'average_price' => round($averagePrice, 2),
            'categories_breakdown' => $categoriesWithServices
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    echo "\n";
}

function test_create_service() {
    echo "\n" . str_repeat("=", 80) . "\n";
    echo "TEST 7: POST /api/services (Creeaza un serviciu nou)\n";
    echo str_repeat("=", 80) . "\n";
    
    $webCategory = \App\Models\ServiceCategory::where('slug', 'web-development')->first();
    
    if (!$webCategory) {
        echo "EROARE: Categoria Web Development nu exista!\n";
        return;
    }
    
    $newService = \App\Models\Service::create([
        'title' => 'Test Service - ' . date('H:i:s'),
        'description' => 'Serviciu de test creat la ' . date('Y-m-d H:i:s'),
        'price' => 999.99,
        'category_id' => $webCategory->id,
        'is_active' => true
    ]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Serviciul a fost creat cu succes',
        'data' => $newService->load('category')
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    echo "\n";
    
    return $newService->id;
}

function test_update_service($id) {
    echo "\n" . str_repeat("=", 80) . "\n";
    echo "TEST 8: PUT /api/services/{$id} (Actualizeaza serviciul cu ID={$id})\n";
    echo str_repeat("=", 80) . "\n";
    
    $service = \App\Models\Service::find($id);
    
    if (!$service) {
        echo json_encode([
            'success' => false,
            'message' => 'Serviciul nu a fost gasit'
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
    }
    
    $service->update([
        'title' => 'Test Service UPDATED - ' . date('H:i:s'),
        'price' => 1299.99
    ]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Serviciul a fost actualizat cu succes',
        'data' => $service->load('category')
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    echo "\n";
}

function test_delete_service($id) {
    echo "\n" . str_repeat("=", 80) . "\n";
    echo "TEST 9: DELETE /api/services/{$id} (Sterge serviciul cu ID={$id})\n";
    echo str_repeat("=", 80) . "\n";
    
    $service = \App\Models\Service::find($id);
    
    if (!$service) {
        echo json_encode([
            'success' => false,
            'message' => 'Serviciul nu a fost gasit'
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;
    }
    
    $deletedTitle = $service->title;
    $service->delete();
    
    echo json_encode([
        'success' => true,
        'message' => "Serviciul '{$deletedTitle}' a fost sters cu succes"
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    echo "\n";
}

// Ruleaza testele
echo "\n\n";
echo "╔════════════════════════════════════════════════════════════════════════════════╗\n";
echo "║                   TESTARE RUTE API - SERVICII CRUD                            ║\n";
echo "╚════════════════════════════════════════════════════════════════════════════════╝\n";

test_get_all_services();
test_get_single_service(1);
test_filter_by_category(1);
test_sort_by_price('asc');
test_sort_by_price('desc');
test_price_range(2000);
test_statistics();

// Testare CRUD
$newServiceId = test_create_service();
if ($newServiceId) {
    test_update_service($newServiceId);
    test_delete_service($newServiceId);
}

// Final summary
echo "\n" . str_repeat("=", 80) . "\n";
echo "REZUMAT FINAL\n";
echo str_repeat("=", 80) . "\n";
echo json_encode([
    'total_services' => \App\Models\Service::count(),
    'total_categories' => \App\Models\ServiceCategory::count(),
    'all_services' => \App\Models\Service::with('category')->get()
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
echo "\n\n";
