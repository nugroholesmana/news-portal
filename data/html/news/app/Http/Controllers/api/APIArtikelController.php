<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ArtikelModel;
use App\Http\Requests\ArtikelAddRequest;
use App\Http\Requests\ArtikelEditRequest;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Response;
use Input;

class APIArtikelController extends Controller
{
    private $queryArtikel;

    public function GetArtikelList(Request $request)
    {
        $this->queryArtikel= ArtikelModel::select('id', 'thumbnail_artikel', 'judul_artikel','kategori_artikel', 'ArtikelModel', 'created_at');
        $this->whereLikeArtikel($request->search['value']);
        $this->orderBy($request->order[0]['column'], $request->order[0]['dir']);

        $artikelList = $this->queryArtikel
                        ->skip($request->start)
                        ->take($request->length)
                        ->get();

        $totalArtikel     = $this->TotalArtikel();
        $totalFilter    = $totalArtikel;
        if($request->search['value'] != ""){
            $totalFilter = (int)$this->queryArtikel->count();
        }

        $result = [];
        foreach($artikelList as $row){
            $result['data'][] = [
                '<img src="'.asset('storage/thumbnail/'.$row->thumbnail_artikel).'" width="200px" />',
                $row->judul_artikel,
                $row->kategori_artikel,
                $row->tag_artikel,
                date('d m Y', strtotime($row->created_at)),
                '<a href="#" class="btn-modal-edit" data-id="'.$row->id.'"><i class="fa fa-pencil"><i></a>',
                '<a href="#" class="btn-delete" data-id="'.$row->id.'" onclick="isConfirm = confirm(\'are you sure?\')"><i class="fa fa-trash"><i></a>'
            ];
        }
        $result['recordsFiltered'] = $totalFilter;
        $result['recordsTotal'] = $totalArtikel;

        return response()->json($result, 200);
    }
    public function whereLikeArtikel($value)
    {
        $this->queryArtikel = $this->queryArtikel->where('judul_artikel', 'like', '%'.$value.'%')
                                ->orWhere('kategori_artikel', 'like', '%'.$value.'%');
    }

    private function orderBy($column, $dir)
    {
        // if column 1 = judul_artikel
        if($column == 1){
            $this->queryrtikel = $this->queryrtikel->orderBy('judul_artikel', $dir);
        }
        // if column 2 = kategori_artikel
        if($column == 2){
            $this->queryrtikel = $this->queryrtikel->orderBy('kategori_artikel', $dir);
        }
       // if column 3 = created_at
       if($column == 1){
            $this->queryrtikel = $this->queryrtikel->orderBy('created_at', $dir);
        }
    }

    private function TotalArtikel()
    {
        $artikelList = ArtikelModel::select('id')->count();
        return $artikelList;
    }
    public function GetData(Request $request)
    {
        $data = ArtikelModel::find($request->id);
        $response  = [
            'message' => 'success',
            'data' => $data
        ];
        return response()->json($response, 200);
    }


    public function StoreArtikel(Request $request)
    {
        $validated = $request->validate([
            'judul_artikel' => 'required|max:255',
            'isi_artikel' => 'required',
            'kategori_artikel' => 'required',
            'tag_artikel' => 'required',
        ]);

        $extensionFile  = $request->file('thumbnail_artikel')->getClientOriginalExtension();
        $fileName       = Str::slug($request->judul_artikel, '-').'.'.$extensionFile;
        $uploadFile     = $request->file('thumbnail_artikel')->store('thumbnail/'.$fileName);

        $store = ArtikelModel::create([
            'judul_artikel' => $request->judul_artikel,
            'kategori_artikel' => $request->kategori_artikel,
            'tag_artikel' => $request->tag_artikel,
            'isi_artikel' => $request->isi_artikel,
            'created_at' => date('Y-m-d H:i:s'),
            'thumbnail_artikel' => $fileName,
        ]);
        $response  = [
            'message' => 'success',
            'data' => $store
        ];
        return response()->json($response, 200);
    }

    public function UpdateArtikel(Request $request)
    {

        $validated = $request->validate([
            'judul_artikel' => 'required|max:255',
            'isi_artikel' => 'required',
            'kategori_artikel' => 'required',
            'tag_artikel' => 'required',
        ]);

        $isExisting = $this->checkExistingID($request->id);
        
        $findArtikel = ArtikelModel::find($request->id);
        $thumbnail_artikel  = $findArtikel->thumbnail_artikel;

        if ($request->hasFile('thumbnail_artikel')) {
            $extensionFile      = $request->file('thumbnail_artikel')->getClientOriginalExtension();
            $thumbnail_artikel  = Str::slug($request->judul_artikel, '-').'.'.$extensionFile;
            $uploadFile         = $request->file('thumbnail_artikel')->storeAs(
                'thumbnail',
                $thumbnail_artikel,
                'public'
            );
        }
        $store = ArtikelModel::where("id", $request->id)
                ->update([
                    'judul_artikel' => $request->judul_artikel,
                    'kategori_artikel' => $request->kategori_artikel,
                    'tag_artikel' => $request->tag_artikel,
                    'isi_artikel' => $request->isi_artikel,
                    'thumbnail_artikel' => $thumbnail_artikel,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        $response  = [
            'message' => 'success',
            'data' => $store,
            'request_id'=> $request->all()
        ];
        return response()->json($response, 200);
    }

    private function checkExistingID($id)
    {
        $findID = ArtikelModel::find($id);
        if($findID){
            return true;
        }
        return false;
    }

    public function DeleteArtikel(Request $request)
    {
        $artikel = ArtikelModel::find($request->id);
        Storage::disk('public')->delete('thumbnail/'.$artikel->thumbnail_artikel);
        $artikel->delete();
        
        $response  = [
            'message' => 'success'
        ];
        return response()->json($response, 200);
    }
}
