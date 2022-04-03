<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAddRequest;
use App\Http\Requests\AdminEditRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use Response;
use Hash;

class APIAdminController extends Controller
{
    private $queryAdmin;
    private $orderColumn;
    private $orderDir;

    public function GetAdminList(Request $request)
    {
        $this->queryAdmin = Admin::select('id', 'username', 'created_at');
        $this->whereLikeUsername($request->search['value']);
        $this->orderBy($request->order[0]['column'], $request->order[0]['dir']);

        $adminList = $this->queryAdmin
                            ->skip($request->start)
                            ->take($request->length)
                            ->get();

        $totalAdmin     = $this->TotalAdmin();
        $totalFilter    = $totalAdmin;
        if($request->search['value'] != ""){
            $totalFilter = (int)$this->queryAdmin->count();
        }
        
        $result = [];
        foreach($adminList as $row){
            $result['data'][] = [
                $row->username,
                date('d m Y', strtotime($row->created_at)),
                '<a href="#" class="btn-modal-edit" data-id="'.$row->id.'"><i class="fa fa-pencil"><i></a>',
                '<a href="#" class="btn-delete" data-id="'.$row->id.'" onclick="isConfirm = confirm(\'are you sure?\')"><i class="fa fa-trash"><i></a>'
            ];
        }
        $result['recordsFiltered'] = $totalFilter;
        $result['recordsTotal'] = $totalAdmin;

        return response()->json($result, 200);
    }

    private function whereLikeUsername($username)
    {
        $this->queryAdmin = $this->queryAdmin->where('username', 'like', '%'.$username.'%');
    }

    private function orderBy($column, $dir)
    {
        // if column 0 = username
        if($column == 0){
            $this->queryAdmin = $this->queryAdmin->orderBy('username', $dir);
        }
       // if column 1 = created_at
       if($column == 1){
            $this->queryAdmin = $this->queryAdmin->orderBy('created_at', $dir);
        }
    }

    private function TotalAdmin()
    {
        $adminList = Admin::select('id')->count();
        return $adminList;
    }

    public function GetData(Request $request)
    {
        $data = Admin::find($request->id);
        $response  = [
            'message' => 'success',
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function StoreAdmin(AdminAddRequest $request)
    {
        $findUsername = Admin::where('username', $request->username)->count();
        if($findUsername){
            $response = [
                'message' => 'Username is Existing',
                'data' => []
            ];
            return response()->json($response, 400);
        }
        $store = Admin::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        $response  = [
            'message' => 'success',
            'data' => $store
        ];
        return response()->json($response, 200);
    }

    public function UpdateAdmin(AdminEditRequest $request)
    {
        $isExisting = $this->checkExistingID($request->id);
        if(!$isExisting){
            $findUsername = Admin::where('username', $request->username)->count();
            if($findUsername){
                $response = [
                    'message' => 'ID not existing!',
                    'data' => []
                ];
                return response()->json($response, 400);
            }
        }
        $store = Admin::where("id", $request->id)
                ->update([
                    'password' => Hash::make($request->password)
                ]);
        $response  = [
            'message' => 'success',
            'data' => $store
        ];
        return response()->json($response, 200);
    }

    public function DeleteAdmin(Request $request)
    {
        $admin = Admin::find($request->id);
        $admin->delete();

        $response  = [
            'message' => 'success'
        ];
        return response()->json($response, 200);
    }

    private function checkExistingID($id)
    {
        $findID = Admin::find($id);
        if($findID){
            return true;
        }
        return false;
    }
}
