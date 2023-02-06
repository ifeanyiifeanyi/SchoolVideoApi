<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivationCode;
use Illuminate\Http\Request;

class ActivationCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codes = ActivationCode::latest()->get();
        return view('admin.codes.index', ['codes' => $codes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.codes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:activation_codes|min:10|max:10',
        ]);
        $code = new ActivationCode();
        $code->code = $request->input('code');
        $code->status = 0;
        $code->save();
        $notification = [
            'message'   => 'New Activation Created!',
            'alert-type' => 'success'
        ];
        return redirect()->route('activation')->with($notification);
    }

    



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ActivationCode::findOrFail($id)->delete();
        $notification = [
            'message'   => 'Activation Code Deleted!',
            'alert-type' => 'success'
        ];
        return redirect()->route('activation')->with($notification);
    }
}
