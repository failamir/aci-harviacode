<?php

/**
 * Laravel Process Handler
 * Processes Laravel CRUD generation
 */

// Convert table name to Model name (singular, PascalCase)
function tableToModelName($table_name)
{
    $words = explode('_', $table_name);
    $model_name = '';
    foreach ($words as $word) {
        $model_name .= ucfirst(strtolower($word));
    }
    // Simple singularization
    if (substr($model_name, -1) === 's') {
        $model_name = rtrim($model_name, 's');
    }
    return $model_name;
}

$hasil_laravel = array();

// Laravel project base path
$laravel_base = 'output/laravel/';

if (isset($_POST['generate_laravel'])) {
    // get form data
    $table_name = safe($_POST['table_name']);
    $export_excel = safe($_POST['export_excel']);
    $export_word = safe($_POST['export_word']);
    $custom_model = safe($_POST['laravel_model']);
    $generate_migration = isset($_POST['generate_migration']) ? $_POST['generate_migration'] : '';

    if ($table_name <> '') {
        // Set Laravel target paths (proper Laravel structure)
        $target_controller = $laravel_base . 'app/Http/Controllers/';
        $target_model = $laravel_base . 'app/Models/';
        $target_request = $laravel_base . 'app/Http/Requests/';
        $target_view = $laravel_base . 'resources/views/';
        $target_migration = $laravel_base . 'database/migrations/';
        $target_routes = $laravel_base . 'routes/';

        // Create folders if not exist
        $folders = [
            $target_controller,
            $target_model,
            $target_request,
            $target_view,
            $target_migration,
            $target_routes . 'generated/'
        ];
        foreach ($folders as $folder) {
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
        }

        $pk = $hc->primary_field($table_name);
        $non_pk = $hc->not_primary_field($table_name);
        $all = $hc->all_field($table_name);

        // Set target for each generator
        $target = $target_model;
        include 'core/laravel/create_laravel_model.php';

        $target = $target_controller;
        include 'core/laravel/create_laravel_controller.php';

        $target = $target_request;
        include 'core/laravel/create_laravel_request.php';

        $target = $target_view;
        include 'core/laravel/create_laravel_views.php';

        $target = $target_routes . 'generated/';
        include 'core/laravel/create_laravel_routes.php';

        if ($generate_migration == '1') {
            $target = $target_migration;
            include 'core/laravel/create_laravel_migration.php';
        }

        $hasil_laravel[] = $hasil_laravel_model;
        $hasil_laravel[] = $hasil_laravel_controller;
        $hasil_laravel[] = $hasil_laravel_request;
        $hasil_laravel[] = $hasil_laravel_view_index;
        $hasil_laravel[] = $hasil_laravel_view_create;
        $hasil_laravel[] = $hasil_laravel_view_edit;
        $hasil_laravel[] = $hasil_laravel_view_show;
        $hasil_laravel[] = $hasil_laravel_routes;
        if ($generate_migration == '1') {
            $hasil_laravel[] = $hasil_laravel_migration;
        }
    } else {
        $hasil_laravel[] = 'No table selected.';
    }
}

if (isset($_POST['generate_laravel_all'])) {
    $export_excel = safe($_POST['export_excel']);
    $export_word = safe($_POST['export_word']);
    $generate_migration = isset($_POST['generate_migration']) ? $_POST['generate_migration'] : '';

    // Set Laravel target paths (proper Laravel structure)
    $target_controller = $laravel_base . 'app/Http/Controllers/';
    $target_model = $laravel_base . 'app/Models/';
    $target_request = $laravel_base . 'app/Http/Requests/';
    $target_view = $laravel_base . 'resources/views/';
    $target_migration = $laravel_base . 'database/migrations/';
    $target_routes = $laravel_base . 'routes/';

    // Create folders if not exist
    $folders = [
        $target_controller,
        $target_model,
        $target_request,
        $target_view,
        $target_migration,
        $target_routes . 'generated/'
    ];
    foreach ($folders as $folder) {
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
    }

    $table_list = $hc->table_list();
    foreach ($table_list as $row) {
        $table_name = $row['table_name'];
        $custom_model = ''; // Use auto-generated name

        $pk = $hc->primary_field($table_name);
        $non_pk = $hc->not_primary_field($table_name);
        $all = $hc->all_field($table_name);

        // Set target for each generator
        $target = $target_model;
        include 'core/laravel/create_laravel_model.php';

        $target = $target_controller;
        include 'core/laravel/create_laravel_controller.php';

        $target = $target_request;
        include 'core/laravel/create_laravel_request.php';

        $target = $target_view;
        include 'core/laravel/create_laravel_views.php';

        $target = $target_routes . 'generated/';
        include 'core/laravel/create_laravel_routes.php';

        if ($generate_migration == '1') {
            $target = $target_migration;
            include 'core/laravel/create_laravel_migration.php';
        }

        $hasil_laravel[] = $hasil_laravel_model;
        $hasil_laravel[] = $hasil_laravel_controller;
        $hasil_laravel[] = $hasil_laravel_view_index;
    }
}

?>