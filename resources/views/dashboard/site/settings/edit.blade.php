@extends('dashboard.core.app')
@section('title', __('dashboard.Account_Settings'))
@section('content')
    <style>
        .input-group {
            margin-bottom: 20px;
            /* Adjust the margin value as needed */
        }
        .image-container{
            position: relative
        }

        .pen-icon {
            background: none;
            border-left: none;
        }
        .pen-icon-image{
            position: absolute;
            bottom: 0.5rem;
            left: 6rem;
        }
        .image-container img {
            width: 150px;
            /* Adjust the width to your desired size */
            height: 150px;
            /* Adjust the height to your desired size */
        }

        .col-md-6 {
            position: relative;
        }

        .line-after::before {
            content: "";
            position: absolute;
            top: 0;
            left: 100%;
            height: 100%;
            width: 1px;
            background-color: #ccc;
            /* Adjust the color as needed */
        }

        .card {
            background-color: transparent;
            box-shadow: none
        }

        .pin-input {
            width: 20%;
            text-align: center;
        }

        .pin-group {
            display: flex;
            justify-content: space-between;
        }

        .pin-title {
            float: none;
        }
    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <label class="card-title">@lang('dashboard.Account_Settings')</label>
                        </div>
                        <form action="{{ route('settings.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @method('put') @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Default box -->
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label class="card-title">@lang('dashboard.General_Info')</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="image-container">
                                                                <img class="profile-user-img img-fluid img-circle"
                                                                    id="profileImage" src="{{ $user->image?$user->image:asset('img/NiImage.jpg') }}"
                                                                    alt="Profile Image" class="img-fluid img-responsive">
                                                                <span class="pen-icon pen-icon-image">
                                                                    <i class="fas fa-pen"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <input type="file" name="image" id="profileImageInput"
                                                            style="display: none;">

                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        name="name" value="{{ $user->name }}"
                                                                        id="firstName" placeholder="name">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text pen-icon no-bg">
                                                                            <i class="fas fa-pen"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        name="phone_number" id="firstName"
                                                                        value="{{ $user->phone_number }}"
                                                                        placeholder="phone number">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text pen-icon no-bg">
                                                                            <i class="fas fa-pen"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control"
                                                                        id="firstName" name="email"
                                                                        value="{{ $user->email }}" placeholder="email">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text pen-icon no-bg">
                                                                            <i class="fas fa-pen"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <select class="form-control" name="current_status">
                                                                        <option
                                                                            {{ $user->current_status == 'OFFLINE' ? 'selected' : '' }}
                                                                            value="OFFLINE">
                                                                            OFFLINE
                                                                        </option>
                                                                        <option
                                                                            {{ $user->current_status == 'ONLINE' ? 'selected' : '' }}
                                                                            value="ONLINE">
                                                                            ONLINE
                                                                        </option>
                                                                        <option
                                                                            {{ $user->current_status == 'IN MEETING' ? 'selected' : '' }}
                                                                            value="IN MEETING">
                                                                            IN MEETING
                                                                        </option>
                                                                        <option
                                                                            {{ $user->current_status == 'OUT SICK' ? 'selected' : '' }}
                                                                            value="OUT SICK">
                                                                            OUT SICK
                                                                        </option>
                                                                        <option
                                                                            {{ $user->current_status == 'REMOTELY' ? 'selected' : '' }}
                                                                            value="REMOTELY">
                                                                            REMOTELY
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 text-right">
                                                                <button type="submit" class="btn btn-view">Save
                                                                    Changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 line-after">
                                <h6>Change Passwords</h6>
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('update.password') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <div class="input-group mb-3">
                                                <input name="old_password" type="password" class="form-control"
                                                    placeholder="@lang('dashboard.Current_Password')">
                                            </div>
                                            <div class="input-group mb-3">
                                                <input name="new_password" type="password" class="form-control"
                                                    placeholder="@lang('dashboard.New_Password')">
                                            </div>
                                            <div class="input-group mb-3">
                                                <input name="new_password_confirmation" type="password"
                                                    class="form-control" placeholder="@lang('dashboard.Confirm_New_Password')">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn btn-view">Save Changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>@lang('dashboard.Change_Phone_Number')</h6>
                                <div class="card">

                                    <div class="card-body">
                                        <div class="input-group mb-3">
                                            <form action="" class="w-100">
                                                <input name="" type="" class="w-100 form-control" id="hideInput"
                                                placeholder="@lang('dashboard.New_Phone_Number')">
                                                <button type="submit" class="btn btn-view mt-4 w-100" onclick="showPinCode(event)">Verify</button>
                                                <div class="card d-none" id='pinCode'>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12 text-center">
                                                                <h6 class="card-title pin-title">@lang('dashboard.Pin_Code')</h6>
                                                            </div>
                                                        </div>
                                                        <form>
                                                            <div class="form-group pin-group">
                                                                <input type="text" class="form-control pin-input"
                                                                    id="pin1" name="pin1" maxlength="1" required>
                                                                <input type="text" class="form-control pin-input"
                                                                    id="pin2" name="pin2" maxlength="1" required>
                                                                <input type="text" class="form-control pin-input"
                                                                    id="pin3" name="pin3" maxlength="1" required>
                                                                <input type="text" class="form-control pin-input"
                                                                    id="pin4" name="pin4" maxlength="1" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-view">Verify</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                <!-- /.card -->
            </div>
        </div>
        <!-- /.card-body -->
        </section>



    <script>
        $(document).ready(function() {
            // Handle file input change event
            $("#profileImageInput").change(function() {
                var inputFile = $(this)[0];
                if (inputFile.files && inputFile.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $("#profileImage").attr("src", e.target.result);
                    };

                    reader.readAsDataURL(inputFile.files[0]);
                }
            });

            // Trigger file input click when clicking on the image container
            $(".image-container").click(function() {
                $("#profileImageInput").click();
            });
        });
        function showPinCode(event){
            event.srcElement.classList.add('d-none')
            var pinCode = document.getElementById('pinCode').classList.remove('d-none')
            var pinCode = document.getElementById('hideInput').classList.add('d-none')
            var pinCode = document.getElementById('hideInput').classList.remove('d-block')
        }
    </script>

@endsection
