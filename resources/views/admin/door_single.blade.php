@extends("admin.base")

@section("title", "紀錄列表")

@section('top-nav')
<ol class="breadcrumb my-auto mr-auto">
    <li class="breadcrumb-item"><a href="{{route('create-vendor')}}">廠商列表</a></li>
    <li class="breadcrumb-item"><a href="{{route('doors', [$vendor_id])}}">{{$vendor_name}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$door->name}}</li>
</ol>
<a href="/{{$door->URL}}" target="_blank">預覽</a>
@endsection

@section("content")
<div class="w-100 d-flex justify-content-between align-items-center">
    @if ($pages)
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
    @endif

    <button type="button" class="ml-auto btn btn-danger m-3" data-toggle="modal" data-target="#modal">
        刪除門戶
    </button>
</div>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">門戶名稱</th>
                <th scope="col">進入時間</th>
                <th scope="col">動作</th>
                <th scope="col">座標</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas_vendor as $key => $item)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>
                    {{$item->door->name}}
                </td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->action}}</td>
                <td>{{$item->lat}}, {{$item->lon}}</td>
            </tr>

            @endforeach

        </tbody>
    </table>
</div>




@endsection

<!-- Modal -->


@section("modal-title", "刪除門戶")

@section("modal-body")
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    @method('DELETE')

    <p>
        刪除後SEO就廢了，倘若沒有深仇大恨，請勿隨意刪除門戶！
    </p>
    <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">取消</button>
        <button type="submit" class="btn btn-danger">刪啦刪啦沒在怕的</button>
    </div>
</form>
@endsection