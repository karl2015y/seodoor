<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDoor;
use App\Models\Door;
use App\Models\Log;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DoorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //TODO index page W!
    public function index(Request $request, $vendor_id)
    {


        $datas_count = Door::count();
        $data_limit_count_in_one_page = 10;
        $pages = ceil($datas_count / $data_limit_count_in_one_page);
        $current_page = isset($request->all()['page']) ? $request->all()['page'] : 1;
        $datas = Door::orderby("created_at", 'asc')
            ->offset($data_limit_count_in_one_page * ($current_page - 1))
            ->limit($data_limit_count_in_one_page)
            ->with('logs')
            ->get();
        $logs =[
            'all_count' => 0,
            'in_count' => 0,
            'go_count' => 0,
            'leave_count' => 0,
        ];
        foreach ($datas as $item) {
            $all_count = 0;
            $in_count = 0;
            $go_count = 0;
            $leave_count = 0;
            foreach ($item['logs'] as $value) {
                if ($value['action'] == '進入') {
                    $in_count++;
                } else if ($value['action'] == '前往') {
                    $go_count++;
                } else if ($value['action'] == '離開') {
                    $leave_count++;
                }
                $all_count++;
            }
            $logs['all_count'] += $all_count;
            $logs['in_count'] += $in_count;
            $logs['go_count'] +=  $go_count;
            $logs['leave_count'] += $leave_count;

            $item['logs_count'] = $all_count;
            $all_count = $all_count==0?1:$all_count;
            $item['all_go_percent'] = round(($go_count+$leave_count)/$all_count*100, 2);
            $item['go_percent'] = round(($go_count)/$all_count*100, 2);
            $item['leave_percent'] = round(($leave_count)/$all_count*100, 2);

        }
        $logs['all_count_tmp'] = $logs['all_count']==0?1:$logs['all_count'];
        $logs['all_go_percent'] = round(($logs['go_count']+$logs['leave_count'])/$logs['all_count_tmp']*100, 2);
        $logs['go_percent'] = round(($logs['go_count'])/$logs['all_count_tmp']*100, 2);
        $logs['leave_percent'] = round(($logs['leave_count'])/$logs['all_count_tmp']*100, 2);

        return view('admin.doors', [
            'logs_data' => $logs,
            'doors_count' => $datas_count,
            'vendor_id' => $vendor_id,
            'vendor_name' => Vendor::find($vendor_id)->first()->name,
            'Modal_ERR' => true,
            'datas_vendor' => $datas,
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
    //TODO store W!
    public function store(CreateDoor $request, $vendor_id)
    {
        // dd($vendor_id);
        $validateData = $request->validated();
        $file_name = $validateData['URL'] . '.' . $request->file('image')->extension();
        $save_floder = "doors";
        $request->file('image')->storeAs(
            'public/' . $save_floder,
            $file_name
        );
        $save_path = 'storage/' . $save_floder . '/' . $file_name;
        // dd(asset(($save_path)));

        unset($validateData['image']);
        $validateData['pic'] = $save_path;
        // $validateData['vendor_id'] = $vendor_id;
        Vendor::find($vendor_id)->doors()->create($validateData);

        // $door = Door::create($validateData);


        return redirect()->route('doors', ['vendor_id' => $vendor_id])->with([
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
    //TODO show_seodoor page Done!
    public function show_seodoor($URL)
    {
        $data = Door::where('URL', $URL)->first();
        if ($data == null) {
            abort(404);
        }
        $data->logs()->create([
            'action' => '進入',
            'lat' => '0',
            'lon' => '0',
        ]);


        return view('seodoor', [
            'door' => $data
        ]);
    }
    public function store_log_seodoor(Request $request, $URL)
    {
        $data = Door::where('URL', $URL)->first();
        if ($data == null) {
            abort(404);
        }
        $data->logs()->create($request->all());

        return redirect($data->to_link);;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //TODO show page Done!
    public function show(Request $request, $vendor_id, $id)
    {
        $door = Door::find($id)->first();
        $datas_count = Log::count();
        $data_limit_count_in_one_page = 10;
        $pages = ceil($datas_count / $data_limit_count_in_one_page);
        $current_page = isset($request->all()['page']) ? $request->all()['page'] : 1;
        $datas = Log::orderby("created_at", 'desc')
            ->offset($data_limit_count_in_one_page * ($current_page - 1))
            ->limit($data_limit_count_in_one_page)
            ->get();

        return view('admin.door_single', [
            'vendor_id' => $vendor_id,
            'vendor_name' => $door->vendor()->first()->name,
            'door' => $door,
            'datas_vendor' => $datas,
            'pages' => $pages,
            'current_page' => $current_page,
        ]);
    }

    /**
     * delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //TODO delete Done!
    public function del(Request $request, $vendor_id, $id)
    {

        Door::find($id)->logs()->delete();
        Door::find($id)->delete();
        return redirect()->route('doors', ['vendor_id' => $vendor_id])->with([
            'alert-class' => 'alert-success',
            'message' => "刪除成功！"
        ]);
    }
}
