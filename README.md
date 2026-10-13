# Maho Size Chart

Size chart module **for [Maho Commerce](https://mahocommerce.com) only**.

Manage reusable size guides in admin, assign them to products, and show a size-guide link with a modal on the product page.

**Composer:** `kalp707/maho-sizechart`  
**Repository:** https://github.com/kalp707/maho-sizechart

## Requirements

- Maho Commerce `>=26.5` (PHP 8.2+)
- Not supported on Magento 1 / OpenMage

## Features

- Admin CRUD for size charts (WYSIWYG content with CMS directive filtering)
- Product attribute `size_chart`
- Store config: enable/disable and link label
- Product-page modal styled with **Tailwind CSS 4 + daisyUI 5** (native `<dialog class="modal">`)
- Declarative schema (`sql/schema.php`)
- Maho admin routes via `#[Maho\Config\Route]`

## Install with Composer

From your Maho project root (the folder that contains `composer.json`, `maho`, `app/`, and `public/`):

```bash
composer require kalp707/maho-sizechart
php maho migrate
php maho cache:flush
```

Package type is `maho-module`. Maho loads code and templates from `vendor/`; the Composer plugin copies `skin/` to `public/skin/` automatically.

### Verify in admin

1. Log in to admin.
2. Open **Catalog → Size Charts**.
3. Create a chart (name + content).
4. Edit a product → set **Size Chart**.
5. **System → Configuration → Catalog → Size Chart** → Enabled / link label.
6. Open the product on the storefront and click **Size Guide**.

## Manual install (optional)

Use this only if you cannot use Composer.

### 1. Get the module files

Clone or download this repository, then open a terminal in your Maho project root.

### 2. Copy files into the Maho project

Maho serves the storefront from `public/`. PHP/XML go under `app/`; skin assets go under `public/skin/`.

**Windows (cmd):**

```bat
xcopy /E /I /Y path\to\maho-sizechart\app app
xcopy /E /I /Y path\to\maho-sizechart\skin public\skin
```

**Linux / macOS:**

```bash
cp -R path/to/maho-sizechart/app/. app/
cp -R path/to/maho-sizechart/skin/. public/skin/
```

### 3. Register autoload and finish setup

```bash
composer dump-autoload
php maho migrate
php maho cache:flush
```

## Rebuild frontend CSS (optional)

Only needed if you change `src/sizechart.css` or the sizechart templates and want a fresh Tailwind/daisyUI bundle:

```bash
php maho dev:frontend:theme:build --theme base/default
```

A prebuilt `css/sizechart.css` is already included for production (no Node.js required on the server).

## Usage

1. **Catalog → Size Charts** — create a chart  
2. **Catalog → Manage Products** — set **Size Chart**  
3. **System → Configuration → Catalog → Size Chart** — enable / label  
4. Open the product page and use the size guide link  

## Coding style

Follows Maho core conventions:

- SPDX file headers
- `declare(strict_types=1)`
- `#[\Override]` / `#[Maho\Config\Route]`
- `\Maho\Data\Form` for admin forms
- Declarative Doctrine DBAL schema
- Tailwind CSS 4 + daisyUI 5 page CSS via `maho dev:frontend:theme:build`

## License

[Open Software License 3.0 (OSL-3.0)](LICENSE)
