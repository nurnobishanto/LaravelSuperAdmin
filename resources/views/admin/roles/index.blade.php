@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Roles</h1>
            <a href="{{route('admin.roles.create')}}" class="btn btn-primary mt-2">Add New</a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="rolesList" class="table dataTable table-bordered table-striped">
                        <thead>
                        <tr>

                            <th>Name</th>
                            <th>Guard</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>

                                <td>{{$role->name}}</td>
                                <td>{{$role->guard_name}}</td>
                                <td>
                                    @foreach($role->permissions as $permission)
                                        <a class="btn btn-secondary m-1">{{$permission->name}}</a>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{route('admin.roles.show',['role'=>$role->id])}}" class="btn btn-info">View</a>
                                    <a href="{{route('admin.roles.edit',['role'=>$role->id])}}" class="btn btn-warning">Edit</a>
                                    <a href="" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>

                            <th>Name</th>
                            <th>Guard</th>
                            <th>Permissions</th>
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
            $("#rolesList").DataTable({
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
