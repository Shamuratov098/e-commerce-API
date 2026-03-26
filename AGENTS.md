# AGENTS.md — E-Commerce API

Guidance for AI coding agents working in this Laravel 13 e-commerce API repository.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Language | PHP 8.3+ |
| Framework | Laravel 13 |
| ORM | Eloquent (ActiveRecord) |
| Authentication | Laravel Sanctum 4 (token-based) |
| Database | SQLite (dev: `database/database.sqlite`, test: `:memory:`) |
| Testing | PHPUnit 12.5+ via `php artisan test` |
| Code Style | Laravel Pint (PSR-12 + Laravel preset) |
| Frontend Build | Vite 8 + Tailwind CSS 4 |

---

## Commands

```bash
# Development
composer dev                              # Full dev env: server + queue + logs + vite
php artisan serve                         # HTTP server only (port 8000)
npm run dev                               # Vite dev server

# Build
composer setup                            # Bootstrap: deps, key, migrate, build
npm run build                             # Compile frontend for production

# Testing (single test examples)
composer test                             # Run all tests
php artisan test tests/Feature/ExampleTest.php          # Single file
php artisan test --filter test_name                     # Single method
./vendor/bin/phpunit --filter MethodName                # PHPUnit direct

# Linting
./vendor/bin/pint                         # Fix all style issues
./vendor/bin/pint --test                  # Dry-run check
./vendor/bin/pint app/                    # Lint directory

# Database
php artisan migrate                       # Run pending migrations
php artisan migrate:fresh --seed          # Wipe, migrate, and seed
```

---

## Code Style Guidelines

### PHP Formatting
- **Indentation:** 4 spaces (no tabs)
- **Line endings:** LF (Unix)
- **Quotes:** Single quotes for strings — `'active'`, `'hashed'`
- **Semicolons:** Required
- **Final newline:** Always present
- **Brace style:** Opening brace on new line:
  ```php
  class ProductController extends Controller
  {
      public function index(): void
      {
          //
      }
  }
  ```
- **PHP opening tag:** `<?php` on line 1, blank line before `namespace`

### Naming Conventions

| Element | Convention | Example |
|---|---|---|
| Classes | PascalCase | `ProductController`, `OrderItem` |
| Methods | camelCase | `viewAny()`, `forceDelete()` |
| Variables | camelCase | `$orderItem`, `$totalAmount` |
| DB columns | snake_case | `category_id`, `stock_quantity` |
| DB tables | snake_case plural | `order_items`, `products` |
| Files: Controllers | `{Model}Controller.php` | `ProductController.php` |
| Files: Models | Singular PascalCase | `Product.php`, `OrderItem.php` |
| Files: Policies | `{Model}Policy.php` | `ProductPolicy.php` |
| Files: Form Requests | `Store{Model}Request.php` / `Update{Model}Request.php` | `StoreProductRequest.php` |
| Files: Factories | `{Model}Factory.php` | `ProductFactory.php` |
| Test methods | `snake_case` with `test_` prefix | `test_product_can_be_created()` |

> **Note:** The existing `Reviews` model uses a plural name — an inconsistency. Follow singular convention for new models.

### Import / Use Statements
- Group: app-internal first, then framework/vendor
- Alphabetical within groups (Pint enforces)
- One blank line between `namespace` and first `use`
- No blank lines between `use` statements
- Remove unused imports (do not import unused `Response` like policies do)

```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
```

### Models
- Extend `Illuminate\Database\Eloquent\Model`
- `HasFactory` with typed generic docblock:
  ```php
  /** @use HasFactory<\Database\Factories\ProductFactory> */
  use HasFactory;
  ```
- Use PHP 8 attributes for fillable/hidden (Laravel 11+):
  ```php
  #[Fillable(['name', 'price', 'slug'])]
  #[Hidden(['password'])]
  ```
- Define casts as method (not `$casts` property):
  ```php
  protected function casts(): array
  {
      return ['email_verified_at' => 'datetime'];
  }
  ```

### Migrations
- Anonymous class syntax: `return new class extends Migration { ... }`
- Foreign keys: `foreignId('user_id')->constrained('users')->cascadeOnDelete()`
- Polymorphic: `$table->morphs('reviewable')`
- DB-level enums: `$table->enum('status', ['active', 'soon'])`
- Always include `$table->timestamps()`

### Controllers
- Extend `App\Http\Controllers\Controller`
- Use route model binding — type-hint model in signature
- Return `JsonResponse` from API methods
- Inject `StoreXRequest`/`UpdateXRequest` — never validate inline

### Form Requests
- Extend `Illuminate\Foundation\Http\FormRequest`
- `authorize()` must return `true` to function (scaffolded `return false` is placeholder)
- `rules()` return type: `array<string, ValidationRule|array<mixed>|string>`

### Policies
- Implement all CRUD methods before protecting routes
- Pattern: `public function update(User $user, Product $product): bool`

### Error Handling
- Use Laravel's default handler — no custom exception classes
- Let exceptions propagate — no empty `try/catch`
- Use helpers: `abort(404)`, `abort(403)`, `throw new ModelNotFoundException`

### Testing
- Feature tests: extend `Tests\TestCase`
- Unit tests: extend `PHPUnit\Framework\TestCase`
- Use `RefreshDatabase` trait for DB tests
- Use factories: `Product::factory()->create([...])`

### JavaScript
- ES modules (`import`/`export`), single quotes
- No TypeScript — plain `.js` only

---

## Domain Models

```
users       → orders, carts, reviews
categories  → products
brands      → products; has many photos (polymorphic)
products    → category, brand; photos (morph), reviews (morph)
photos      → photoable (morph); is_main boolean
carts       → user, product; total_count
orders      → user; order_items; status: pending/processing/delivered/cancelled
order_items → order, product; quantity, price
reviews     → reviewable (morph), user; rating 1-5
```

Protect API routes with `->middleware('auth:sanctum')`.
