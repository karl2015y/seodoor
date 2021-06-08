<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateVendor;

use App\Models\Vendor;
use App\Models\PlanType;
use Illuminate\Support\Carbon;





class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //TODO index page Done!
    public function index(Request $request)
    {


        $datas_count = Vendor::count();
        $data_limit_count_in_one_page = 10;
        $pages = ceil($datas_count / $data_limit_count_in_one_page);
        $current_page = isset($request->all()['page']) ? $request->all()['page'] : 1;
        $datas = Vendor::orderby("created_at", 'asc')
            ->offset($data_limit_count_in_one_page * ($current_page - 1))
            ->limit($data_limit_count_in_one_page)
            ->with('nowPlan.planType')
            ->get();

        return view('admin.vendors', [
            'Modal_ERR' => true,
            'datas_vendor' => $datas,
            'datas_planType' => PlanType::all(),
            'pages' => $pages,
            'current_page' => $current_page,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //TODO store Done!
    public function store(CreateVendor $request)
    {
        $validateData = $request->validated();
        $pt = PlanType::find($validateData['plan_type_id']);
        unset($validateData['plan_type_id']);
        $vendor = Vendor::create($validateData);
        $pt->plans()->create([
            'vendor_id' => $vendor->id,
            'stop_at' => Carbon::now()->addDays($pt->days)
        ]);

        return redirect()->route('create-vendor')->with([
            'alert-class' => 'alert-success',
            'message' => "新增成功！"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //TODO show page Done!
    public function show($id)
    {
        $data = Vendor::find($id)
            ->with('nowPlan.planType')
            ->first();
            
        return view('admin.vendor_single', [
            'Modal_ERR' => true,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //TODO update Done!
    public function update(Request $request, $id)
    {
        $validateData = $request->all();
        Vendor::find($id)->update($validateData);
        return redirect()->route('single-vendor',[$id=>$id])->with([
            'alert-class' => 'alert-success',
            'message' => "更新成功！"
        ]);
    }


}
