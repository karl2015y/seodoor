@extends("admin.base")

@section("title", "門戶列表")

@section('top-nav')
    <ol class="breadcrumb my-auto mr-auto">
        <li class="breadcrumb-item"><a href="{{route('create-vendor')}}">廠商列表</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$vendor_name}}</li>
    </ol>
@endsection

@section("content")
<div style="    line-height: 2;">
    <span class="badge badge-primary">門戶數：{{$doors_count}}</span>
    <span class="badge badge-secondary">瀏覽數：{{$logs_data['all_count']}}</span>
    <span class="badge badge-success">轉換數：{{$logs_data['go_count'] + $logs_data['leave_count']}} ({{$logs_data['all_go_percent']}}%)</span>
    <span class="badge badge-danger">前往率：{{$logs_data['go_percent']}}%</span>
    <span class="badge badge-warning text-white">關閉率：{{$logs_data['leave_percent']}}%</span>
</div>
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
        新增門戶
    </button>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">門戶名稱</th>
                <th scope="col">瀏覽數</th>
                <th scope="col">轉換率</th>
                <th scope="col">前往率</th>
                <th scope="col">關閉率</th>
                <th scope="col">建立時間</th>
                <th scope="col">更新時間</th>
                <th scope="col">預覽</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas_vendor as $key => $item)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>
                    <a href="{{route('single-door', ['vendor_id'=>$vendor_id,'id' => $item->id])}}">{{$item->name}}</a>
                </td>
                <td>{{$item->logs_count}}</td>
                <td>{{$item->all_go_percent}}%</td>
                <td>{{$item->go_percent}}%</td>
                <td>{{$item->leave_percent}}%</td>
 
                <td>{{$item ->created_at}}</td>
                <td>{{$item ->updated_at}}</td>
                <td>
                    <a target="_blank" href="{{route('seodoor', ['URL' => $item->URL])}}">Go！</a>
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>
</div>




@endsection

<!-- Modal -->


@section("modal-title", "新增門戶")

@section("modal-body")
<form action="" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="name_input">門戶名稱 <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="name_input" name="name" value="{{old('name')}}"  placeholder="門戶名稱">
    </div>

    <div class="form-group">
        <label for="URL_input">自訂連結 <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="URL_input" name="URL" value="{{old('URL')}}"  placeholder="自訂連結 ex: good-pets-bag">
    </div>

    <div class="form-group">
        <label for="pic_input">圖片上傳 <span class="text-danger">*</span></label>
        <input type="file" class="form-control-file" id="pic_input" name="image">
    </div>

    <div class="form-group">
        <label for="pic_name_input">圖片說明 <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="pic_name_input"  name="pic_name" value="{{old('pic_name')}}" placeholder="圖片說明">
    </div>

    <div class="form-group">
        <label for="title_input">標題 <span class="text-danger">*</span></label>
        <textarea class="form-control" id="title_input" rows="3" name="title">{{old('title')}}</textarea>
    </div>

    <div class="form-group">
        <label for="content_input">內文 <span class="text-danger">*</span></label>
        <textarea class="form-control" id="content_input" rows="3" name="content">{{old('content')}}</textarea>
    </div>

    <div class="form-group">
        <label for="to_link_input">抵達連結 <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="to_link_input"  name="to_link" value="{{old('to_link')}}" placeholder="抵達頁">
    </div>



    <div class="form-group">
        <label for="note_input">備註</label>
        <textarea class="form-control" id="note_input" rows="3" name="note">{{old('note')}}</textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-primary">新增</button>
    </div>
</form>
@endsection