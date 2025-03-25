<?php

namespace App\Repositories\Hostel_Admin;

use App\Traits\ResponseMessage;
use Yajra\DataTables\Facades\DataTables;
use App\Interfaces\Hostel_Admin\BillInterface;
use App\Models\Bill;

class BillRepository {

    use ResponseMessage;

    public function getAll($request){
        $getData = Bill::where('hostel_id', auth()->user()->hostel_id)->orderBy('id','DESC');

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
                $action .= '<button type="button" class="btn-style btn-style-edit edit_data" data-id="'.$row->id.'"><i class="fa fa-edit fa-sm"></i></button>';
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function userUpdateOrCreate($request){
        $collection = collect($request->validated());
        $collection = $collection->merge(['hostel_id'=>auth()->user()->hostel_id]);
        $result     = Bill::updateOrCreate(['id'=>$request->update_id],$collection->all());
        return $result;
    }

    public function edit(int $id){
        $data = Bill::where(['hostel_id'=>auth()->user()->hostel_id,'id'=>$id])->firstOrFail();
        return $data;
    }

}