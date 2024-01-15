@extends('layouts.app')
@section('navbar')
<div class="container">
  @include('admin.include.navbar')
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">Liệt kê danh mục game</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
               <a href="{{ route('category.create') }}" class="btn btn-success" style="margin: 5px">Thêm danh mục game</a>
               <table class="table table-striped" id="myTable">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Slug danh mục</th>
                    <th>Mô tả</th>
                    <th>Hiển thị</th>
                    <th>Hình ảnh</th>
                    <th>Quản lý</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($category as $key => $cate)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $cate->title }}</td>
                        <td>{{ $cate->slug }}</td>
                        <td>{{ $cate->description }}</td>
                        <td>
                          @if ($cate->status==0)
                          Không hiển thị
                          @else
                           Hiển thị
                          @endif
                        </td>
                        <td><img src="{{ asset('uploads/category/'.$cate->image) }}" height="150px" width="150px"></td>
                        <td>
                          <form action="{{ route('category.destroy', $cate->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Bạn muốn danh mục game này không?')" class="btn btn-danger">
                              Delete
                            </button>
                          </form>
                          <a href="{{ route('category.edit', $cate->id) }}" class="btn btn-warning">Update</a>
                        </td>
                      </tr> 
                    @endforeach
                </tbody>
              </table>
              {{ $category->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection