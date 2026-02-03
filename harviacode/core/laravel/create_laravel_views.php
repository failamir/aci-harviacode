<?php

/**
 * Laravel Blade Views Generator
 * Generates CRUD Views for Laravel with FlyonUI
 */

$model_name = isset($custom_model) && $custom_model != '' ? $custom_model : tableToModelName($table_name);
$view_folder = strtolower($table_name);
$route_name = strtolower($table_name);
$title = ucwords(str_replace('_', ' ', $table_name));

// Create view folder
if (!file_exists($target . $view_folder)) {
    mkdir($target . $view_folder, 0777, true);
}

// ============================================
// INDEX VIEW - FlyonUI
// ============================================
$string_index = "@extends('layouts.app')

@section('title', '$title')

@section('content')
<div class=\"space-y-6\">
    <!-- Page Header -->
    <div class=\"flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4\">
        <div>
            <h1 class=\"text-2xl font-bold text-base-content\">$title</h1>
            <p class=\"text-base-content/60\">Kelola data $title</p>
        </div>
        <a href=\"{{ route('$route_name.create') }}\" class=\"btn btn-primary\">
            <span class=\"icon-[tabler--plus] size-5\"></span>
            Tambah Data
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class=\"alert alert-success\">
            <span class=\"icon-[tabler--check] size-5\"></span>
            <span>{{ session('success') }}</span>
            <button class=\"btn btn-ghost btn-sm btn-circle ms-auto\" onclick=\"this.parentElement.remove()\">
                <span class=\"icon-[tabler--x] size-4\"></span>
            </button>
        </div>
    @endif

    <!-- Main Card -->
    <div class=\"card bg-base-100 shadow-lg\">
        <div class=\"card-body\">
            <!-- Search & Export -->
            <div class=\"flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6\">
                <form action=\"{{ route('$route_name.index') }}\" method=\"GET\" class=\"join\">
                    <input type=\"text\" name=\"search\" class=\"input input-bordered join-item w-full md:w-80\" 
                           placeholder=\"Cari data...\" value=\"{{ request('search') }}\">
                    <button class=\"btn btn-primary join-item\" type=\"submit\">
                        <span class=\"icon-[tabler--search] size-5\"></span>
                    </button>
                    @if(request('search'))
                        <a href=\"{{ route('$route_name.index') }}\" class=\"btn btn-ghost join-item\">
                            <span class=\"icon-[tabler--x] size-5\"></span>
                        </a>
                    @endif
                </form>
                <div class=\"flex gap-2\">";

if ($export_excel == '1') {
    $string_index .= "
                    <a href=\"{{ route('$route_name.export.excel') }}\" class=\"btn btn-success btn-sm\">
                        <span class=\"icon-[tabler--file-spreadsheet] size-4\"></span> Excel
                    </a>";
}

if ($export_word == '1') {
    $string_index .= "
                    <a href=\"{{ route('$route_name.export.word') }}\" class=\"btn btn-info btn-sm\">
                        <span class=\"icon-[tabler--file-text] size-4\"></span> Word
                    </a>";
}

$string_index .= "
                </div>
            </div>

            <!-- Table -->
            <div class=\"overflow-x-auto\">
                <table class=\"table table-zebra\">
                    <thead>
                        <tr class=\"bg-base-200\">
                            <th class=\"w-16\">No</th>";

foreach ($non_pk as $row) {
    $label = label($row['column_name']);
    $string_index .= "\n                            <th>$label</th>";
}

$string_index .= "
                            <th class=\"w-48 text-center\">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\$data as \$index => \$item)
                        <tr class=\"hover\">
                            <td>{{ \$data->firstItem() + \$index }}</td>";

foreach ($non_pk as $row) {
    $string_index .= "\n                            <td>{{ \$item->" . $row['column_name'] . " }}</td>";
}

