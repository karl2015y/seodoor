@extends("admin.base")

@section("title", "方案類別")

@section('top-nav')
<ol class="breadcrumb my-auto mr-auto">
    <li class="breadcrumb-item"><a href="{{route('create-vendor')}}">廠商列表</a></li>
    <li class="breadcrumb-item active" aria-current="page">新增方案</li>
</ol>
@endsection

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
        新增方案
    </button>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">方案名稱</th>
                <th scope="col">授權天數</th>
                <th scope="col">門戶數量</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $key => $item)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->days}}天</td>
                <td>{{$item->door_counts}}個</td>

            </tr>
            @endforeach

        </tbody>
    </table>
</div>




@endsection

<!-- Modal -->


@section("modal-title", "新增方案類別")

@section("modal-body")
<form ction="/" method="post">
    @csrf
    <div class="form-group">
        <label for="name_input">方案名稱 <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="name_input" name="name" value="{{old('name')}}" placeholder="方案名稱">
    </div>
    <div class="form-group">
        <label for="days_input">授權天數 <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="days_input" name="days" value="{{old('days')}}" placeholder="授權天數">
    </div>
    <div class="form-group">
        <label for="door_counts_input">門戶數量 <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="door_counts_input" name="door_counts" value="{{old('door_counts')}}"
            placeholder="門戶數量">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">新增</button>
    </div>
</form>
@endsection