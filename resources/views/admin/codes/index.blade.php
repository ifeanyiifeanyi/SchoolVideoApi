@extends('admin.layouts.admin')

@section('css')

@endsection

@section('title', 'All Codes')
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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="ids" id="ids" class="all_ids"></th>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><input type="checkbox" name="ids" id="ids"></td>
                                    <td>1</td>
                                    <td>WinXPSP2</td>
                                    <td>Active</td>
                                    <td>Delete</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="ids" id="ids"></td>
                                    <td>1</td>
                                    <td>WinXPSP2</td>
                                    <td>Active</td>
                                    <td>Delete</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="ids" id="ids"></td>
                                    <td>1</td>
                                    <td>WinXPSP2</td>
                                    <td>Active</td>
                                    <td>Delete</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="ids" id="ids"></td>
                                    <td>1</td>
                                    <td>WinXPSP2</td>
                                    <td>Active</td>
                                    <td>Delete</td>
                                </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
@endsection
@section('js')
<script>
    document.querySelector('.all_ids').addEventListener('change', function () {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = this.checked;
        }, this);
    });
</script>

<script>
    $(function() {
        $(document).on('click', '#delete', function(e) {
            e.preventDefault();
            var link = $(this).data("id");
            console.log({
                link
            });

            Swal.fire({
                title: 'Are you sure?'
                , text: "You won't be able to revert this!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    if ($("#delete").submit()) {
                        Swal.fire(
                            'Deleted!'
                            , 'Category deleted.'
                            , 'success'
                        )
                    }
                }
            })
        })

    })

</script>
@endsection