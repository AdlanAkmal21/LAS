<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $files = File::paginate(10);
        $files_count = $files->count();

        return view('file.file_list', compact('files','files_count'));
    }
}