$string_index .= "
                            <td class=\"text-center\">
                                <div class=\"flex items-center justify-center gap-1\">
                                    <a href=\"{{ route('$route_name.show', \$item->$pk) }}\" 
                                       class=\"btn btn-ghost btn-sm btn-circle\" title=\"Lihat\">
                                        <span class=\"icon-[tabler--eye] size-5 text-info\"></span>
                                    </a>
                                    <a href=\"{{ route('$route_name.edit', \$item->$pk) }}\" 
                                       class=\"btn btn-ghost btn-sm btn-circle\" title=\"Edit\">
                                        <span class=\"icon-[tabler--edit] size-5 text-warning\"></span>
                                    </a>
                                    <form action=\"{{ route('$route_name.destroy', \$item->$pk) }}\" 
                                          method=\"POST\" class=\"inline\"
                                          onsubmit=\"return confirm('Yakin ingin menghapus data ini?')\">
                                        @csrf
                                        @method('DELETE')
                                        <button type=\"submit\" class=\"btn btn-ghost btn-sm btn-circle\" title=\"Hapus\">
                                            <span class=\"icon-[tabler--trash] size-5 text-error\"></span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan=\"" . (count($non_pk) + 2) . "\" class=\"text-center py-12\">
                                <div class=\"flex flex-col items-center gap-2 text-base-content/50\">
                                    <span class=\"icon-[tabler--inbox] size-16\"></span>
                                    <span>Tidak ada data yang ditemukan</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class=\"flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-6\">
                <div class=\"text-sm text-base-content/60\">
                    Menampilkan {{ \$data->firstItem() ?? 0 }} - {{ \$data->lastItem() ?? 0 }} 
                    dari {{ \$data->total() }} data
                </div>
                <div class=\"join\">
                    {{ \$data->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
";

// ============================================
// CREATE VIEW - FlyonUI
// ============================================
$string_create = "@extends('layouts.app')

@section('title', 'Tambah $title')

@section('content')
<div class=\"max-w-2xl mx-auto space-y-6\">
    <!-- Page Header -->
    <div class=\"flex items-center gap-4\">
        <a href=\"{{ route('$route_name.index') }}\" class=\"btn btn-ghost btn-circle\">
            <span class=\"icon-[tabler--arrow-left] size-6\"></span>
        </a>
        <div>
            <h1 class=\"text-2xl font-bold text-base-content\">Tambah $title</h1>
            <p class=\"text-base-content/60\">Isi form berikut untuk menambah data baru</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class=\"card bg-base-100 shadow-lg\">
        <div class=\"card-body\">
            <form action=\"{{ route('$route_name.store') }}\" method=\"POST\">
                @csrf
";

foreach ($non_pk as $row) {
    $label = label($row['column_name']);
    $type = strtolower($row['data_type']);
    $col_name = $row['column_name'];

    $string_create .= "
                <div class=\"form-control w-full mb-4\">
                    <label class=\"label\" for=\"$col_name\">
                        <span class=\"label-text font-medium\">$label</span>
                    </label>";

    if ($type === 'text' || $type === 'mediumtext' || $type === 'longtext') {
        $string_create .= "
                    <textarea name=\"$col_name\" id=\"$col_name\" rows=\"4\"
                              class=\"textarea textarea-bordered w-full @error('$col_name') textarea-error @enderror\">{{ old('$col_name') }}</textarea>";
    } elseif ($type === 'date') {
        $string_create .= "
                    <input type=\"date\" name=\"$col_name\" id=\"$col_name\"
                           class=\"input input-bordered w-full @error('$col_name') input-error @enderror\"
                           value=\"{{ old('$col_name') }}\">";
    } elseif ($type === 'datetime' || $type === 'timestamp') {
        $string_create .= "
                    <input type=\"datetime-local\" name=\"$col_name\" id=\"$col_name\"
                           class=\"input input-bordered w-full @error('$col_name') input-error @enderror\"
                           value=\"{{ old('$col_name') }}\">";
    } elseif ($type === 'time') {
        $string_create .= "
                    <input type=\"time\" name=\"$col_name\" id=\"$col_name\"
                           class=\"input input-bordered w-full @error('$col_name') input-error @enderror\"
                           value=\"{{ old('$col_name') }}\">";
    } elseif (in_array($type, ['int', 'integer', 'bigint', 'smallint', 'tinyint', 'decimal', 'float', 'double'])) {
        $string_create .= "
                    <input type=\"number\" name=\"$col_name\" id=\"$col_name\" step=\"any\"
                           class=\"input input-bordered w-full @error('$col_name') input-error @enderror\"
                           value=\"{{ old('$col_name') }}\">";
    } elseif (stripos($col_name, 'email') !== false) {
        $string_create .= "
                    <input type=\"email\" name=\"$col_name\" id=\"$col_name\"
                           class=\"input input-bordered w-full @error('$col_name') input-error @enderror\"
                           value=\"{{ old('$col_name') }}\">";
    } elseif (stripos($col_name, 'password') !== false) {
        $string_create .= "
                    <input type=\"password\" name=\"$col_name\" id=\"$col_name\"
                           class=\"input input-bordered w-full @error('$col_name') input-error @enderror\">";
    } else {
        $string_create .= "
                    <input type=\"text\" name=\"$col_name\" id=\"$col_name\"
                           class=\"input input-bordered w-full @error('$col_name') input-error @enderror\"
                           value=\"{{ old('$col_name') }}\">";
    }

    $string_create .= "
                    @error('$col_name')
                        <label class=\"label\">
                            <span class=\"label-text-alt text-error\">{{ \$message }}</span>
                        </label>
                    @enderror
                </div>";
}

$string_create .= "

                <div class=\"divider\"></div>

                <div class=\"flex justify-end gap-3\">
                    <a href=\"{{ route('$route_name.index') }}\" class=\"btn btn-ghost\">
                        <span class=\"icon-[tabler--x] size-5\"></span> Batal
                    </a>
                    <button type=\"submit\" class=\"btn btn-primary\">
                        <span class=\"icon-[tabler--device-floppy] size-5\"></span> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
";

// ============================================
// EDIT VIEW - FlyonUI
// ============================================
$string_edit = "@extends('layouts.app')

@section('title', 'Edit $title')

@section('content')
<div class=\"max-w-2xl mx-auto space-y-6\">
    <!-- Page Header -->
    <div class=\"flex items-center gap-4\">
        <a href=\"{{ route('$route_name.index') }}\" class=\"btn btn-ghost btn-circle\">
            <span class=\"icon-[tabler--arrow-left] size-6\"></span>
        </a>
        <div>
            <h1 class=\"text-2xl font-bold text-base-content\">Edit $title</h1>
            <p class=\"text-base-content/60\">Perbarui data $title yang dipilih</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class=\"card bg-base-100 shadow-lg\">
        <div class=\"card-body\">
            <form action=\"{{ route('$route_name.update', \$item->$pk) }}\" method=\"POST\">
                @csrf
                @method('PUT')
";

foreach ($non_pk as $row) {
    $label = label($row['column_name']);
    $type = strtolower($row['data_type']);
    $col_name = $row['column_name'];

    $string_edit .= "
                <div class=\"form-control w-full mb-4\">
                    <label class=\"label\" for=\"$col_name\">
                        <span class=\"label-text font-medium\">$label</span>
                    </label>";

    if ($type === 'text' || $type === 'mediumtext' || $type === 'longtext') {
        $string_edit .= "
                    <textarea name=\"$col_name\" id=\"$col_name\" rows=\"4\"
                              class=\"textarea textarea-bordered w-full @error('$col_name') textarea-error @enderror\">{{ old('$col_name', \$item->$col_name) }}</textarea>";
    } elseif ($type === 'date') {
        $string_edit .= "
                    <input type=\"date\" name=\"$col_name\" id=\"$col_name\"
                           class=\"input input-bordered w-full @error('$col_name') input-error @enderror\"
                           value=\"{{ old('$col_name', \$item->$col_name) }}\">";
    } elseif ($type === 'datetime' || $type === 'timestamp') {
        $string_edit .= "
                    <input type=\"datetime-local\" name=\"$col_name\" id=\"$col_name\"
                           class=\"input input-bordered w-full @error('$col_name') input-error @enderror\"
                           value=\"{{ old('$col_name', \$item->$col_name ? date('Y-m-d\\TH:i', strtotime(\$item->$col_name)) : '') }}\">";
    } elseif ($type === 'time') {
        $string_edit .= "
                    <input type=\"time\" name=\"$col_name\" id=\"$col_name\"
                           class=\"input input-bordered w-full @error('$col_name') input-error @enderror\"
                           value=\"{{ old('$col_name', \$item->$col_name) }}\">";
    } elseif (in_array($type, ['int', 'integer', 'bigint', 'smallint', 'tinyint', 'decimal', 'float', 'double'])) {
        $string_edit .= "
                    <input type=\"number\" name=\"$col_name\" id=\"$col_name\" step=\"any\"
                           class=\"input input-bordered w-full @error('$col_name') input-error @enderror\"
                           value=\"{{ old('$col_name', \$item->$col_name) }}\">";
    } elseif (stripos($col_name, 'email') !== false) {
        $string_edit .= "
                    <input type=\"email\" name=\"$col_name\" id=\"$col_name\"
                           class=\"input input-bordered w-full @error('$col_name') input-error @enderror\"
                           value=\"{{ old('$col_name', \$item->$col_name) }}\">";
    } elseif (stripos($col_name, 'password') !== false) {
        $string_edit .= "
                    <input type=\"password\" name=\"$col_name\" id=\"$col_name\"
                           class=\"input input-bordered w-full @error('$col_name') input-error @enderror\"
                           placeholder=\"Kosongkan jika tidak ingin mengubah\">";
    } else {
        $string_edit .= "
                    <input type=\"text\" name=\"$col_name\" id=\"$col_name\"
                           class=\"input input-bordered w-full @error('$col_name') input-error @enderror\"
                           value=\"{{ old('$col_name', \$item->$col_name) }}\">";
    }

    $string_edit .= "
                    @error('$col_name')
                        <label class=\"label\">
                            <span class=\"label-text-alt text-error\">{{ \$message }}</span>
                        </label>
                    @enderror
                </div>";
}

$string_edit .= "

                <div class=\"divider\"></div>

                <div class=\"flex justify-end gap-3\">
                    <a href=\"{{ route('$route_name.index') }}\" class=\"btn btn-ghost\">
                        <span class=\"icon-[tabler--x] size-5\"></span> Batal
                    </a>
                    <button type=\"submit\" class=\"btn btn-warning\">
                        <span class=\"icon-[tabler--device-floppy] size-5\"></span> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
";

// ============================================
// SHOW VIEW - FlyonUI
// ============================================
$string_show = "@extends('layouts.app')

@section('title', 'Detail $title')

@section('content')
<div class=\"max-w-2xl mx-auto space-y-6\">
    <!-- Page Header -->
    <div class=\"flex items-center gap-4\">
        <a href=\"{{ route('$route_name.index') }}\" class=\"btn btn-ghost btn-circle\">
            <span class=\"icon-[tabler--arrow-left] size-6\"></span>
        </a>
        <div>
            <h1 class=\"text-2xl font-bold text-base-content\">Detail $title</h1>
            <p class=\"text-base-content/60\">Informasi lengkap data $title</p>
        </div>
    </div>

    <!-- Detail Card -->
    <div class=\"card bg-base-100 shadow-lg\">
        <div class=\"card-body\">
            <div class=\"overflow-x-auto\">
                <table class=\"table\">
                    <tbody>";

foreach ($all as $row) {
    $label = label($row['column_name']);
    $col_name = $row['column_name'];
    $string_show .= "
                        <tr>
                            <th class=\"w-1/3 bg-base-200\">$label</th>
                            <td>{{ \$item->$col_name }}</td>
                        </tr>";
}

$string_show .= "
                    </tbody>
                </table>
            </div>

            <div class=\"divider\"></div>

            <div class=\"flex justify-between items-center\">
                <a href=\"{{ route('$route_name.index') }}\" class=\"btn btn-ghost\">
                    <span class=\"icon-[tabler--arrow-left] size-5\"></span> Kembali
                </a>
                <div class=\"flex gap-2\">
                    <a href=\"{{ route('$route_name.edit', \$item->$pk) }}\" class=\"btn btn-warning\">
                        <span class=\"icon-[tabler--edit] size-5\"></span> Edit
                    </a>
                    <form action=\"{{ route('$route_name.destroy', \$item->$pk) }}\" 
                          method=\"POST\" class=\"inline\"
                          onsubmit=\"return confirm('Yakin ingin menghapus data ini?')\">
                        @csrf
                        @method('DELETE')
                        <button type=\"submit\" class=\"btn btn-error\">
                            <span class=\"icon-[tabler--trash] size-5\"></span> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
";

// Create view files
$hasil_laravel_view_index = createFile($string_index, $target . $view_folder . "/index.blade.php");
$hasil_laravel_view_create = createFile($string_create, $target . $view_folder . "/create.blade.php");
$hasil_laravel_view_edit = createFile($string_edit, $target . $view_folder . "/edit.blade.php");
$hasil_laravel_view_show = createFile($string_show, $target . $view_folder . "/show.blade.php");

?>