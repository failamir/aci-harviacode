<?php

/**
 * CodeIgniter View List Generator - DaisyUI/FlyonUI Style
 * Generates modern list view with Tailwind CSS + daisyUI
 */

$string = "<!doctype html>
<html lang=\"id\" data-theme=\"light\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>" . ucfirst($table_name) . " - <?php echo \$this->config->item('app_name') ?? 'App'; ?></title>
    
    <!-- Tailwind CSS + daisyUI -->
    <script src=\"https://cdn.tailwindcss.com\"></script>
    <link href=\"https://cdn.jsdelivr.net/npm/daisyui@4.12.2/dist/full.min.css\" rel=\"stylesheet\" type=\"text/css\" />
    
    <!-- Google Fonts -->
    <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
    <link href=\"https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap\" rel=\"stylesheet\">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class=\"bg-base-200 min-h-screen\">
    <!-- Navbar -->
    <div class=\"navbar bg-base-100 shadow-lg sticky top-0 z-50\">
        <div class=\"flex-1\">
            <a class=\"btn btn-ghost text-xl font-bold\" href=\"<?php echo site_url('/'); ?>\">
                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-6 w-6 text-primary\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4\" />
                </svg>
                <?php echo \$this->config->item('app_name') ?? 'CodeIgniter App'; ?>
            </a>
        </div>
        <div class=\"flex-none gap-2\">
            <label class=\"swap swap-rotate btn btn-ghost btn-circle\">
                <input type=\"checkbox\" class=\"theme-controller\" value=\"dark\" />
                <svg class=\"swap-off fill-current w-5 h-5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path d=\"M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z\"/></svg>
                <svg class=\"swap-on fill-current w-5 h-5\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\"><path d=\"M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z\"/></svg>
            </label>
        </div>
    </div>

    <!-- Main Content -->
    <main class=\"container mx-auto px-4 py-6\">
        <div class=\"space-y-6\">
            <!-- Page Header -->
            <div class=\"flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4\">
                <div>
                    <h1 class=\"text-2xl font-bold text-base-content\">" . ucfirst($table_name) . "</h1>
                    <p class=\"text-base-content/60\">Kelola data " . ucfirst($table_name) . "</p>
                </div>
                <a href=\"<?php echo site_url('" . $c_url . "/create'); ?>\" class=\"btn btn-primary\">
                    <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                        <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M12 4v16m8-8H4\" />
                    </svg>
                    Tambah Data
                </a>
            </div>

            <!-- Alert Messages -->
            <?php if (\$this->session->userdata('message') != ''): ?>
                <div class=\"alert alert-success\">
                    <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"stroke-current shrink-0 h-6 w-6\" fill=\"none\" viewBox=\"0 0 24 24\"><path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z\" /></svg>
                    <span><?php echo \$this->session->userdata('message'); ?></span>
                </div>
            <?php endif; ?>

            <!-- Main Card -->
            <div class=\"card bg-base-100 shadow-lg\">
                <div class=\"card-body\">
                    <!-- Search & Export -->
                    <div class=\"flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6\">
                        <form action=\"<?php echo site_url('$c_url/index'); ?>\" method=\"get\" class=\"join\">
                            <input type=\"text\" name=\"q\" class=\"input input-bordered join-item w-full md:w-80\" 
                                   placeholder=\"Cari data...\" value=\"<?php echo \$q; ?>\">
                            <button class=\"btn btn-primary join-item\" type=\"submit\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z\" />
                                </svg>
                            </button>
                            <?php if (\$q <> ''): ?>
                                <a href=\"<?php echo site_url('$c_url'); ?>\" class=\"btn btn-ghost join-item\">
                                    <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                        <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M6 18L18 6M6 6l12 12\" />
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </form>
                        <div class=\"flex gap-2\">";

if ($export_excel == '1') {
    $string .= "
                            <a href=\"<?php echo site_url('" . $c_url . "/excel'); ?>\" class=\"btn btn-success btn-sm\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-4 w-4\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z\" />
                                </svg> Excel
                            </a>";
}

if ($export_word == '1') {
    $string .= "
                            <a href=\"<?php echo site_url('" . $c_url . "/word'); ?>\" class=\"btn btn-info btn-sm\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-4 w-4\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z\" />
                                </svg> Word
                            </a>";
}

if ($export_pdf == '1') {
    $string .= "
                            <a href=\"<?php echo site_url('" . $c_url . "/pdf'); ?>\" class=\"btn btn-error btn-sm\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-4 w-4\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z\" />
                                </svg> PDF
                            </a>";
}

$string .= "
                        </div>
                    </div>

                    <!-- Table -->
                    <div class=\"overflow-x-auto\">
                        <table class=\"table table-zebra\">
                            <thead>
                                <tr class=\"bg-base-200\">
                                    <th class=\"w-16\">No</th>";

foreach ($non_pk as $row) {
    $string .= "\n                                    <th>" . label($row['column_name']) . "</th>";
}

$string .= "
                                    <th class=\"w-48 text-center\">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (\$" . $c_url . "_data as \$" . $c_url . "): ?>
                                <tr class=\"hover\">
                                    <td><?php echo ++\$start; ?></td>";

foreach ($non_pk as $row) {
    $string .= "\n                                    <td><?php echo \$" . $c_url . "->" . $row['column_name'] . "; ?></td>";
}

$string .= "
                                    <td class=\"text-center\">
                                        <div class=\"flex items-center justify-center gap-1\">
                                            <a href=\"<?php echo site_url('" . $c_url . "/read/'.\$" . $c_url . "->" . $pk . "); ?>\" 
                                               class=\"btn btn-ghost btn-sm btn-circle\" title=\"Lihat\">
                                                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5 text-info\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M15 12a3 3 0 11-6 0 3 3 0 016 0z\" />
                                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z\" />
                                                </svg>
                                            </a>
                                            <a href=\"<?php echo site_url('" . $c_url . "/update/'.\$" . $c_url . "->" . $pk . "); ?>\" 
                                               class=\"btn btn-ghost btn-sm btn-circle\" title=\"Edit\">
                                                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5 text-warning\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z\" />
                                                </svg>
                                            </a>
                                            <a href=\"<?php echo site_url('" . $c_url . "/delete/'.\$" . $c_url . "->" . $pk . "); ?>\" 
                                               onclick=\"return confirm('Yakin ingin menghapus data ini?')\"
                                               class=\"btn btn-ghost btn-sm btn-circle\" title=\"Hapus\">
                                                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5 text-error\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16\" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty(\$" . $c_url . "_data)): ?>
                                <tr>
                                    <td colspan=\"" . (count($non_pk) + 2) . "\" class=\"text-center py-12\">
                                        <div class=\"flex flex-col items-center gap-2 text-base-content/50\">
                                            <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-16 w-16\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4\" />
                                            </svg>
                                            <span>Tidak ada data yang ditemukan</span>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class=\"flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-6\">
                        <div class=\"badge badge-primary badge-lg\">
                            Total: <?php echo \$total_rows; ?> data
                        </div>
                        <div class=\"join\">
                            <?php echo \$pagination; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class=\"footer footer-center p-4 bg-base-100 text-base-content border-t mt-auto\">
        <aside>
            <p>&copy; <?php echo date('Y'); ?> - Generated by <a href=\"http://harviacode.com\" target=\"_blank\" class=\"link link-primary\">Harviacode CRUD Generator</a></p>
        </aside>
    </footer>
</body>
</html>";


$hasil_view_list = createFile($string, $target . "views/" . $c_url . "/" . $v_list_file);

?>