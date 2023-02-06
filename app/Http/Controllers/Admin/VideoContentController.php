<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VideoContent;
use Illuminate\Support\Facades\Validator;

class VideoContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.videoContent.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();
        return view('admin.videoContent.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title'         => 'required|string|unique:video_contents|min:2|max:199',
            'category_id'   => 'required',
            'duration'      => 'required|string',
            'description'   => 'required|min:5|max:255',
            'video'         => 'required|file|mimes:mp4,ogx,oga,ogv,ogg,webm|max:100000',
            'thumbnail'     => 'required|image|mimes:jpeg, png, jpg, webp, svg|max:9048'
        ]);
        if ($validation->fails()) {
            return response()->json([
                'error' => $validation->errors()->messages()
            ]);
        }
        $video_uploads = new VideoContent();

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $ext = $video->getClientOriginalExtension();
            $video_file = time() .".".$ext;
            $video->move('uploads/videos/', $video_file);
            $video_uploads->video = 'uploads/videos/'.$video_file;
        }

        if($request->hasFile('thumbnail')){
            $thumb = $request->file('thumbnail');
            $extension = $thumb->getClientOriginalExtension();
            $thumb_file = time(). ".".$extension;
            $thumb->move('uploads/thumbnails/', $thumb_file);
            $video_uploads->thumbnail = 'uploads/thumbnails/'.$thumb_file;
        }

        $video_uploads->title       = $request->title;
        $video_uploads->category_id = $request->category_id;
        $video_uploads->views = 0;
        $video_uploads->likes = 0;
        $video_uploads->duration = $request->duration;
        $video_uploads->description = $request->description;
        $video_uploads->status = $request->status ? 1 : 0;
        $video_uploads->save();

        return response()->json([
            'success' => true,
            'status'  => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
