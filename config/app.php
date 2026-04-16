<?php
// config/app.php — Central configuration, must be included first

// ─────────────────────────────────────────────
// BASE URL DETECTION (works for Laragon & any subfolder)
// ─────────────────────────────────────────────
if (!defined('BASE_URL')) {
    // 1. Get absolute filesystem paths
    $project_root = str_replace('\\', '/', realpath(__DIR__ . '/..'));
    $current_script = str_replace('\\', '/', realpath($_SERVER['SCRIPT_FILENAME']));
    $script_name = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);

    // 2. Find the relative filesystem path of the script from the project root
    // Example: Project is at C:/app, Script is at C:/app/admin/index.php
    // Result: /admin/index.php
    $relative_path = str_replace($project_root, '', $current_script);

    // 3. Subtract that relative path from the web path (SCRIPT_NAME)
    // Example: SCRIPT_NAME is /my-app/admin/index.php
    // Result: /my-app
    $project_web_root = str_replace($relative_path, '', $script_name);
    $project_web_root = rtrim($project_web_root, '/') . '/';

    // 4. Build full URL
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    
    define('BASE_URL', $protocol . '://' . $host . $project_web_root);
}

// ─────────────────────────────────────────────
// VITE ASSETS HELPER
// ─────────────────────────────────────────────
/**
 * Outputs the correct <link> / <script> tags for Vite assets.
 * In dev mode  → points to Vite Dev Server (HMR).
 * In prod mode → reads the built manifest.json from /dist.
 */
function vite_assets(string $entry = 'src/main.js'): string
{
    static $is_dev = null;

    if ($is_dev === null) {
        // Try to reach the Vite dev server quickly
        $fp     = @fsockopen('127.0.0.1', 5173, $errno, $errstr, 0.1);
        $is_dev = (bool) $fp;
        if ($fp) fclose($fp);
    }

    if ($is_dev) {
        $dev = 'http://localhost:5173/';
        return <<<HTML
            <script type="module" src="{$dev}@vite/client"></script>
            <script type="module" src="{$dev}{$entry}"></script>
        HTML;
    }

    // Production — read manifest
    $manifest_path = __DIR__ . '/../dist/manifest.json';
    if (!file_exists($manifest_path)) {
        return '<!-- [Vite] dist/manifest.json missing. Run: npm run build -->';
    }

    $manifest = json_decode(file_get_contents($manifest_path), true);
    $chunk    = $manifest[$entry] ?? null;

    if (!$chunk) {
        return "<!-- [Vite] Entry '{$entry}' not found in manifest -->";
    }

    $base  = BASE_URL . 'dist/';
    $tags  = '';

    // CSS links
    foreach (($chunk['css'] ?? []) as $css_file) {
        $tags .= "<link rel=\"stylesheet\" href=\"{$base}{$css_file}\">\n    ";
    }

    // JS module
    if (!empty($chunk['file'])) {
        $tags .= "<script type=\"module\" src=\"{$base}{$chunk['file']}\"></script>\n    ";
    }

    return $tags;
}
