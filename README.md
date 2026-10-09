# Maho Size Chart

Size chart module **for [Maho Commerce](https://mahocommerce.com) only**.

Manage reusable size guides in admin, assign them to products, and show a size-guide link with a modal on the product page.

## Requirements

- Maho Commerce (PHP 8.2+)
- Not supported on Magento 1 / OpenMage

## Features

- Admin CRUD for size charts (WYSIWYG content)
- Product attribute `size_chart`
- Store config: enable/disable and link label
- Product-page modal styled with **Tailwind CSS 4 + daisyUI 5** (native `<dialog class="modal">`)
- Declarative schema (`sql/schema.php`)
- Maho admin routes via `#[Maho\Config\Route]`

## Installation

Copy `app/` into the Maho project root, and `skin/` into `public/skin/` (Maho serves frontend assets from `public/`):

```bat
xcopy /E /I /Y app C:\path\to\your-maho\app
xcopy /E /I /Y skin C:\path\to\your-maho\public\skin
```

Then regenerate Maho’s Composer autoload (required for local modules), migrate, and flush cache:

```bash
composer dump-autoload
php maho migrate
php maho cache:flush
```

### Frontend styles (Tailwind / daisyUI)

Storefront UI uses Maho’s theme toolchain. A page bundle ships prebuilt as `css/sizechart.css`. Source is `src/sizechart.css`.

Rebuild after template/CSS changes:

```bash
php maho dev:frontend:theme:build --theme base/default
```

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

## License

[GPL-3.0-or-later](LICENSE)
