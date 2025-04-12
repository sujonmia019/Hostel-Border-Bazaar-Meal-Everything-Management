<?php

namespace App\Repositories\Hostel_Admin;

use App\Constants\Constants;
use App\Interfaces\Hostel_Admin\BillInterface;
use App\Models\Bill;
use App\Models\BillStatus;
use App\Models\User;
use App\Traits\ResponseMessage;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class BillRepository {

    use ResponseMessage;

    public function getAll($request){
        $getData = Bill::with(['billStatus','border'])
                    ->whereMonth('bill_month', Carbon::now())
                    ->where('hostel_id', auth()->user()->hostel_id)
                    ->orderBy('id','DESC');

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
                return TYPE_LABEL[$row->type];
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
                $action .= '<a href="'.route('app.hostel-admin.bills.edit', $row->id).'"class="btn-style btn-style-edit edit_data" data-id="'.$row->id.'"><i class="fa fa-edit fa-sm"></i></a>';
                $action .= '</div>';
                return $action;
            })
            ->rawColumns(['type','action'])
            ->make(true);
    }

    public function updateOrStore($request){
        $collection = collect($request->validated())->except('bill_month');
        $bill_month = date("Y-m-01", strtotime($request->bill_month));
        $updated_by = $request->update_id ? auth()->user()->name : null;
        $collection = $collection->merge(['bill_month'=>$bill_month,'hostel_id'=>auth()->user()->hostel_id,'updated_by'=>$updated_by]);
        $result     = Bill::updateOrCreate(['id'=>$request->update_id],$collection->all());
        return $result;
    }

    public function edit(int $id){
        $data['edit']       = Bill::where(['hostel_id'=>auth()->user()->hostel_id,'id'=>$id])->firstOrFail();
        $data['billStatus'] = BillStatus::pluck('name','id');
        $data['borders']    = User::where(['hostel_id'=>auth()->user()->id,'role'=>Constants::BORDER_ROLE])->pluck('name','id');
        return $data;
    }

}
