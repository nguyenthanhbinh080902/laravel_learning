<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'DESC')->paginate(5);
        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:blogs|max:255',
            
            'description' => 'required',

            'slug' => 'required',

            'content' => 'required',
            
            'image' => 'required|image|mimes:jpg,png,gif,svg|max:2048
            |dimensions:min_width=100, min_height=100, max_width=2000, max_height=2000',
            
            'status' => 'required',

            'kind_of_blog' => 'required',
        ],
        [
            'title.unique' => 'Tên danh mục blogs đã có, xin vui lòng điền tên khác',
            'title.required' => 'Chưa điền danh mục blogs',
            'slug.required' => 'Chưa điền slug cho blogs',
            'content.required' => 'Chưa điền nội dung blogs',
            'description.required' => 'Chưa điền mô tả blogs',
            'image.required' => 'Chưa chọn hình ảnh blogs',
        ]);

        $blogs = new Blog();
        $blogs->title = $data['title'];
        $blogs->slug = $data['slug'];
        $blogs->content = $data['content'];
        $blogs->description = $data['description'];
        $blogs->status = $data['status'];
        $blogs->kind_of_blog = $data['kind_of_blog'];

        // thêm ảnh vào folder 
        $get_image = $request->image;
        $path = 'uploads/blog/';
        $get_name_image = $get_image->getClientOriginalName(); // hinh123.jpg
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $blogs->image = $new_image;
        $blogs->save();
        return redirect()->route('blog.index')->with('status', 'Thêm blogs thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blogs = Blog::find($id);
        return view('admin.blog.edit', compact('blogs')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'title' => 'required|max:255',
                'slug' => 'required',
                'description' => 'required',
                'content' => 'required',
                'status' => 'required',
                'status' => 'required'
            ],
            [
                'description.required' => 'Chưa điền mô tả blogs mới', 
                'content.required' => 'Chưa điền nội dung blogs mới', 
                'title.required' => 'Chưa điền tên blogs mới',
                'slug.required' => 'Chưa điền slug cho blogs mới'
            ]
        );

        $blogs = Blog::find($id);
        $blogs->title = $data['title'];
        $blogs->slug = $data['slug'];
        $blogs->description = $data['description'];
        $blogs->content = $data['content'];
        $blogs->status = $data['status'];
        $blogs->kind_of_blog = $data['kind_of_blog'];

        // thêm ảnh vào folder 
        $get_image = $request->image;
        if($get_image){
            // Xóa hình ảnh cũ
            $path_unlink = 'uploads/blog/'.$blogs->image;
            if (file_exists($path_unlink)){
                unlink($path_unlink);
            }
            // Thêm mới
            $path = 'uploads/blog/';
            $get_name_image = $get_image->getClientOriginalName(); // hinh123.jpg
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $blogs->image = $new_image;
        }
        $blogs->save();
        return redirect()->route('blog.index')->with('status', 'Cập nhật danh mục blogs thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blogs = Blog::find($id);
        $path_unlink = 'uploads/blog/'.$blogs->image;
        if (file_exists($path_unlink)){
            unlink($path_unlink);
        }
        $blogs->delete();
        return redirect()->back();
    }
}
