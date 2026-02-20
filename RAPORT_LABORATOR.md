# 📋 RAPORT LABORATOR - MODELE ÎN LARAVEL

## Conectarea la Baza de Date PostgreSQL

### Configurare .env
```
DB_CONNECTION=pgsql
DB_HOST=localhost
DB_PORT=5432
DB_DATABASE=proiect_laravel
DB_USERNAME=postgres
DB_PASSWORD=aspnet
```

Baza de date `proiect_laravel` a fost creată și conectată cu succes în pgAdmin.

---

## Entități Proiectului

### 1️⃣ **ServiceCategory** (Categoria de Servicii)
```sql
CREATE TABLE service_categories (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) UNIQUE NOT NULL,
    description TEXT,
    slug VARCHAR(255) UNIQUE NOT NULL,
    display_order INTEGER DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### 2️⃣ **Service** (Servicii)
```sql
CREATE TABLE services (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    category_id BIGINT NOT NULL REFERENCES service_categories(id) ON DELETE CASCADE,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

## Modelele Eloquent

### ServiceCategory Model
```php
class ServiceCategory extends Model
{
    protected $fillable = ['name', 'description', 'slug', 'display_order'];

    // Relație: O categorie are mai multe servicii
    public function services()
    {
        return $this->hasMany(Service::class, 'category_id');
    }
}
```

### Service Model
```php
class Service extends Model
{
    protected $fillable = ['title', 'description', 'price', 'category_id', 'is_active'];

    // Relație: Un serviciu aparține unei categorii
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }
}
```

---

## Rutele API CRUD

### 📌 GET - Afiseaza Toate Serviciile
```
GET /api/services
```
**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Website Development",
      "description": "Crearea unui website modern cu Laravel",
      "price": "1500.00",
      "category_id": 1,
      "is_active": true,
      "category": {
        "id": 1,
        "name": "Web Development"
      }
    }
  ]
}
```

### 📌 GET - Afiseaza un Serviciu Dupa ID
```
GET /api/services/{id}
```
**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Website Development",
    "description": "Crearea unui website modern cu Laravel",
    "price": "1500.00",
    "category_id": 1,
    "is_active": true,
    "category": {
      "id": 1,
      "name": "Web Development"
    }
  }
}
```

### 📌 POST - Creeaza un Serviciu Nou
```
POST /api/services
```
**Request Body:**
```json
{
  "title": "Website Development",
  "description": "Crearea unui website modern cu Laravel",
  "price": 1500.00,
  "category_id": 1,
  "is_active": true
}
```
**Response:**
```json
{
  "success": true,
  "message": "Serviciul a fost creat cu succes",
  "data": {
    "id": 6,
    "title": "Website Development",
    "price": "1500.00",
    "category_id": 1
  }
}
```

### 📌 PUT/PATCH - Actualizeaza un Serviciu
```
PUT /api/services/{id}
PATCH /api/services/{id}
```
**Request Body:**
```json
{
  "price": 1799.99,
  "is_active": false
}
```
**Response:**
```json
{
  "success": true,
  "message": "Serviciul a fost actualizat cu succes",
  "data": {
    "id": 1,
    "price": "1799.99",
    "is_active": false
  }
}
```

### 📌 DELETE - Sterge un Serviciu
```
DELETE /api/services/{id}
```
**Response:**
```json
{
  "success": true,
  "message": "Serviciul a fost sters cu succes"
}
```

---

## Rute de Filtrare și Sortare

### 1️⃣ Filtreaza Dupa Categorie
```
GET /api/services/category/{categoryId}
```
**Exemplu:** `/api/services/category/1`

**Response:**
```json
{
  "success": true,
  "category": "Web Development",
  "data": [
    {
      "id": 1,
      "title": "Website Development",
      "price": "1500.00"
    },
    {
      "id": 2,
      "title": "E-commerce Platform",
      "price": "3500.00"
    }
  ]
}
```

**SQL Generat:**
```sql
SELECT * FROM services 
WHERE category_id = 1 AND is_active = true;
```

### 2️⃣ Sorteaza Dupa Pret (Ascending)
```
GET /api/services/sort/asc
```

**Response:**
```json
{
  "success": true,
  "order": "asc",
  "data": [
    {"id": 5, "title": "UI/UX Design", "price": "800.00"},
    {"id": 1, "title": "Website Development", "price": "1500.00"},
    {"id": 3, "title": "Android App Development", "price": "2500.00"}
  ]
}
```

**SQL Generat:**
```sql
SELECT * FROM services ORDER BY price ASC;
```

### 3️⃣ Sorteaza Dupa Pret (Descending)
```
GET /api/services/sort/desc
```

**Response:**
```json
{
  "success": true,
  "order": "desc",
  "data": [
    {"id": 2, "title": "E-commerce Platform", "price": "3500.00"},
    {"id": 4, "title": "iOS App Development", "price": "2800.00"},
    {"id": 3, "title": "Android App Development", "price": "2500.00"}
  ]
}
```

### 4️⃣ Servicii Cu Pret Mai Mic Decat o Valoare
```
GET /api/services/price-range/{maxPrice}
```

**Exemplu:** `/api/services/price-range/2000`

**Response:**
```json
{
  "success": true,
  "max_price": 2000,
  "count": 2,
  "data": [
    {"id": 5, "title": "UI/UX Design", "price": "800.00"},
    {"id": 1, "title": "Website Development", "price": "1500.00"}
  ]
}
```

**SQL Generat:**
```sql
SELECT * FROM services 
WHERE is_active = true AND price <= 2000 
ORDER BY price ASC;
```

### 5️⃣ Statistici
```
GET /api/statistics
```

**Response:**
```json
{
  "success": true,
  "data": {
    "total_services": 5,
    "active_services": 5,
    "total_categories": 3,
    "average_price": 2220,
    "categories_breakdown": [
      {
        "id": 1,
        "name": "Web Development",
        "services_count": 2
      },
      {
        "id": 2,
        "name": "Mobile Development",
        "services_count": 2
      },
      {
        "id": 3,
        "name": "Design",
        "services_count": 1
      }
    ]
  }
}
```

---

## Rezultate Testare CRUD

### ✅ TEST 1: GET /api/services
```
Total servicii: 5
  - [1] Website Development - 1500.00 RON (Web Development)
  - [2] E-commerce Platform - 3500.00 RON (Web Development)
  - [3] Android App Development - 2500.00 RON (Mobile Development)
  - [4] iOS App Development - 2800.00 RON (Mobile Development)
  - [5] UI/UX Design - 800.00 RON (Design)
```

### ✅ TEST 2: GET /api/services/1
```
ID: 1
Titlu: Website Development
Descriere: Crearea unui website modern cu Laravel
Pret: 1500.00 RON
Categorie: Web Development
Activ: DA
```

### ✅ TEST 3: Filtreaza Dupa Categoria 1
```
Categoria: Web Development
Servicii active: 2
  - [1] Website Development - 1500.00 RON
  - [2] E-commerce Platform - 3500.00 RON
```

### ✅ TEST 4: Sorteaza Dupa Pret (ASC)
```
Ordine: asc
  - UI/UX Design: 800.00 RON
  - Website Development: 1500.00 RON
  - Android App Development: 2500.00 RON
  - iOS App Development: 2800.00 RON
  - E-commerce Platform: 3500.00 RON
```

### ✅ TEST 5: Servicii Cu Pret <= 2000 RON
```
Pret maxim: 2000 RON
Servicii gasite: 2
  - [5] UI/UX Design - 800.00 RON
  - [1] Website Development - 1500.00 RON
```

### ✅ TEST 6: Statistici
```
Total servicii: 5
Servicii active: 5
Total categorii: 3
Pret mediu: 2220 RON
```

### ✅ TEST 7: POST /api/services (CREATE)
```
Serviciu creat cu succes!
ID: 6
Titlu: Test Service - 12:06:00
Pret: 999.99 RON
```

### ✅ TEST 8: PUT /api/services/6 (UPDATE)
```
Serviciu actualizat cu succes!
Titlu nou: Test Service UPDATED - 12:06:00
Pret vechi: 999.99 RON → Pret nou: 1299.99 RON
```

### ✅ TEST 9: DELETE /api/services/6
```
Serviciu sters cu succes!
Titlu sters: 'Test Service UPDATED - 12:06:00'
```

---

## Structura Directoare Proiectului

```
proiect-laravel/
├── app/
│   ├── Models/
│   │   ├── Service.php
│   │   ├── ServiceCategory.php
│   │   └── User.php
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ServiceController.php
│   │       ├── SiteController.php
│   │       └── LoginController.php
│   └── Console/
│       └── Commands/
│           └── TestCrudApi.php
├── database/
│   ├── migrations/
│   │   ├── 2026_02_20_115227_create_service_categories_table.php
│   │   ├── 2026_02_20_115240_create_services_table.php
│   │   ├── 2026_02_20_115951_alter_services_table_add_columns.php
│   │   └── ...alte migrații
│   └── seeders/
│       ├── ServiceCategorySeeder.php
│       ├── ServiceSeeder.php
│       └── DatabaseSeeder.php
├── routes/
│   └── web.php (cu rute API CRUD)
└── ...alte fișiere

```

---

## Comenzi Artisan Utilizate

```bash
# Creare modele și migrații
php artisan make:model ServiceCategory -m
php artisan make:model Service -m

# Creare controller
php artisan make:controller ServiceController

# Creare seeders
php artisan make:seeder ServiceCategorySeeder
php artisan make:seeder ServiceSeeder

# Rulare migrații
php artisan migrate

# Populare bază de date
php artisan db:seed

# Testare CRUD
php artisan test:crud-api

# Vizualizare status migrații
php artisan migrate:status
```

---

## Validări Implementate

```php
$validated = $request->validate([
    'title' => 'required|string|max:255',
    'description' => 'required|string',
    'price' => 'required|numeric|min:0',
    'category_id' => 'required|exists:service_categories,id',
    'is_active' => 'boolean'
]);
```

---

## Relații Eloquent

### Service → ServiceCategory (One-to-Many)
```php
// În model Service
public function category()
{
    return $this->belongsTo(ServiceCategory::class, 'category_id');
}

// În model ServiceCategory
public function services()
{
    return $this->hasMany(Service::class, 'category_id');
}

// Utilizare
$service = Service::with('category')->find(1);
echo $service->category->name; // "Web Development"
```

---

## Concluzii

✅ **Baza de date** - PostgreSQL conectată și funcțională  
✅ **Modelele** - Entități create cu relații definite  
✅ **Migrații** - Toate tabelele create corect  
✅ **CRUD Complet** - GET, POST, PUT/PATCH, DELETE implementate  
✅ **Filtrare** - După categorie și pret range  
✅ **Sortare** - După pret (ascending/descending)  
✅ **Statistici** - Calculări și rapoarte  
✅ **Validări** - Toate câmpurile validate  
✅ **Teste** - Toate operațiile au fost testate cu succes  

---

**Data:** 20 februarie 2026  
**Status:** ✅ COMPLETAT
