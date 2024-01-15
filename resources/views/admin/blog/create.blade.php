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
                <div style="margin: 4px" class="card-header">Liệt kê blog</div>
                
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
                <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title" type="text" class="form-control" placeholder="Điền tiêu đề" id="slug" onkeyup="ChangeToSlug()">
                        {{-- <small class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                     <div class="form-group">
                        <label>Slug</label>
                        <input name="slug" type="text" class="form-control" placeholder="..." id="convert_slug">
                        {{-- <small class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description</label>
                        <textarea style="resize: none" id="desc_blog" class="form-control" name="description" placeholder="Điền mô tả"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control-file" name="image">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea style="resize: none" id="content_blog" class="form-control" name="content" placeholder="Điền nội dung"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1" selected>Hiển thị</option>
                            <option value="0">Không hiển thị</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại tin</label>
                        <select class="form-control" name="kind_of_blog">
                            <option value="blogs" selected>Blogs</option>
                            <option value="huongdan">Hướng dẫn</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection