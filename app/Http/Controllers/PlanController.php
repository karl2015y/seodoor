<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\PlanType;

use App\Http\Requests\CreatePlanType;


class PlanController extends Controller
{
    /**
     * 
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    //TODO planTypeIndex Done!
    public function planTypeIndex(Request $request) 
    {
        $datas_count = PlanType::count();
        $data_limit_count_in_one_page = 10;
        $pages = ceil($datas_count / $data_limit_count_in_one_page);
        $current_page = isset($request->all()['page']) ? $request->all()['page'] : 1;
        $datas = PlanType::orderby("created_at", 'asc')
            ->offset($data_limit_count_in_one_page * ($current_page - 1))
            ->limit($data_limit_count_in_one_page)
            ->get();

        return view('admin.plantypes', [
            'Modal_ERR' => true,
            'datas' => $datas,
            'pages' => $pages,
            'current_page' => $current_page,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Models\PlanType  $request
     * @return \Illuminate\Http\Response
     */
    //TODO planTypeStore Done!
    public function planTypeStore(CreatePlanType $request)
    {
        $validateData = $request->validated();
        PlanType::create($validateData);
        // return view('admin.plantypes', [
        //     'datas' => $validateData
        // ]);
        return redirect()->route('create-plan-type')->with([
            'alert-class' => 'alert-success',
            'message'=> "新增成功！"
            ]);
    }


}
