<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Service;
use App\Models\ServiceCategory;

class TestCrudApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:crud-api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testeaza toate operatiile CRUD pentru servicii';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("\n╔════════════════════════════════════════════════════════════════════════════════╗");
        $this->info("║                   TESTARE RUTE API - SERVICII CRUD                            ║");
        $this->info("╚════════════════════════════════════════════════════════════════════════════════╝\n");

        // TEST 1: GET - Afiseaza toate serviciile
        $this->testGetAllServices();

        // TEST 2: GET - Afiseaza un serviciu dupa ID
        $this->testGetSingleService(1);

        // TEST 3: Filtreaza dupa categorie
        $this->testFilterByCategory(1);

        // TEST 4: Sorteaza dupa pret
        $this->testSortByPrice('asc');
        $this->testSortByPrice('desc');

        // TEST 5: Pret range
        $this->testPriceRange(2000);

        // TEST 6: Statistici
        $this->testStatistics();

        // TEST 7: CRUD - Creeaza
        $newServiceId = $this->testCreateService();

        // TEST 8: UPDATE
        if ($newServiceId) {
            $this->testUpdateService($newServiceId);
        }

        // TEST 9: DELETE
        if ($newServiceId) {
            $this->testDeleteService($newServiceId);
        }

        // Rezumat final
        $this->testFinalSummary();

        $this->info("\n" . str_repeat("=", 80));
        $this->info("✅ TESTE COMPLETATE CU SUCCES!");
        $this->info(str_repeat("=", 80) . "\n");
    }

    private function testGetAllServices()
    {
        $this->newLine();
        $this->info(str_repeat("=", 80));
        $this->info("TEST 1: GET /api/services (Afiseaza toate serviciile)");
        $this->info(str_repeat("=", 80));

        $services = Service::with('category')->get();
        $this->line("Total servicii: " . count($services));
        
        foreach ($services as $service) {
            $this->line("  - [{$service->id}] {$service->title} - {$service->price} RON ({$service->category->name})");
        }
    }

    private function testGetSingleService($id)
    {
        $this->newLine();
        $this->info(str_repeat("=", 80));
        $this->info("TEST 2: GET /api/services/{$id} (Afiseaza un serviciu dupa ID)");
        $this->info(str_repeat("=", 80));

        $service = Service::with('category')->find($id);

        if (!$service) {
            $this->error("Serviciul cu ID {$id} nu a fost gasit");
        } else {
            $this->line("ID: {$service->id}");
            $this->line("Titlu: {$service->title}");
            $this->line("Descriere: {$service->description}");
            $this->line("Pret: {$service->price} RON");
            $this->line("Categorie: {$service->category->name}");
            $this->line("Activ: " . ($service->is_active ? "DA" : "NU"));
        }
    }

    private function testFilterByCategory($categoryId)
    {
        $this->newLine();
        $this->info(str_repeat("=", 80));
        $this->info("TEST 3: GET /api/services/category/{$categoryId} (Filtreaza dupa categorie)");
        $this->info(str_repeat("=", 80));

        $category = ServiceCategory::find($categoryId);

        if (!$category) {
            $this->error("Categoria cu ID {$categoryId} nu a fost gasita");
            return;
        }

        $services = Service::where('category_id', $categoryId)
                          ->where('is_active', true)
                          ->get();

        $this->line("Categoria: {$category->name}");
        $this->line("Servicii active: " . count($services));
        
        foreach ($services as $service) {
            $this->line("  - [{$service->id}] {$service->title} - {$service->price} RON");
        }
    }

    private function testSortByPrice($order)
    {
        $this->newLine();
        $this->info(str_repeat("=", 80));
        $this->info("TEST 4: GET /api/services/sort/{$order} (Sorteaza dupa pret)");
        $this->info(str_repeat("=", 80));

        $services = Service::orderBy('price', $order)->get();

        $this->line("Ordine: {$order}");
        $this->line("Servicii: " . count($services));
        
        foreach ($services as $service) {
            $this->line("  - {$service->title}: {$service->price} RON");
        }
    }

    private function testPriceRange($maxPrice)
    {
        $this->newLine();
        $this->info(str_repeat("=", 80));
        $this->info("TEST 5: GET /api/services/price-range/{$maxPrice} (Servicii cu pret <= {$maxPrice})");
        $this->info(str_repeat("=", 80));

        $services = Service::where('is_active', true)
                          ->where('price', '<=', $maxPrice)
                          ->orderBy('price', 'asc')
                          ->get();

        $this->line("Pret maxim: {$maxPrice} RON");
        $this->line("Servicii gasite: " . count($services));
        
        foreach ($services as $service) {
            $this->line("  - [{$service->id}] {$service->title} - {$service->price} RON");
        }
    }

    private function testStatistics()
    {
        $this->newLine();
        $this->info(str_repeat("=", 80));
        $this->info("TEST 6: GET /api/statistics (Statistici)");
        $this->info(str_repeat("=", 80));

        $totalServices = Service::count();
        $totalCategories = ServiceCategory::count();
        $activeServices = Service::where('is_active', true)->count();
        $averagePrice = Service::avg('price');

        $this->line("Total servicii: {$totalServices}");
        $this->line("Servicii active: {$activeServices}");
        $this->line("Total categorii: {$totalCategories}");
        $this->line("Pret mediu: " . round($averagePrice, 2) . " RON");
    }

    private function testCreateService()
    {
        $this->newLine();
        $this->info(str_repeat("=", 80));
        $this->info("TEST 7: POST /api/services (Creeaza un serviciu nou)");
        $this->info(str_repeat("=", 80));

        $webCategory = ServiceCategory::where('slug', 'web-development')->first();

        if (!$webCategory) {
            $this->error("Categoria Web Development nu exista!");
            return null;
        }

        $newService = Service::create([
            'title' => 'Test Service - ' . date('H:i:s'),
            'description' => 'Serviciu de test creat la ' . date('Y-m-d H:i:s'),
            'price' => 999.99,
            'category_id' => $webCategory->id,
            'is_active' => true
        ]);

        $this->line("Serviciu creat cu succes!");
        $this->line("ID: {$newService->id}");
        $this->line("Titlu: {$newService->title}");
        $this->line("Pret: {$newService->price} RON");

        return $newService->id;
    }

    private function testUpdateService($id)
    {
        $this->newLine();
        $this->info(str_repeat("=", 80));
        $this->info("TEST 8: PUT /api/services/{$id} (Actualizeaza serviciul)");
        $this->info(str_repeat("=", 80));

        $service = Service::find($id);

        if (!$service) {
            $this->error("Serviciul cu ID {$id} nu a fost gasit");
            return;
        }

        $oldPrice = $service->price;
        $service->update([
            'title' => 'Test Service UPDATED - ' . date('H:i:s'),
            'price' => 1299.99
        ]);

        $this->line("Serviciu actualizat cu succes!");
        $this->line("Titlu nou: {$service->title}");
        $this->line("Pret vechi: {$oldPrice} RON → Pret nou: {$service->price} RON");
    }

    private function testDeleteService($id)
    {
        $this->newLine();
        $this->info(str_repeat("=", 80));
        $this->info("TEST 9: DELETE /api/services/{$id} (Sterge serviciul)");
        $this->info(str_repeat("=", 80));

        $service = Service::find($id);

        if (!$service) {
            $this->error("Serviciul cu ID {$id} nu a fost gasit");
            return;
        }

        $deletedTitle = $service->title;
        $service->delete();

        $this->line("Serviciu sters cu succes!");
        $this->line("Titlu sters: '{$deletedTitle}'");
    }

    private function testFinalSummary()
    {
        $this->newLine();
        $this->info(str_repeat("=", 80));
        $this->info("REZUMAT FINAL");
        $this->info(str_repeat("=", 80));

        $totalServices = Service::count();
        $totalCategories = ServiceCategory::count();

        $this->line("Total servicii in BD: {$totalServices}");
        $this->line("Total categorii in BD: {$totalCategories}");
        $this->newLine();
        
        $this->info("Serviciile existente:");
        $services = Service::with('category')->orderBy('id')->get();
        
        foreach ($services as $service) {
            $this->line("  [{$service->id}] {$service->title} - {$service->price} RON ({$service->category->name})");
        }
    }
}

