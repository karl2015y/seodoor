@extends("admin.base")

@section("title", "廠商列表")


@section("content")
<div class="w-100 d-flex justify-content-between align-items-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item {{$current_page<=1?'disabled':''}}">
                <a class="page-link" tabindex="{{$current_page<=1?-1:0}}"
                    href="?page={{$current_page>1?$current_page-1:1}}" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>

                </a>
            </li>
            @for ($i = 1; $i <= $pages; $i++) <li class="page-item {{$current_page==$i?'active':''}}"><a
                    class="page-link" href="?page={{$i}}">{{$i}}</a></li>
                @endfor

                <li class="page-item {{$current_page>=$pages?'disabled':''}}">
                    <a class="page-link" tabindex="{{$current_page>=$pages?-1:0}}"
                        href="?page={{$current_page<$pages?$current_page+1:$pages}}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
        </ul>
    </nav>
    <button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#modal">
        新增廠商
    </button>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">廠商名稱</th>
                <th scope="col">門戶方案</th>
                <th scope="col">方案到期日期</th>
                <th scope="col">方案最後更新時間</th>
                <th scope="col">門戶列表</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas_vendor as $key => $item)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>
                    <a href="{{route('single-vendor', ['id' => $item->id])}}">{{$item->name}}</a>
                    
                </td>
                <td>{{$item->nowPlan->planType->name}}({{$item->nowPlan->planType->days}}天
                    {{$item->nowPlan->planType->door_counts}}個門戶)</td>
                <td>{{$item->nowPlan->stop_at}}</td>
                <td>{{$item->nowPlan->updated_at}}</td>
                <td class="p-2">
                    <a href="{{route('doors', ['vendor_id' => $item->id])}}" class="btn btn-sm btn-warning text-white">GO！</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>




@endsection

<!-- Modal -->


@section("modal-title", "新增廠商")

@section("modal-body")
<form ction="/" method="post">
    @csrf
    <div class="form-group">
        <label for="name_input">廠商名稱 <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="name_input" name="name" value="{{old('name')}}" placeholder="廠商名稱">
    </div>
    <div class="form-group">
        <label for="plan_id_input">
            門戶方案 <span class="text-danger">*</span>
            <a href="{{route('create-plan-type')}}">新增方案</a>
        </label>
        <select class="form-control" id="plan_id_input" name="plan_type_id">
            <option value="" disabled> 請選擇方案</option>
            @foreach ($datas_planType as $item)
            <option value="{{$item->id}}" {{old('plan_type_id')==$item->id?'selected':''}}>
                {{$item->name}}({{$item->days}}天 {{$item->door_counts}}個門戶)
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="phone_input">廠商電話</label>
        <input type="text" class="form-control" id="phone_input" name="phone" value="{{old('phone')}}"
            placeholder="廠商電話">
    </div>

    <div class="form-group">
        <label for="address_input">廠商地址</label>
        <input type="text" class="form-control" id="address_input" name="address" value="{{old('address')}}"
            placeholder="廠商地址">
    </div>

    <div class="form-group">
        <label for="person_name_input">聯絡人姓名</label>
        <input type="text" class="form-control" id="person_name_input" name="person_name" value="{{old('person_name')}}"
            placeholder="聯絡人姓名">
    </div>

    <div class="form-group">
        <label for="person_phone_input">聯絡人電話</label>
        <input type="text" class="form-control" id="person_phone_input" name="person_phone"
            value="{{old('person_phone')}}" placeholder="聯絡人電話">
    </div>

    <div class="form-group">
        <label for="note_input">備註</label>
        <textarea class="form-control" id="note_input" rows="3" name="note">
        {{old('note')}}
        </textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">新增</button>
    </div>
</form>
@endsection