<?php
error_reporting(0);
require_once 'core/harviacode.php';
require_once 'core/helper.php';
require_once 'core/laravel/process_laravel.php';
?>
<!doctype html>
<html>

<head>
    <title>Harviacode Laravel CRUD Generator</title>
    <link rel="stylesheet" href="core/bootstrap.min.css" />
    <style>
        body {
            padding: 15px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(135deg, #ff2d20 0%, #ff6b5b 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }

        .btn-laravel {
            background: linear-gradient(135deg, #ff2d20 0%, #ff6b5b 100%);
            border: none;
            color: white;
        }

        .btn-laravel:hover {
            background: linear-gradient(135deg, #e0261b 0%, #e05a4d 100%);
            color: white;
        }

        .nav-tabs .nav-link.active {
            background: #ff2d20;
            color: white;
            border-color: #ff2d20;
        }

        .nav-tabs .nav-link {
            color: #ff2d20;
        }

        .result-item {
            padding: 8px 12px;
            margin: 5px 0;
            border-radius: 5px;
            background: #f8f9fa;
        }

        .result-success {
            border-left: 4px solid #28a745;
        }

        .result-error {
            border-left: 4px solid #dc3545;
        }

        .framework-switcher {
            margin-bottom: 20px;
        }

        .framework-switcher .btn {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <!-- Framework Switcher -->
        <div class="framework-switcher text-center">
            <a href="index.php" class="btn btn-outline-primary btn-lg">
                <strong>CodeIgniter</strong> Generator
            </a>
            <a href="laravel.php" class="btn btn-laravel btn-lg">
                <strong>Laravel</strong> Generator
            </a>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">🚀 Laravel CRUD Generator</h5>
                    </div>
                    <div class="card-body">
                        <form action="laravel.php" method="POST">
                            <div class="form-group mb-3">
                                <label><strong>Select Table</strong> - <a
                                        href="<?php echo $_SERVER['PHP_SELF'] ?>">Refresh</a></label>
                                <select id="table_name" name="table_name" class="form-control" onchange="setname()">
                                    <option value="">Please Select</option>
                                    <?php
                                    $table_list = $hc->table_list();
                                    $table_list_selected = isset($_POST['table_name']) ? $_POST['table_name'] : '';
                                    foreach ($table_list as $table) {
                                        ?>
                                        <option value="<?php echo $table['table_name'] ?>" <?php echo $table_list_selected == $table['table_name'] ? 'selected="selected"' : ''; ?>>
                                            <?php echo $table['table_name'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label><strong>Custom Model Name</strong></label>
                                <input type="text" id="laravel_model" name="laravel_model"
                                    value="<?php echo isset($_POST['laravel_model']) ? $_POST['laravel_model'] : '' ?>"
                                    class="form-control" placeholder="Leave empty for auto-generate" />
                                <small class="text-muted">Example: User, Product, Category</small>
                            </div>

                            <hr>
                            <h6><strong>Options</strong></h6>

                            <div class="form-group mb-2">
                                <div class="checkbox">
                                    <?php $generate_migration = isset($_POST['generate_migration']) ? $_POST['generate_migration'] : ''; ?>
                                    <label>
                                        <input type="checkbox" name="generate_migration" value="1" <?php echo $generate_migration == '1' ? 'checked' : '' ?>>
                                        Generate Migration
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mb-2">
                                <div class="checkbox">
                                    <?php $export_excel = isset($_POST['export_excel']) ? $_POST['export_excel'] : ''; ?>
                                    <label>
                                        <input type="checkbox" name="export_excel" value="1" <?php echo $export_excel == '1' ? 'checked' : '' ?>>
                                        Export Excel
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="checkbox">
                                    <?php $export_word = isset($_POST['export_word']) ? $_POST['export_word'] : ''; ?>
                                    <label>
                                        <input type="checkbox" name="export_word" value="1" <?php echo $export_word == '1' ? 'checked' : '' ?>>
                                        Export Word
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <input type="submit" value="🚀 Generate Laravel CRUD" name="generate_laravel"
                                    class="btn btn-laravel btn-lg"
                                    onclick="javascript: return confirm('This will overwrite existing files. Continue?')" />
                                <input type="submit" value="⚡ Generate All Tables" name="generate_laravel_all"
                                    class="btn btn-danger"
                                    onclick="javascript: return confirm('WARNING! This will generate CRUD for ALL TABLES. Continue?')" />
                            </div>
                        </form>

                        <hr>
                        <h6><strong>Generation Results:</strong></h6>
                        <?php
                        if (!empty($hasil_laravel)) {
                            foreach ($hasil_laravel as $h) {
                                if ($h) {
                                    $class = strpos($h, 'Error') !== false ? 'result-error' : 'result-success';
                                    echo '<div class="result-item ' . $class . '">' . $h . '</div>';
                                }
                            }
                        } else {
                            echo '<p class="text-muted">Select a table and click Generate to see results.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">📖 Laravel CRUD Generator Documentation</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle me-2"></i>
                            <strong>Project Laravel Ready!</strong> Files akan langsung di-generate ke folder
                            <code>output/laravel/</code> yang sudah terinstall Laravel.
                        </div>

                        <h4>About Laravel CRUD Generator</h4>
                        <p>
                            Tool ini meng-generate operasi CRUD (Create, Read, Update, Delete) lengkap untuk Laravel
                            framework.
                            Semua file langsung tersimpan di project Laravel yang sudah siap dijalankan.
                        </p>

                        <h5>Generated Files Location:</h5>
                        <table class="table table-bordered table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>Tipe File</th>
                                    <th>Lokasi di Project</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Model</strong></td>
                                    <td><code>output/laravel/app/Models/</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Controller</strong></td>
                                    <td><code>output/laravel/app/Http/Controllers/</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Form Request</strong></td>
                                    <td><code>output/laravel/app/Http/Requests/</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Blade Views</strong></td>
                                    <td><code>output/laravel/resources/views/[table_name]/</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Routes</strong></td>
                                    <td><code>output/laravel/routes/generated/</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Migration</strong></td>
                                    <td><code>output/laravel/database/migrations/</code></td>
                                </tr>
                            </tbody>
                        </table>

                        <h5>🚀 Cara Menjalankan Laravel:</h5>
                        <div class="bg-dark text-light p-3 rounded mb-3">
                            <code>
                                cd output/laravel<br>
                                php artisan serve
                            </code>
                        </div>
                        <p class="text-muted small">Kemudian buka <code>http://localhost:8000</code> di browser</p>

                        <h5>📌 Langkah Setelah Generate:</h5>
                        <ol>
                            <li>Konfigurasi database di <code>output/laravel/.env</code></li>
                            <li>Jalankan migration: <code>php artisan migrate</code></li>
                            <li>Tambahkan routes dari <code>routes/generated/</code> ke <code>routes/web.php</code></li>
                            <li>Jalankan server: <code>php artisan serve</code></li>
                        </ol>

                        <h5>Layout Template:</h5>
                        <p>Layout sudah tersedia di <code>resources/views/layouts/app.blade.php</code> dengan styling
                            Bootstrap 5 modern.</p>

                        <hr>
                        <p class="text-center">
                            <strong>&copy; 2024 <a target="_blank"
                                    href="http://harviacode.com">harviacode.com</a></strong><br>
                            <small>Laravel Generator Extension</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function capitalize(s) {
            return s && s[0].toUpperCase() + s.slice(1);
        }

        function tableToModel(table_name) {
            // Convert table_name to ModelName
            var words = table_name.split('_');
            var model = '';
            for (var i = 0; i < words.length; i++) {
                model += capitalize(words[i].toLowerCase());
            }
            // Simple singularization
            if (model.slice(-1) === 's') {
                model = model.slice(0, -1);
            }
            return model;
        }

        function setname() {
            var table_name = document.getElementById('table_name').value.toLowerCase();
            if (table_name != '') {
                document.getElementById('laravel_model').value = tableToModel(table_name);
            } else {
                document.getElementById('laravel_model').value = '';
            }
        }
    </script>
</body>

</html>