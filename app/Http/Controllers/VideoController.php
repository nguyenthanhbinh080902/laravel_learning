<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::orderBy('id', 'DESC')->paginate(5);
        return view('admin.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:videos|max:255',
            
            'description' => 'required|max:255',

            'slug' => 'required|unique:videos|max:200',
            
            'link' => 'required|max:500',

            'status' => 'required',
            
            'image' => 'required|max:255',
        ],
        [
            'title.unique' => 'Tên videos đã có, xin vui lòng điền tên khác',
            'title.required' => 'Chưa điền videos',
            'slug.unique' => 'Tên slug danh mục video đã có, xin vui lòng điền tên khác',
            'slug.required' => 'Chưa slug điền danh mục video',
            'description.required' => 'Chưa điền videos',
            'link.required' => 'Chưa điền link cho video',
            'image.required' => 'Chưa chọn hình ảnh game',
        ]);

        $videos = new Video();
        $videos->title = $data['title'];
        $videos->description = $data['description'];
        $videos->slug = $data['slug'];
        $videos->status = $data['status'];
        $videos->link = $data['link'];
        
        // thêm ảnh vào folder 
        $get_image = $request->image;
        $path = 'uploads/video/';
        $get_name_image = $get_image->getClientOriginalName(); // hinh123.jpg
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $videos->image = $new_image;
        $videos->save();
        return redirect()->route('video.index')->with('status', 'Thêm video thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $videos = Video::find($id);
        return view('admin.video.edit', compact('videos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'title' => 'required|max:255',
                'description' => 'required|max:200',
                'slug' => 'required|max:200',
                'link' => 'required|max:500',
                'status' => 'required',
            ],
            [
                'description.required' => 'Chưa điền mô tả video', 
                'title.required' => 'Chưa điền tên video',
                'link.required' => 'Chưa điền video mới',
                'slug.required' => 'Chưa điền tên slug video mới',
            ]
        );

        $videos = Video::find($id);
        $videos->title = $data['title'];
        $videos->description = $data['description'];
        $videos->slug = $data['slug'];
        $videos->link = $data['link'];
        $videos->status = $data['status'];

        // thêm ảnh vào folder 
        $get_image = $request->image;
        if($get_image){
            // Xóa hình ảnh cũ
            $path_unlink = 'uploads/video/'.$videos->image;
            if (file_exists($path_unlink)){
                unlink($path_unlink);
            }
            // Thêm mới
            $path = 'uploads/video';
            $get_name_image = $get_image->getClientOriginalName(); // hinh123.jpg
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $videos->image = $new_image;
        }

        $videos->save();
        return redirect()->route('video.index')->with('status', 'Cập nhật video thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $videos = Video::find($id);
        $path_unlink = 'uploads/video/'.$videos->image;
        if (file_exists($path_unlink)){
            unlink($path_unlink);
        }
        $videos->delete();
        return redirect()->with('status', 'Xóa videos thành công');
    }
}
