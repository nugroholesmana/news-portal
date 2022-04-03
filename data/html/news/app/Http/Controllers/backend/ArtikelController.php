<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArtikelModel;

class ArtikelController extends Controller
{
    public function __construct() {
        
    }

    public function index()
    {
       
        return view('backend.pages.artikel.index');
    }
}
