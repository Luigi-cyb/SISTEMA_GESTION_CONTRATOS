<?php
/**
 * Generador de Estructura de Proyecto Laravel
 * 
 * Uso: php generate-structure.php > project-structure.txt
 * 
 * Este script genera un árbol visual de toda la estructura
 * de carpetas y archivos del proyecto Laravel
 */

// Directorios a excluir
$excluded_dirs = [
    'node_modules',
    'vendor',
    '.git',
    'storage/logs',
    'storage/framework/cache',
    '.vscode',
    '__pycache__',
    '.pytest_cache',
];

// Extensiones de archivo a ignorar
$ignored_extensions = [
    '.lock',
];

// Colores ANSI (opcional, descomenta si lo necesitas)
// define('COLOR_DIR', "\033[1;34m");    // Azul para directorios
// define('COLOR_FILE', "\033[0;37m");   // Blanco para archivos
// define('COLOR_RESET', "\033[0m");

/**
 * Genera el árbol de directorios recursivamente
 */
function generateTree($path, $prefix = '', &$output = '', $is_last = true) {
    global $excluded_dirs, $ignored_extensions;
    
    // Verificar si la carpeta existe
    if (!is_dir($path)) {
        return;
    }
    
    // Obtener contenido del directorio
    try {
        $items = @scandir($path);
    } catch (Exception $e) {
        return;
    }
    
    if ($items === false) {
        return;
    }
    
    // Filtrar directorios y archivos
    $items = array_diff($items, ['.', '..']);
    
    // Excluir directorios especificados
    $items = array_filter($items, function($item) use ($path, $excluded_dirs) {
        $full_path = $path . DIRECTORY_SEPARATOR . $item;
        if (is_dir($full_path)) {
            foreach ($excluded_dirs as $excluded) {
                if (strpos($full_path, $excluded) !== false) {
                    return false;
                }
            }
        }
        return true;
    });
    
    // Ordenar: directorios primero, luego archivos
    usort($items, function($a, $b) use ($path) {
        $a_is_dir = is_dir($path . DIRECTORY_SEPARATOR . $a);
        $b_is_dir = is_dir($path . DIRECTORY_SEPARATOR . $b);
        
        if ($a_is_dir && !$b_is_dir) return -1;
        if (!$a_is_dir && $b_is_dir) return 1;
        return strcasecmp($a, $b);
    });
    
    $count = count($items);
    $index = 0;
    
    foreach ($items as $item) {
        $index++;
        $full_path = $path . DIRECTORY_SEPARATOR . $item;
        $is_last_item = ($index == $count);
        
        // Símbolo del árbol
        $connector = $is_last_item ? '└── ' : '├── ';
        $extension = $is_last_item ? '    ' : '│   ';
        
        // Verificar tipo (directorio o archivo)
        if (is_dir($full_path)) {
            // Es un directorio
            $output .= $prefix . $connector . '📂 ' . $item . "/" . "\n";
            
            // Recursión para subdirectorios
            $new_prefix = $prefix . $extension;
            generateTree($full_path, $new_prefix, $output, $is_last_item);
        } else {
            // Es un archivo
            $file_icon = getFileIcon($item);
            $output .= $prefix . $connector . $file_icon . ' ' . $item . "\n";
        }
    }
}

/**
 * Retorna un icono según la extensión del archivo
 */
function getFileIcon($filename) {
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    $icons = [
        'php' => '🐘',
        'js' => '⚙️',
        'css' => '🎨',
        'json' => '📋',
        'blade' => '⛓️',
        'env' => '🔐',
        'lock' => '🔒',
        'md' => '📄',
        'txt' => '📝',
        'yml' => '⚙️',
        'yaml' => '⚙️',
        'xml' => '📦',
        'sql' => '🗄️',
        'log' => '📋',
        'htaccess' => '⚙️',
        'gitignore' => '🚫',
    ];
    
    return $icons[$ext] ?? '📄';
}

/**
 * Obtiene información del proyecto
 */
