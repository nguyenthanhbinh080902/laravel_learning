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
            <div class="card-header">Liệt kê slider</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
               <a href="{{ route('slider.create') }}" class="btn btn-success" style="margin: 5px">Thêm Slider</a>
               <table class="table table-striped" id="myTable">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Hiển thị</th>
                    <th>Hình ảnh</th>
                    <th>Quản lý</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($slider as $key => $slid)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $slid->title }}</td>
                        <td>{{ $slid->description }}</td>
                        <td>
                          @if ($slid->status==0)
                          Không hiển thị
                          @else
                           Hiển thị
                          @endif
                        </td>
                        <td><img src="{{ asset('uploads/slider/'.$slid->image) }}" height="150px" width="350px"></td>
                        <td>
                          <form action="{{ route('slider.destroy', $slid->id) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button onclick="return confirm('Bạn muốn slider này không?')" class="btn btn-danger">
                              Delete
                            </button>
                          </form>
                          <a href="{{ route('slider.edit', $slid->id) }}" class="btn btn-warning">Update</a>
                        </td>
                      </tr> 
                    @endforeach
                </tbody>
               </table>
               {{ $slider->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection