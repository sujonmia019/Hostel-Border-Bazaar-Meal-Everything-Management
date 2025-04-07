<?php

namespace App\Repositories\Hostel_Admin;

use App\Traits\ResponseMessage;
use Yajra\DataTables\Facades\DataTables;
use App\Interfaces\Hostel_Admin\BillInterface;
use App\Models\Bill;

class BillRepository {

    use ResponseMessage;

    public function getAll($request){
        $getData = Bill::with(['billStatus','border'])->where('hostel_id', auth()->user()->hostel_id)->orderBy('id','DESC');

        return DataTables::eloquent($getData)
            ->addIndexColumn()
            ->filter(function ($query) use ($request) {
                if (!empty($request->search)) {
                    $query->where('name', 'LIKE', "%$request->search%");
                }
            })
            ->addColumn('bill_month', function($row){
                return dateFormat($row->bill_month, 'F-Y');
            })
            ->addColumn('type', function($row){
                return TYPE[$row->type];
            })
            ->addColumn('border', function($row){
                return $row->border_id ? $row->border->name : 'All Borders';
            })
            ->addColumn('bill_status', function($row){
                return $row->billStatus->name;
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

    public function updateOrStore($request){
        $collection = collect($request->validated())->except('bill_month');
        $bill_month = date("Y-m-01", strtotime($request->bill_month));
        $collection = $collection->merge(['bill_month'=>$bill_month,'hostel_id'=>auth()->user()->hostel_id]);
        $result     = Bill::updateOrCreate(['id'=>$request->update_id],$collection->all());
        return $result;
    }

    public function edit(int $id){
        $data = Bill::where(['hostel_id'=>auth()->user()->hostel_id,'id'=>$id])->firstOrFail();
        return $data;
    }

}