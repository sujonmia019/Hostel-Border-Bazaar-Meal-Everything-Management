<?php

namespace App\Repositories\Border;

use App\Models\HostelBazaar;
use Yajra\DataTables\Facades\DataTables;

class BazaarRepository {

    public function getAllUsers($request){
        $getData = HostelBazaar::where(['hostel_id'=>auth()->user()->hostel_id,'user_id'=>auth()->user()->id])->orderBy('id','DESC');

        return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if (!empty($request->search)) {
                    $query->where('name', 'LIKE', "%$request->search%")
                        ->orWhere('email', 'LIKE', "%$request->search%");
                }
            })
            ->addColumn('status', function($row){
                return change_status($row->id,$row->status, $row->name);
            })
            ->addColumn('action', function($row){
                $action = '<div class="d-flex align-items-center justify-content-end">';

                $action .= '<button type="button" class="btn-style btn-style-danger delete_data" data-id="' . $row->id . '" data-name="' . $row->name . '"><i class="fa fa-trash"></i></button>';
                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }

    public function store($request){
        $collection = collect($request->validated());
        $hostel_id  = auth()->user()->hostel_id;
        $user_id    = auth()->user()->id;
        $collection = $collection->merge(['hostel_id' => $hostel_id, 'user_id'=>$user_id]);
        $result     = HostelBazaar::create($collection->all());
        return $result ? true : false;
    }

}
