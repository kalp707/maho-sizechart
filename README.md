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

## Upload / install on Maho Commerce

### 1. Get the module files

Clone or download this repository, then open a terminal in your Maho project root (the folder that contains `composer.json`, `maho`, `app/`, and `public/`).

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

You should end up with at least:

| Path | Purpose |
|------|---------|
| `app/etc/modules/Maho_SizeChart.xml` | Module registration (`local` code pool) |
| `app/code/local/Maho/SizeChart/` | Module PHP, config, schema |
| `app/design/.../maho/sizechart/` | Templates + layout |
| `public/skin/.../css/sizechart.css` | Built Tailwind/daisyUI CSS |
| `public/skin/.../maho/sizechart/sizechart.js` | Frontend modal JS |

### 3. Register autoload and PHP attributes

Required so Maho can load `Maho_SizeChart_*` classes and compile `#[Maho\Config\Route]` admin routes:

```bash
composer dump-autoload
```

### 4. Run database migrate

Creates the `sizechart_chart` table and the product attribute `size_chart`:

```bash
php maho migrate
```

### 5. Flush cache

```bash
php maho cache:flush
```

Optional: in admin, **System → Cache Management → Flush Magento Cache**, or click **Recompile PHP Attributes** if routes do not appear after step 3.

### 6. Verify in admin

1. Log in to admin.
2. Open **Catalog → Size Charts**.
3. Create a chart (name + content).
4. Edit a product → set **Size Chart**.
5. **System → Configuration → Catalog → Size Chart** → Enabled / link label.
6. Open the product on the storefront and click **Size Guide**.

---

### Optional: rebuild frontend CSS

Only needed if you change `src/sizechart.css` or the sizechart templates and want a fresh Tailwind/daisyUI bundle:

```bash
php maho dev:frontend:theme:build --theme base/default
```

A prebuilt `css/sizechart.css` is already included for production (no Node.js required on the server).

### Composer package (optional)

If you publish this repo as a Composer package with the `extra.map` paths in `composer.json`, require it in the Maho project and let the Maho composer plugin place files, then run steps 3–5.

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

[GPL-3.0-or-later](LICENSE)
