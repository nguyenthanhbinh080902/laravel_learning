@extends('layouts.app')
@section('navbar')
<div class="container">
  @include('admin.include.navbar')
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-11">
        <div class="card">
            <div class="card-header">Liệt kê video</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
               <a href="{{ route('video.create') }}" class="btn btn-success" style="margin: 5px">Thêm video</a>
               <table class="table table-striped" id="myTable">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Slug video</th>
                    <th>Hiển thị</th>
                    <th>Đường dẫn</th>
                    <th>Hình ảnh</th>
                    <th>Quản lý</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $key => $video)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $video->title }}</td>
                        <td>{{ $video->description }}</td>
                        <td>{{ $video->slug }}</td>
                        <td>
                          @if ($video->status==0)
                          Không hiển thị
                          @else
                           Hiển thị 
                          @endif
                        </td>
                        <td><span style="height: 100px; width: 130px">{!!$video->link!!}</span></td>
                        <td><img src="{{ asset('uploads/video/'.$video->image) }}" height="150px" width="200px"></td>
                        <td>
                          <form action="{{ route('video.destroy', $video->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Bạn muốn video này không?')" class="btn btn-danger">
                              Delete
                            </button>
                          </form>
                          <a href="{{ route('video.edit', $video->id) }}" class="btn btn-warning">Update</a>
                        </td>
                      </tr> 
                    @endforeach
                </tbody>
               </table>
               {{ $videos->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection