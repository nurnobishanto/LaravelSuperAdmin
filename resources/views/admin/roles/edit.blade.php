@extends('adminlte::page')

@section('title', 'Role')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Role</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Edit Role</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.permissions.store')}}" method="POST">
                        @csrf
                        @if (count($errors) > 0)
                            <div class = "alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">

                            <label for="name">Name {{$role->name}}</label>
                            <input name="name" type="text" required class="form-control" id="name" value="{{$role->name}}" placeholder="Enter Role Name">
                        </div>
                        <div class="form-group">
                            <label for="guard">Guard</label>
                            <input type="text" name="guard_name" required value="web" class="form-control" id="guard" placeholder="Enter Role Guard Name">
                        </div>
                        <h4>Permissions</h4>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="select_all"  value="All">
                            <label for="select_all" class="custom-control-label">All Select</label>
                        </div>
                        <hr>
                        <div class="form-group row">
                            @foreach($permissions_groups as $permission_group)
                                <div class="custom-control custom-checkbox col-md-6 ">
                                    <input class="custom-control-input" type="checkbox" id="group.{{$permission_group->group_name}}" value="{{$permission_group->group_name}}">
                                    <label for="group.{{$permission_group->group_name}}" class="custom-control-label">{{$permission_group->group_name}}</label>
                                    @foreach($permissions->where('group_name',$permission_group->group_name) as $permission)
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="permission.{{$permission->name}}" name="permission.{{$permission->name}}" value="{{$permission->name}}" <?php if($role->hasPermissionTo($permission->name)){echo "checked";}?>>
                                            <label for="permission.{{$permission->name}}" class="custom-control-label">{{$permission->name}}</label>
                                        </div>

                                    @endforeach
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                        <button class="btn btn-primary" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('toastr',true)
@section('css')

@stop

@section('js')
    <script>
        $('#select_all').click(function(event) {
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });


    </script>


@stop
