<!-- menu button -->
<div class="leaflet-sidebar sidebar-left-mini collapsed" id="sidebar0">
    <div class="leaflet-sidebar-tabs">
        <ul role="tablist">
            <li>
                <a href="#" class="lt-bar-toggle waves-effect waves-light"><i class="fa fa-bars"></i></a>
            </li>
        </ul>
    </div>
</div>
<!-- left menu -->
<div class="sd-bar lt-bar nicescroll" id="lt-bar">
    <div class="nicescroll">
        <div class="text-center p-t-10 p-b-10" style="background: #ebeff2;">
            <img src="{{url('assets/images/menu/logo_menu_mix.png')}}" alt="" style="width:200px;">
        </div>
        <ul class="list-group menu-list">
            <li class="list-group-item">
                <a href="javascript:void(0)" onclick="showDevices();">
                    <div class="icon">
                        <img src="{{url('assets/images/menu/devices.png')}}" alt="">
                    </div>
                    <span class="name">Devices</span>
                </a>
                <span class="clearfix"></span>
            </li>
            
            <li class="list-group-item">
                <!-- <a href="javascript:void(0)" onclick="onAreaList()"> -->
                <a href="javascript:void(0)" onclick="_tblAreas.ajax.reload(); onRightLeafItem('areas-panel');">
                    <div class="icon">
                        <img src="{{url('assets/images/menu/areas.png')}}" alt="">
                    </div>
                    <span class="name">Areas</span>
                </a>
                <span class="clearfix"></span>
            </li>

            <li class="list-group-item">
                <!-- <a href="javascript:void(0)" onclick="onRightLeafItem(9);"> -->
                <a href="javascript:;" onclick="onShowRecentNotifications();">
                    <div class="icon">
                        <img src="{{url('assets/images/menu/notify.png')}}" alt="">
                        <span class="badge badge-xs badge-danger" style="position:absolute; left:34px; top:9px;" id="customer_new_notify">3</span>
                    </div>
                    <span class="name">Notifications</span>
                </a>
                <span class="clearfix"></span>
            </li>
            <!-- <li class="list-group-item">
                <a href="#">
                    <div class="icon">
                        <img src="{{url('assets/images/menu/MENU_SET_NOTIFICATIONS.svg')}}" alt="">
                    </div>
                    <span class="name">Set notifications</span>
                </a>
                <span class="clearfix"></span>
            </li> -->

            <!-- <li class="list-group-item">
                <a href="#">
                    <div class="icon">
                        <img src="{{url('assets/images/menu/MENU_HELP.svg')}}" alt="">
                    </div>
                    <span class="name">Help</span>
                </a>
                <span class="clearfix"></span>
            </li> -->
            <li class="list-group-item">
                <a href="javascript:void(0)" onclick="onPersonalInfo();">
                    <div class="icon">
                        <img src="{{url('assets/images/menu/settings.png')}}" alt="">
                    </div>
                    <span class="name">Configuration</span>
                </a>
                <span class="clearfix"></span>
            </li>
            <li class="list-group-item">
                <a href="{{url('/user/logout')}}">
                    <div class="icon">
                        <img src="{{url('assets/images/menu/logout.png')}}" alt="">
                    </div>
                    <span class="name">Logout</span>
                </a>
                <span class="clearfix"></span>
            </li>
        </ul>
    </div>
    <div class="footer" style="left:0; padding: 10px !important;">
        <div class="button-list m-t-10 m-b-10 text-center">
            <button type="button" class="btn btn-facebook waves-effect waves-light">
                <i class="fa fa-facebook"></i>
            </button>

            <button type="button" class="btn btn-twitter waves-effect waves-light">
                <i class="fa fa-twitter"></i>
            </button>

            <button type="button" class="btn btn-pink waves-effect waves-light">
                <i class="fa fa-instagram"></i>
            </button>

            <button type="button" class="btn btn-danger waves-effect waves-light">
                <i class="fa fa-youtube-play"></i>
            </button>

        </div>
    </div>
</div>

@section('footer_left')
<script>

    function onShowRecentNotifications()
    {
        updateNewNotify('');
        onRightLeafItem('notify-recent-panel');
    }

    $('.lt-bar-toggle').on('click', function(e) {
        $('#wrapper').toggleClass('lt-bar-enabled');
        showRightSideBar(false);

        if(isVisibleLeftSideBar())
        {
            $.ajax({
                url: "{{ url('/api/user/get_new_notify_count')}}",
                data: {
                    token: "{{$token}}"
                },
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if(data.status==200)
                    {
                        if(data.data > 0)
                            document.getElementById('customer_new_notify').innerText = data.data;
                        else
                            document.getElementById('customer_new_notify').innerText = '';
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                }
            }); 

            //check new notify
            

        }
    });
</script>
@endsection