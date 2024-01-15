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
            <div class="card-header">Liệt kê blog</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
               <a href="{{ route('blog.create') }}" class="btn btn-success" style="margin: 5px">Thêm blog</a>
               <table class="table table-striped" id="myTable">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên blog</th>
                    <th>Slug</th>
                    <th>Mô tả</th>
                    <th>Hiển thị</th>
                    <th>Hình ảnh</th>
                    <th>Nội dung</th>
                    <th>Loại tin</th>
                    <th>Quản lý</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $key => $blog)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->slug }}</td>
                        <td>{{ $blog->description }}</td>
                        <td>{{ $blog->content }}</td>
                        <td>
                          @if ($blog->status==0)
                          Không hiển thị
                          @else
                           Hiển thị
                          @endif
                        </td>
                        <td>
                          @if ($blog->kind_of_blog=='huongdan')
                          Tin Hướng dẫn
                          @else
                          Blogs
                          @endif
                        </td>
                        <td><img src="{{ asset('uploads/blog/'.$blog->image) }}" height="100px" width="150px"></td>
                        <td>
                          <form action="{{ route('blog.destroy', $blog->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Bạn muốn xóa blog này không?')" class="btn btn-danger">
                              Delete
                            </button>
                          </form>
                          <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-warning">Update</a>
                        </td>
                      </tr> 
                    @endforeach
                </tbody>
               </table>
               {{-- {{ $blog->links('pagination::bootstrap-4') }} --}}
            </div>
        </div>
    </div>
</div>
@endsection