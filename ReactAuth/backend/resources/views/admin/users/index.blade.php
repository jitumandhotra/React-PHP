@extends('admin/adminMaster')
@section('title', 'Users')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-10 mt-4">
            <div class="card">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        @if(count($users) > 0)
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User Name</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Change Role</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                                <th class="text-secondary opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            @if (is_null($user->profile_pic))
                                            <img src="{{ asset('/public/img/SuperAdminPic.png') }}" class="avatar avatar-sm me-3">
                                            @else
                                            <img src="{{ asset('storage/' .$user->profile_pic) }}" class="avatar avatar-sm me-3">
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">{{$user->name}}</h6>
                                            <p class="text-xs text-secondary mb-0">{{$user->email}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @foreach($user['roles'] as $roles)
                                    <p class="text-xs font-weight-bold mb-0">{{$roles->name}}</p>
                                    @endforeach
                                    <p class="text-xs text-secondary mb-0">Organization</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="badge badge-sm bg-gradient-success">
                                        @can('Manage Roles')
                                        <select class="roleSelect" name="role" userid='{{$user->id}}'>
                                            @foreach(roleDropdown() as $roleId => $roleName)
                                            @if($user->currentRole()->id)
                                            <option value="{{ $roleId }}" {{ $user->currentRole()->id == $roleId ? 'selected' : '' }}>{{ $roleName }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @endcan
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">{{$user->created_at->format('d/m/y')}}</span>
                                </td>
                                <td class="align-middle">
                                    <a href="javascript:;" userName="{{$user->name}}" userPhone="{{$user->telephone}}" userid='{{$user->id}}' class="editUser text-secondary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#updateUserModal">
                                        Edit
                                    </a>
                                    <a class="delete-role-btn btn btn-link text-danger text-gradient px-3 mb-0 deleteUser" userid='{{$user->id}}' href="javascript:;">
                                        <i class="far fa-trash-alt me-2" aria-hidden="true"></i>Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="updateUserModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-2">
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
                    <button type="button" class="btn-close text-danger" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="updateUserForm" role="form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="custId" name="userId" value="">
                    <div class="mb-3">
                        <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input id="phone" type="tel" placeholder="Phone" pattern="[0-9]*" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password"  autocomplete="new-password">
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Profile Image</label>
                        <input class="form-control @error('profile_pic') is-invalid @enderror" name="profile_pic" type="file" id="formFile" accept="image/*">
                        <div class="preview-profile-pic d-flex">
                            <img class="rounded-circle" id="imagePreview" src="" style="display: none; margin-top: 10px; max-width: 100px;">
                            <span id="removeImage" style="display: none; margin-top: 10px;">X</span>
                        </div>
                        @error('profile_pic')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" id="updateUser" class="btn bg-gradient-dark w-100 my-4 mb-2">Update</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>
<script>
    $('.roleSelect').change(function() {
        var roleId = $(this).val();
        var userId = $(this).attr('userid');
        var data = {
            _token: '{{ csrf_token() }}',
            _method: 'PUT',
            role_id: roleId,
            action: 'updateRole',
        };
        $.ajax({
            type: 'POST',
            url: '/users/' + userId,
            data: data,
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Handle error response
            }
        });
    });

    $('.editUser').click(function() {
        $('#custId').val($(this).attr('userid')), $('#name').val($(this).attr('userName'), $('#phone').val($(this).attr('userPhone')));
    });

    $('.deleteUser').click(function() {
        var userId = $(this).attr('userid');
        var data = {
            _token: '{{ csrf_token() }}',
            _method: 'DELETE',
        };
        $.ajax({
            type: 'POST',
            url: '/users/' + userId,
            data: data,
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Handle error response
            }
        });
    });

    let previousFile = null;

    $('#formFile').on('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            previousFile = file;
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result).show();
                $('#removeImage').show();
            };
            reader.readAsDataURL(file);
        } else if (previousFile) {
            // If no new file is selected, keep the previous file
            $('#formFile').prop('files', createFileList(previousFile));
            $('#imagePreview').show();
            $('#removeImage').show();
        } else {
            $('#imagePreview').hide();
            $('#removeImage').hide();
        }
    });

    $('#removeImage').on('click', function() {
        previousFile = null;
        $('#formFile').val('');
        $('#imagePreview').hide();
        $('#removeImage').hide();
    });

    // Helper function to create a FileList from a single file
    function createFileList(file) {
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        return dataTransfer.files;
    }


    $(document).ready(function() {
    $('#updateUserForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this); 
        formData.append('_token', '{{ csrf_token() }}'); 
        formData.append('_method', 'PUT'); 
        formData.append('action', 'updateUser'); 
        $.ajax({
            url: '/users/' + $('#custId').val(),
            type: 'POST', 
            data: formData,
            contentType: false, 
            processData: false,
            success: function(response) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});

</script>
@endsection