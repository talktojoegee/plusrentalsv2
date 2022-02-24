@php
    $serial = 1;
@endphp
@foreach($roles as $role)
    <tr>
        <td>{{$serial++}}</td>
        <td>{{$role->name ?? ''}}</td>
        <td>{{!is_null($role->created_at) ? date('d M, Y', strtotime($role->created_at)) : '-' }}</td>
        <td>
            <button data-toggle="modal" data-target="#default-Modal_{{$role->id}}" class="btn btn-primary btn-mini"><i class="ti-eye mr-2"></i></button>
            <div class="modal fade" id="default-Modal_{{$role->id}}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{$role->name ?? ''}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('edit-role')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Role Name</label>
                                    <input type="text" name="role" value="{{$role->name ?? ''}}" class="form-control">
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 d-flex justify-content-end">
                                        <div class="btn-group">
                                            <input type="hidden" name="roleId" value="{{$role->id}}">
                                            <button type="button" class="btn btn-default waves-effect btn-mini " data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary waves-effect btn-mini waves-light ">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
@endforeach
