@extends("admin.base")

@section("title", "廠商列表")

@section('top-nav')
    <ol class="breadcrumb my-auto mr-auto">
        <li class="breadcrumb-item"><a href="{{route('create-vendor')}}">廠商列表</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$data->name}}</li>
    </ol>
@endsection

@section("content")
<div class="w-100 d-flex justify-content-between align-items-center">
    <div>
        <h2 class="h2 mt-2">廠商名稱：{{$data->name}}</h2>
        <span class="small text-secondary">
            更新時間：{{$data->updated_at}} / 建立時間：{{$data->created_at}}
        </span>
    </div>
    <button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modal">
        編輯
    </button>
</div>
<div class="my-4">
    <h4 class="font-weight-bold mb-0">廠商資訊
    </h4>
    <div class="row my-1">
        <div class="col-sm-3">
            廠商電話：{{$data->phone?$data->phone:'無'}}
        </div>
        <div class="col-sm-3">
            廠商地址：{{$data->address?$data->address:'無'}}
        </div>
        <div class="col-sm-3">
            聯絡人姓名：{{$data->person_name?$data->person_name:'無'}}
        </div>
        <div class="col-sm-3">
            聯絡人電話：{{$data->person_phone?$data->person_phone:'無'}}
        </div>
        <div class="col border-top mt-1 pt-1">
            備註：
            <p class="ml-2" style="white-space: pre-line;">
                {{$data->note?$data->note:'無'}}
            </p>
        </div>
    </div>
</div>
<div class="my-4">
    <h4 class="font-weight-bold mb-0">現行方案：{{$data->nowPlan->planType->name}}</h4>
    <div class="row my-1">
        <div class="col-sm-6">
            <span>
                到期時間：{{$data->nowPlan->stop_at}}
                <br>
                修改時間：{{$data->nowPlan->created_at}}
            </span>
        </div>
        <div class="col-sm-6">
            <span>
                方案時長：{{$data->nowPlan->planType->days}}
                <br>
                門戶數量：{{$data->nowPlan->planType->door_counts}}
            </span>
        </div>
    </div>
</div>





@endsection

<!-- Modal -->


@section("modal-title", "新增廠商")

@section("modal-body")
<form ction="/" method="post">
    @csrf
    <div class="form-group">
        <label for="name_input">廠商名稱：{{$data->name}}</label>
       
    </div>

    <div class="form-group">
        <label for="phone_input">廠商電話</label>
        <input type="text" class="form-control" id="phone_input" name="phone" value="{{$data->phone?$data->phone:'無'}}"
            placeholder="廠商電話">
    </div>

    <div class="form-group">
        <label for="address_input">廠商地址</label>
        <input type="text" class="form-control" id="address_input" name="address" value="{{$data->address?$data->address:'無'}}"
            placeholder="廠商地址">
    </div>

    <div class="form-group">
        <label for="person_name_input">聯絡人姓名</label>
        <input type="text" class="form-control" id="person_name_input" name="person_name" value="{{$data->person_name?$data->person_name:'無'}}"
            placeholder="聯絡人姓名">
    </div>

    <div class="form-group">
        <label for="person_phone_input">聯絡人電話</label>
        <input type="text" class="form-control" id="person_phone_input" name="person_phone"
            value="{{$data->person_phone?$data->person_phone:'無'}}" placeholder="聯絡人電話">
    </div>

    <div class="form-group">
        <label for="note_input">備註</label>
        <textarea class="form-control" id="note_input" rows="3" name="note">{{$data->note?$data->note:'無'}}</textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">新增</button>
    </div>
</form>
@endsection