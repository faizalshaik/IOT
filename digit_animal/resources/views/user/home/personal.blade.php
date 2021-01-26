<div class="panel panel-border panel-primary m-t-15" id="personal-panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="ti-settings fa-lg"></i> Personal Info</h3>
    </div>
    <div class="panel-body" style="padding:4px !important;">
        <ul class="nav nav-tabs tabs" style="width: 100%;">
            <li class="tab active" style="width: 25%;">
                <a href="#personal_info" data-toggle="tab" aria-expanded="true" class="active">
                    <span class="visible-xs"><i class="fa fa-user-circle"></i></span>
                    <span class="hidden-xs">Profile</span>
                </a>
            </li>
            <li class="tab" style="width: 25%;">
                <a href="#personal_pwd" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-key"></i></span>
                    <span class="hidden-xs">Password</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="personal_info">
                <table class="table m-0">
                    <!-- <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                        </tr>
                    </thead> -->
                    <tbody>
                        <tr>
                            <th scope="row"><i class="fa fa-user-circle"></i></th>
                            <td>Name</td>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fa fa-user-circle"></i></th>
                            <td>Surname</td>
                            <td>{{$user->surname}}</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="ti-email"></i></th>
                            <td>Email</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="ti-mobile"></i></th>
                            <td>Phone</td>
                            <td>{{$user->phone}}</td>
                        </tr>
                        <tr>
                            <th scope="row"><i class=" icon-location-pin"></i></th>
                            <td>Map</td>
                            <td>{{$user->map_type}}</td>
                        </tr>

                        <tr>
                            <th scope="row"><i class="fa fa-bell-o"></i></th>
                            <td><i class="ti-email"></i></td>
                            <td>
                                <div class="checkbox checkbox-primary m-t-0 m-b-0">
                                    <input id="personal_chk_notify_email" type="checkbox">
                                    <label for="personal_chk_notify_email">Notify Email</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><i class="fa fa-bell-o"></i></th>
                            <td><i class="ti-mobile"></i></td>
                            <td>
                                <div class="checkbox checkbox-primary m-t-0 m-b-0">
                                    <input id="personal_chk_notify_phone" type="checkbox">
                                    <label for="personal_chk_notify_phone">Notify Phone</label>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="button" onclick="onSaveChangeProfile();">
                    Save Change
                </button>                
            </div>
            <div class="tab-pane" id="personal_pwd">
                <form class="form-horizontal m-t-20">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" placeholder="Current Password" value="" id="cur_pwd">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" placeholder="New Password" value="" id="new_pwd">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" placeholder="Confirm Password" value="" id="new_confirm_pwd">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="button" onclick="onChangePassword();">
                                Change Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@section('footer_for_personal')
<script>
    function onPersonalInfo() 
    {
        $.ajax({
            url: "{{ url('/api/user/get_profile')}}",
            data: {
                token: "{{$token}}"
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {        
                if (data.status == 200) {
                    if(data.data.notify_email >0)
                        $('#personal_chk_notify_email').prop('checked',true);
                    else $('#personal_chk_notify_email').prop('checked',false);

                    if(data.data.notify_phone >0)
                        $('#personal_chk_notify_phone').prop('checked',true);
                    else $('#personal_chk_notify_phone').prop('checked',false);

                    onRightLeafItem('personal-panel');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
            }
        });        
        
        
    }

    function onSaveChangeProfile()
    {
        var notifyEmail = 0;
        var notifyPhone = 0;
        if(document.getElementById('personal_chk_notify_email').checked)
            notifyEmail = 1;
        if(document.getElementById('personal_chk_notify_phone').checked)
            notifyPhone = 1;
        
        $.ajax({
            url: "{{ url('/api/user/change_profile')}}",
            data: {
                token: "{{$token}}",
                notify_email: notifyEmail,
                notify_phone: notifyPhone
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == 200) {
                    swal("Success!", data.message, "success");
                } else
                    swal("Error!", data.message, "error");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal("Error!", "", "error");
            }
        });
    }

    function onChangePassword() {
        var curPwd = document.getElementById("cur_pwd").value;
        var newPwd = document.getElementById("new_pwd").value;
        var newPwd1 = document.getElementById("new_confirm_pwd").value;
        if (curPwd == "" || newPwd == '') return;
        if (newPwd != newPwd1) return;

        $.ajax({
            url: "{{ url('/api/user/change_password')}}",
            data: {
                token: "{{$token}}",
                cur_pwd: curPwd,
                new_pwd: newPwd
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == 200) {
                    swal("Success!", data.message, "success");
                    window.location.href = "{{url('/user/logout')}}";
                } else
                    swal("Error!", data.message, "error");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal("Error!", "", "error");
            }
        });
    }
</script>
@endsection