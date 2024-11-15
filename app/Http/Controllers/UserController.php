<?php
namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function import(Request $request)
    {
	ini_set('max_execution_time', 5500);
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return redirect()->back()->with('success', 'Archivo importado exitosamente.');
    }
}
