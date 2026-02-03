<?php

/**
 * CodeIgniter View Read Generator - DaisyUI/FlyonUI Style
 * Generates modern read/detail view with Tailwind CSS + daisyUI
 */

$string = "<!doctype html>
<html lang=\"id\" data-theme=\"light\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Detail " . ucfirst($table_name) . " - <?php echo \$this->config->item('app_name') ?? 'App'; ?></title>
    
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
        <div class=\"max-w-2xl mx-auto space-y-6\">
            <!-- Page Header -->
            <div class=\"flex items-center gap-4\">
                <a href=\"<?php echo site_url('" . $c_url . "'); ?>\" class=\"btn btn-ghost btn-circle\">
                    <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-6 w-6\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                        <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10 19l-7-7m0 0l7-7m-7 7h18\" />
                    </svg>
                </a>
                <div>
                    <h1 class=\"text-2xl font-bold text-base-content\">Detail " . ucfirst($table_name) . "</h1>
                    <p class=\"text-base-content/60\">Informasi lengkap data " . ucfirst($table_name) . "</p>
                </div>
            </div>

            <!-- Detail Card -->
            <div class=\"card bg-base-100 shadow-lg\">
                <div class=\"card-body\">
                    <div class=\"overflow-x-auto\">
                        <table class=\"table\">";

foreach ($non_pk as $row) {
    $label = label($row["column_name"]);
    $col_name = $row["column_name"];
    $string .= "
                            <tr>
                                <th class=\"w-1/3 bg-base-200\">" . $label . "</th>
                                <td><?php echo \$" . $col_name . "; ?></td>
                            </tr>";
}

$string .= "
                        </table>
                    </div>

                    <div class=\"divider\"></div>

                    <div class=\"flex justify-between items-center\">
                        <a href=\"<?php echo site_url('" . $c_url . "'); ?>\" class=\"btn btn-ghost\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10 19l-7-7m0 0l7-7m-7 7h18\" />
                            </svg>
                            Kembali
                        </a>
                        <div class=\"flex gap-2\">
                            <a href=\"<?php echo site_url('" . $c_url . "/update/'.\$" . $pk . "); ?>\" class=\"btn btn-warning\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z\" />
                                </svg>
                                Edit
                            </a>
                            <a href=\"<?php echo site_url('" . $c_url . "/delete/'.\$" . $pk . "); ?>\" 
                               onclick=\"return confirm('Yakin ingin menghapus data ini?')\"
                               class=\"btn btn-error\">
                                <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"h-5 w-5\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\">
                                    <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16\" />
                                </svg>
                                Hapus
                            </a>
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



$hasil_view_read = createFile($string, $target . "views/" . $c_url . "/" . $v_read_file);

?>