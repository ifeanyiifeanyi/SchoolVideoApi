@extends('admin.layouts.admin')

@section('title', 'View Video Content')

@section('css')
<style>
    input{
        padding:30px !important;
        border:none !important;
    }
    textarea{
        border:none !important;
    }
</style>
@endsection

@section('adminContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('title')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="card card-secondary">
                   
                            <div class="card-body">
                                <div class="row">
                                    <div class="col md-6">
                                        <div class="form-group">
                                            <label for="">Title</label>
                                            <input type="text" disabled class="form-control" value="{{ $video->title }}">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <input type="text" disabled class="form-control" value="{{ $video->category->category }}">
                                           
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Duration</label>
                                    <input type="text" disabled class="form-control"
                                        value="{{ $video->duration }}">
                                  
                                </div>
                                <div class="row">
                                   
                                    <div class="col-md-6">
                                        <img src="{{ asset($video->thumbnail) }}" width="200px" height="200px" class="img-fluid img-thumbnail" alt="" srcset="">
                                    </div>
                                    <div class="col-md-6">
                                        <video width="400px" height="400px" src="{{ asset($video->video) }}" class="mt-4 img-fluid" controls></video>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="description">Video Description</label>
                                    <textarea disabled cols="30" rows="5" class="form-control">{{ $video->description }}</textarea>
                                </div>
                               
                                <div class="form-group">
                                    <h4>Status :: <button class="btn btn-primary">{{ $video->status == 1 ? 'Active' : 'Draft' }} </button></h4>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection

@section('js')

</script>
@endsection