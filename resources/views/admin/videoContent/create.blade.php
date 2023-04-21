@extends('admin.layouts.admin')

@section('title', 'Create Video Content')

@section('css')

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
                <div class="col-md-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="{{ route('video.store') }}" enctype="multipart/form-data" id="storeVideo">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col md-6">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title" value="{{ old('title') }}">
                                            @error('title')
                                            <div class="container text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="category_id" style="width: 100%;">
                                                <option>Select Category</option>
                                                @if($categories->count())
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ ucwords($category->category) }}
                                                </option>
                                                @endforeach
                                                @else
                                                <li>Unavailable</li>
                                                @endif
                                            </select>
                                            @error('category')
                                            <div class="container text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="duration">Duration</label>
                                    <input type="text" name="duration" class="form-control" id="duration" placeholder="Enter Duration">
                                    @error('duration')
                                    <div class="container text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="thumbnail">Thumbnail</label>
                                            <div>
                                                <div class="">
                                                    <input type="file" name="thumbnail" class="form-control" id="thumbnail">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{ asset('waiter.svg') }}" class="img-fluid" alt="" srcset="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="video">Video Content</label>
                                            <div class="">
                                                <input type="file" name="video" class="form-control" id="video">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{ asset('waiter.svg') }}" class="img-fluid" alt="" srcset="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Video Description</label>
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                                </div>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="status">
                                    <label class="form-check-label text-secondary" for="status">Status (Check to make Video available for view)</label>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" id="btn1" style="width:100% !important" class="btn btn-primary text-center">Submit</button>
                            </div>
                        </form>
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
<script>
    $.ajaxSetup({
        header: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        $("#storeVideo").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action')
                , method: $(this).attr('method')
                , data: new FormData(this)
                , processData: false
                , dataType: 'json'
                , contentType: false
                , beforeSend: function() {
                    $('#btn1').html('<i class="fas fa-cog fa-spin"></i> <span class="l">Loading</span>');
                    $('#btn1').attr("disabled", true);
                }
                , success: function(res) {
                    console.log(res);
                    let data = res.error;
                    if (data) {
                        $('#btn1').html('Save');
                        $('#btn1').attr("disabled", false);
                        $.each(data, function(index, value) {
                            toastr.error(value);
                        });
                        return false;
                    }
                    if (res.success) {
                        $('#storeVideo').trigger("reset");
                        $('#btn1').html('Save');
                        $('#btn1').attr("disabled", false);
                        Swal.fire(
                            'Created'
                            , 'Content upload was successful'
                            , 'success'
                        );
                        setTimeout(function() {
                            $('#storeVideo').trigger("reset");
                            $('#btn1').html('Save');
                            $('#btn1').attr("disabled", false);
                            window.location.href = "{{ route('video') }}";
                        }, 3000);
                    }

                }
            , })
        })
    })

</script>
@endsection