function getProjectInfo() {
    $info = [];
    
    // Información general
    $info['Proyecto'] = 'Sistema de Gestión de Contratos EMICONSATH S.A.';
    $info['Ruta'] = getcwd();
    $info['Fecha de Generación'] = date('Y-m-d H:i:s');
    $info['PHP Version'] = phpversion();
    
    return $info;
}

/**
 * Cuenta archivos y carpetas
 */
function countItems($path, &$dir_count = 0, &$file_count = 0) {
    global $excluded_dirs;
    
    if (!is_dir($path)) {
        return;
    }
    
    try {
        $items = @scandir($path);
    } catch (Exception $e) {
        return;
    }
    
    if ($items === false) {
        return;
    }
    
    $items = array_diff($items, ['.', '..']);
    
    foreach ($items as $item) {
        $full_path = $path . DIRECTORY_SEPARATOR . $item;
        
        // Excluir directorios
        $should_skip = false;
        foreach ($excluded_dirs as $excluded) {
            if (strpos($full_path, $excluded) !== false) {
                $should_skip = true;
                break;
            }
        }
        
        if ($should_skip) {
            continue;
        }
        
        if (is_dir($full_path)) {
            $dir_count++;
            countItems($full_path, $dir_count, $file_count);
        } else {
            $file_count++;
        }
    }
}

// ========== EJECUCIÓN PRINCIPAL ==========

// Obtener información
$project_info = getProjectInfo();
$dir_count = 0;
$file_count = 0;
countItems(getcwd(), $dir_count, $file_count);

// Generar salida
$output = '';
$output .= "╔════════════════════════════════════════════════════════════╗\n";
$output .= "║   ESTRUCTURA DE PROYECTO LARAVEL - SISTEMA DE CONTRATOS   ║\n";
$output .= "╚════════════════════════════════════════════════════════════╝\n\n";

// Información general
$output .= "📊 INFORMACIÓN DEL PROYECTO\n";
$output .= "═══════════════════════════════════════════════════════════\n";
foreach ($project_info as $key => $value) {
    $output .= sprintf("%-20s: %s\n", $key, $value);
}
$output .= "\n";

// Estadísticas
$output .= "📈 ESTADÍSTICAS\n";
$output .= "═══════════════════════════════════════════════════════════\n";
$output .= sprintf("Directorios: %d\n", $dir_count);
$output .= sprintf("Archivos: %d\n", $file_count);
$output .= sprintf("Total de Items: %d\n", $dir_count + $file_count);
$output .= "\n";

// Directorios excluidos
$output .= "⏭️  DIRECTORIOS EXCLUIDOS DE LA ESTRUCTURA\n";
$output .= "═══════════════════════════════════════════════════════════\n";
foreach ($excluded_dirs as $dir) {
    $output .= "- $dir\n";
}
$output .= "\n";

// Árbol de estructura
$output .= "🌳 ESTRUCTURA DE CARPETAS Y ARCHIVOS\n";
$output .= "═══════════════════════════════════════════════════════════\n";
$output .= "sistema-contratos/\n";
generateTree(getcwd(), '', $output);

// Leyenda
$output .= "\n";
$output .= "📖 LEYENDA DE ICONOS\n";
$output .= "═══════════════════════════════════════════════════════════\n";
$output .= "📂 = Directorio\n";
$output .= "🐘 = Archivo PHP\n";
$output .= "⚙️  = Archivo de Configuración\n";
$output .= "🎨 = Archivo CSS\n";
$output .= "⛓️  = Archivo Blade (vistas)\n";
$output .= "📋 = Archivo JSON\n";
$output .= "🔐 = Archivo .env (secretos)\n";
$output .= "📄 = Archivo general\n";
$output .= "🗄️  = Base de datos\n";
$output .= "\n";

// Pie de página
$output .= "═══════════════════════════════════════════════════════════\n";
$output .= "Generado automáticamente por generate-structure.php\n";
$output .= "═══════════════════════════════════════════════════════════\n";

// Imprimir salida
echo $output;

// Si se desea guardar en archivo, descomenta la siguiente línea:
// file_put_contents('project-structure.txt', $output);
// echo "\n✅ Estructura guardada en: project-structure.txt\n";
?>