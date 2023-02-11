@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Users</h1>
            <a href="{{route('admin.users.create')}}" class="btn btn-primary mt-2">Add New</a>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="userList" class="table dataTable table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>Photo</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <a class="btn btn-secondary">{{$role->name}}</a>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{route('admin.users.show',['user'=>$user->id])}}" class="btn btn-info">View</a>
                                <a href="{{route('admin.users.edit',['user'=>$user->id])}}" class="btn btn-warning">Edit</a>
                                <a href="{{route('admin.users.destroy',['user'=>$user->id])}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
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
           $("#userList").DataTable({
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
