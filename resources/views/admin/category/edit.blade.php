@extends('layouts.app')
@section('navbar')
<div class="container">
  @include('admin.include.navbar')
</div>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="margin: 4px" class="card-header">Cập nhật danh mục game</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <a href="{{ route('category.index') }}" class="btn btn-success" style="margin: 5px">Liệt kê danh mục game</a>
                <a href="{{ route('category.create') }}" class="btn btn-success" style="margin: 5px">Thêm danh mục game</a>
                <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" value="{{ $category->title }}" class="form-control" placeholder="Điền tiêu đề" id="slug" onkeyup="ChangeToSlug()">
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input name="slug" type="text" value="{{ $category->slug }}" class="form-control" placeholder="Điền tiêu đề" id="convert_slug">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea style="resize: none" class="form-control" name="description" placeholder="Điền mô tả">{{ $category->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control-file" name="image">
                        <img src="{{ asset('uploads/category/'.$category->image) }}" height="150px" width="150px">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            @if ($category->status == 1)
                                <option value="1" selected>Hiển thị</option>
                                <option value="0" >Không hiển thị</option>
                            @else
                                <option value="1" >Hiển thị</option>
                                <option value="0" selected>Không hiển thị</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection