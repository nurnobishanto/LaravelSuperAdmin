@extends('adminlte::page')

@section('title', 'View Role')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>View Role - {{$role->name}}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Update Role</li>
            </ol>

        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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

                            <label for="name">Name</label>
                            <input name="name" value="{{$role->name}}" type="text" disabled required class="form-control" id="name" placeholder="Enter Role Name">
                        </div>
                        <div class="form-group">
                            <label for="guard">Guard</label>
                            <input type="text" name="guard_name" value="{{$role->guard_name}}" disabled required value="web" class="form-control" id="guard" placeholder="Enter Role Guard Name">
                        </div>
                        <h4>Permissions</h4>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" disabled id="select_all"
                                   {{(\App\Models\User::checkRolePermissions($role,$permissions)?'checked':'')}}
                                   value="All">
                            <label for="select_all" class="custom-control-label">All Select</label>
                        </div>
                        <hr>
                        <div class="form-group row permissions">
                            @foreach($permissions_groups as $permission_group)
                                <div class="custom-control custom-checkbox col-md-6 ">
                                    <input class="custom-control-input" type="checkbox" disabled id="group_{{$permission_group->group_name}}_id"
                                           {{(\App\Models\User::checkRolePermissions($role,$permissions->where('group_name',$permission_group->group_name))?'checked':'')}}
                                           onclick="checkPermissionByGroup('group_{{$permission_group->group_name}}_id','group_{{$permission_group->group_name}}_class',{{count($permissions)}},{{count($permissions_groups)}})" value="{{$permission_group->group_name}}">
                                    <label for="group_{{$permission_group->group_name}}_id" class="custom-control-label">{{$permission_group->group_name}}</label>
                                    @foreach($permissions->where('group_name',$permission_group->group_name) as $permission)
                                        <div class="custom-control custom-checkbox group_{{$permission_group->group_name}}_class">
                                            <input class="custom-control-input" type="checkbox" disabled id="permission.{{$permission->id}}"
                                                   {{($role->hasPermissionTo($permission))?'checked':''}}
                                                   onclick="checkSinglePermission('group_{{$permission_group->group_name}}_id','group_{{$permission_group->group_name}}_class',{{count($permissions->where('group_name',$permission_group->group_name))}},{{count($permissions)}},{{count($permissions_groups)}})" name="permissions[]" value="{{$permission->name}}">
                                            <label for="permission.{{$permission->id}}" class="custom-control-label">{{$permission->name}}</label>
                                        </div>

                                    @endforeach
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{route('admin.roles.index')}}" class="btn btn-success" >Go Back</a>

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
        function checkSinglePermission(idName, className,inGroupCount,total,groupCount) {
            if($('.'+className+' input:checked').length === inGroupCount){
                $('#'+idName).prop('checked',true);
            }else {
                $('#'+idName).prop('checked',false);
            }
            if($('.permissions input:checked').length === total+groupCount){
                $('#select_all').prop('checked',true);
            }else {
                $('#select_all').prop('checked',false);
            }
        }

        function checkPermissionByGroup(idName, className,total,groupCount) {
            if($('#'+idName).is(':checked')){
                $('.'+className+' input').prop('checked',true);
            }else {
                $('.'+className+' input').prop('checked',false);
            }
            if($('.permissions input:checked').length === total+groupCount){
                $('#select_all').prop('checked',true);
            }else {
                $('#select_all').prop('checked',false);
            }
        }

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
