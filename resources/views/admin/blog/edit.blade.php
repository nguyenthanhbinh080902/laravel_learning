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
                <div style="margin: 4px" class="card-header">Cập nhật blog</div>
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
                <a href="{{ route('blog.index') }}" class="btn btn-success" style="margin: 5px">Liệt kê blog</a>
                <a href="{{ route('blog.create') }}" class="btn btn-success" style="margin: 5px">Thêm blog</a>
                <form action="{{ route('blog.update', $blogs->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" value="{{ $blogs->title }}" class="form-control" placeholder="Điền tiêu đề" id="slug" onkeyup="ChangeToSlug()">
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input name="slug" type="text" value="{{ $blogs->slug }}" class="form-control" placeholder="Điền slug " id="convert_slug">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea style="resize: none" class="form-control" id="desc_blog" name="description" placeholder="Điền mô tả">{{ $blogs->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control-file" name="image">
                        <img src="{{ asset('uploads/blog/'.$blogs->image) }}" height="150px" width="150px">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea style="resize: none" class="form-control" id="content_blog" name="content" placeholder="Điền mô tả">{{ $blogs->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            @if ($blogs->status == 1)
                                <option value="1" selected>Hiển thị</option>
                                <option value="0" >Không hiển thị</option>
                            @else
                                <option value="1" >Hiển thị</option>
                                <option value="0" selected>Không hiển thị</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại tin</label>
                        <select class="form-control" name="kind_of_blog">
                            @if ($blogs->kind_of_blog == 1)
                                <option value="blogs" selected>Blogs</option>
                                <option value="huongdan" >Hướng dẫn</option>
                            @else
                                <option value="blogs" >Blogs</option>
                                <option value="huongdan" selected>Hướng dẫn</option>
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