<?php

namespace App\Http\Controllers\Admin;

use App\Models\Categories;
use App\Models\VideoContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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
        $videos = VideoContent::latest()->get();
        return view('admin.videoContent.index', ['videos' => $videos]);
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
        $video = VideoContent::findOrFail($id);
        return view('admin.videoContent.show', ['video' => $video]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = VideoContent::findOrFail($id);
        $categories = Categories::all();
        return view('admin.videoContent.edit', ['video' => $video, 'categories' => $categories]);
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
        $validation = Validator::make($request->all(), [
            'title'         => 'required|string|min:2|max:199',
            'category_id'   => 'required',
            'duration'      => 'required|string',
            'description'   => 'required|min:5|max:255',
            'video'         => 'nullable|file|mimes:mp4,ogx,oga,ogv,ogg,webm|max:100000',
            'thumbnail'     => 'nullable|image|mimes:jpeg, png, jpg, webp, svg|max:9048'
        ]);
        if ($validation->fails()) {
            return response()->json([
                'error' => $validation->errors()->messages()
            ]);
        }
        $video_uploads = VideoContent::findOrFail($id);
        if($request->hasFile('thumbnail')){
            $old_thumbnail = $video_uploads->thumbnail;
            if (File::exits($old_thumbnail)) {
                File::delete($old_thumbnail);
            }
            $thumb = $request->file('thumbnail');
            $extension = $thumb->getClientOriginalExtension();
            $thumb_file = time(). ".".$extension;
            $thumb->move('uploads/thumbnails/', $thumb_file);
            $video_uploads->thumbnail = 'uploads/thumbnails/'.$thumb_file;
        }
        if ($request->hasFile('video')) {
            $old_video = $video_uploads->video;
            if (File::exits($old_video)) {
                File::delete($old_video);
            }
            $video = $request->file('video');
            $ext = $video->getClientOriginalExtension();
            $video_file = time() .".".$ext;
            $video->move('uploads/videos/', $video_file);
            $video_uploads->video = 'uploads/videos/'.$video_file;
        }
        $video_uploads->title       = $request->title;
        $video_uploads->category_id = $request->category_id;
        $video_uploads->views = 0;
        $video_uploads->likes = 0;
        $video_uploads->duration = $request->duration;
        $video_uploads->description = $request->description;
        $video_uploads->status = $request->status ? 1 : 0;
        $video_uploads->update();

        return response()->json([
            'success' => true,
            'status'  => 200
        ]);
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
