@extends('adminlte::page')

@section('title', 'Permissions')

@section('content_header')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Permissions</h1>
        <a href="{{route('admin.permissions.create')}}" class="btn btn-primary mt-2">Add New</a>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Permissions</li>
        </ol>

    </div>
</div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <table id="permissionsList" class="table dataTable table-bordered table-striped">
                        <thead>
                        <tr>

                            <th>Permission Name</th>
                            <th>Guard</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>

                                <td>{{$permission->name}}</td>
                                <td>{{$permission->guard_name}} </td>

                                <th>
                                    @foreach($permission->roles as $role)
                                        {{$role->name}}
                                    @endforeach
                                </th>
                                <td>
                                    <a href="{{route('admin.permissions.show',['permission'=>$permission->id])}}" class="btn btn-info">View</a>
                                    <a href="{{route('admin.permissions.edit',['permission'=>$permission->id])}}" class="btn btn-warning">Edit</a>
                                    <a href="{{route('admin.permissions.destroy',['permission'=>$permission->id])}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>

                            <th>Permission Name</th>
                            <th>Guard</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('plugins.datatablesPlugins', true)
@section('plugins.Datatables', true)


@section('css')

@stop

@section('js')

    <script>
        $(function () {
            $("#permissionsList").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "paging": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@stop
