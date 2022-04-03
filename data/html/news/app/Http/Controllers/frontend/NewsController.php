<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArtikelModel;

class NewsController extends Controller
{
    public function __construct() {
        
    }
    public function index()
    {
        $artikelList = ArtikelModel::get();
        $data = [
            'artikels' => $artikelList
        ];
        return view('frontend.pages.news.index', $data);
    }

    public function detail($id)
    {
        $artikel = ArtikelModel::findOrFail($id);
        $data = [
            'artikel' => $artikel
        ];
        return view('frontend.pages.news.detail', $data);
    }
}
