<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VideoContent;

class MediaController extends Controller
{
    public function all_videos(){
        $videos = VideoContent::with('category')
        ->where('status', 1)
        ->latest()
        ->get();
        if(!empty($videos)){
            
            return response()->json([
                'status' => 200,
                'videos' => $videos
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Try again later'
            ]);
        }
    }
}
