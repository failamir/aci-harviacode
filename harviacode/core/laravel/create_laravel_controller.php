<?php

/**
 * Laravel Controller Generator
 * Generates Resource Controller for Laravel
 */

$model_name = isset($custom_model) && $custom_model != '' ? $custom_model : tableToModelName($table_name);
$controller_name = $model_name . 'Controller';
$view_folder = strtolower($table_name);
$route_name = strtolower($table_name);

$string = "<?php

namespace App\Http\Controllers;

use App\Models\\" . $model_name . ";
use App\Http\Requests\\" . $model_name . "Request;
use Illuminate\Http\Request;

class " . $controller_name . " extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request \$request)
    {
        \$query = " . $model_name . "::query();

        // Search functionality
        if (\$request->has('search') && \$request->search != '') {
            \$search = \$request->search;
            \$query->where(function(\$q) use (\$search) {";

foreach ($non_pk as $index => $row) {
    if ($index === 0) {
        $string .= "\n                \$q->where('" . $row['column_name'] . "', 'like', '%' . \$search . '%')";
    } else {
        $string .= "\n                  ->orWhere('" . $row['column_name'] . "', 'like', '%' . \$search . '%')";
    }
}

$string .= ";
            });
        }

        \$data = \$query->orderBy('$pk', 'desc')->paginate(10);

        return view('$view_folder.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('$view_folder.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(" . $model_name . "Request \$request)
    {
        \$data = \$request->validated();
        
        " . $model_name . "::create(\$data);

        return redirect()->route('$route_name.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(\$id)
    {
        \$item = " . $model_name . "::findOrFail(\$id);
        
        return view('$view_folder.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\$id)
    {
        \$item = " . $model_name . "::findOrFail(\$id);
        
        return view('$view_folder.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(" . $model_name . "Request \$request, \$id)
    {
        \$item = " . $model_name . "::findOrFail(\$id);
        \$data = \$request->validated();
        
        \$item->update(\$data);

        return redirect()->route('$route_name.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\$id)
    {
        \$item = " . $model_name . "::findOrFail(\$id);
        \$item->delete();

        return redirect()->route('$route_name.index')
            ->with('success', 'Data berhasil dihapus!');
    }";

// Export to Excel
if ($export_excel == '1') {
    $string .= "

    /**
     * Export data to Excel.
     */
    public function exportExcel()
    {
        \$data = " . $model_name . "::all();
        
        \$filename = '$table_name-' . date('Y-m-d-His') . '.xls';
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=\"' . \$filename . '\"');
        header('Cache-Control: max-age=0');

        \$output = '<table border=\"1\">';
        \$output .= '<tr>';";

    foreach ($non_pk as $row) {
        $label = label($row['column_name']);
        $string .= "\n        \$output .= '<th>$label</th>';";
    }

    $string .= "
        \$output .= '</tr>';

        foreach (\$data as \$row) {
            \$output .= '<tr>';";

    foreach ($non_pk as $row) {
        $string .= "\n            \$output .= '<td>' . \$row->" . $row['column_name'] . " . '</td>';";
    }

    $string .= "
            \$output .= '</tr>';
        }

        \$output .= '</table>';

        echo \$output;
        exit();
    }";
}

// Export to Word
if ($export_word == '1') {
    $string .= "

    /**
     * Export data to Word.
     */
    public function exportWord()
    {
        \$data = " . $model_name . "::all();
        
        \$filename = '$table_name-' . date('Y-m-d-His') . '.doc';
        
        header('Content-Type: application/vnd.ms-word');
        header('Content-Disposition: attachment;filename=\"' . \$filename . '\"');
        header('Cache-Control: max-age=0');

        \$output = '<h2>" . ucfirst($table_name) . " Data</h2>';
        \$output .= '<table border=\"1\" cellpadding=\"5\" cellspacing=\"0\">';
        \$output .= '<tr style=\"background-color: #f0f0f0;\">';
        \$output .= '<th>No</th>';";

    foreach ($non_pk as $row) {
        $label = label($row['column_name']);
        $string .= "\n        \$output .= '<th>$label</th>';";
    }

    $string .= "
        \$output .= '</tr>';

        \$no = 1;
        foreach (\$data as \$row) {
            \$output .= '<tr>';
            \$output .= '<td>' . \$no++ . '</td>';";

    foreach ($non_pk as $row) {
        $string .= "\n            \$output .= '<td>' . \$row->" . $row['column_name'] . " . '</td>';";
    }

    $string .= "
            \$output .= '</tr>';
        }

        \$output .= '</table>';

        echo \$output;
        exit();
    }";
}

$string .= "
}

/* End of file " . $controller_name . ".php */
/* Location: ./app/Http/Controllers/" . $controller_name . ".php */
/* Generated by Harviacode CRUD Generator " . date('Y-m-d H:i:s') . " */
/* http://harviacode.com */
";

// Create file
$controller_file = $controller_name . '.php';
$hasil_laravel_controller = createFile($string, $target . $controller_file);

?>