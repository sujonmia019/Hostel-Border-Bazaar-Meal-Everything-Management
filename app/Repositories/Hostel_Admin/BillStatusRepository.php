<?php

namespace App\Repositories\Hostel_Admin;

use App\Traits\ResponseMessage;
use Yajra\DataTables\Facades\DataTables;
use App\Interfaces\Hostel_Admin\BillStatusInterface;
use App\Models\BillStatus;

class BillStatusRepository implements BillStatusInterface {

    use ResponseMessage;

    public function getAllUsers($request){
        $getData = BillStatus::where('hostel_id', auth()->user()->hostel_id)->orderBy('id','DESC');

        return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if (!empty($request->search)) {
                    $query->where('name', 'LIKE', "%$request->search%");
                }
            })
            ->addColumn('created_at', function($row){
                return dateFormat($row->created_at, 'd-m-Y h:i A');
            })
            ->addColumn('action', function($row){
                $action = '<div class="d-flex align-items-center justify-content-end">';
                $action .= '<button type="button" class="btn-style btn-style-edit edit_data" data-id="'.$row->id.'"><i class="fa fa-edit"></i></button>';
                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }

    public function userUpdateOrCreate($request){
        $collection = collect($request->validated());
        $collection = $collection->merge(['hostel_id'=>auth()->user()->hostel_id]);
        $result     = BillStatus::updateOrCreate(['id'=>$request->update_id],$collection->all());
        return $result;
    }

    public function edit(int $id){
        $data = BillStatus::where(['hostel_id'=>auth()->user()->hostel_id,'id'=>$id])->firstOrFail();
        return $data;
    }

}