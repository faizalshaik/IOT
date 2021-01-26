<!-- right menu buttons -->
<div class="leaflet-sidebar sidebar-right collapsed" id="sidebar1" style="height: 240px; display:none;">
    <div class="leaflet-sidebar-tabs abd">
        <ul role="tablist">
            <li class="sensorInfo">
                <a href="javascript:void(0)" onclick="onThingInfomation();">
                    <img src="{{url('assets/images/menu/dev_infor.png')}}" alt="" style="width:30px;">
                </a>
            </li>
            <li class="sensorInfo">
                <a href="javascript:;" onclick="onThingPath();">
                    <img src="{{url('assets/images/menu/dev_path.png')}}" alt="" style="width:30px;">
                </a>
            </li>
            <li class="sensorCustom">
                <a href="javascript:void(0)" onclick="onThingNotify();">
                    <img src="{{url('assets/images/menu/dev_notify.png')}}" alt="" style="width:30px;">
                    <span class="badge badge-xs badge-danger" style="position:absolute; right:11px;" id="thing_new_notify"></span>
                </a>
            </li>
            <li class="sensorCustom">
                <a href="javascript:void(0)" onclick="onThingTemperature();">
                    <img src="{{url('assets/images/menu/dev_temperature.png')}}" alt="" style="width:30px;">
                </a>
            </li>
            <!-- <li class="sensorCustom">
                <a href="javascript:void(0)" onclick="onRightLeafItem('activity-panel');">
                    <img src="{{url('assets/images/menu/sensor_activity_OK.svg')}}" alt="" style="width:24px;">
                </a>
            </li> -->
            <li class="sensorCustom">
                <a href="javascript:void(0)" onclick="onThingDistance();">
                    <img src="{{url('assets/images/menu/dev_distance.png')}}" alt="" style="width:30px;">
                </a>
            </li>
            <li class="sensorCustom">
                <a href="javascript:void(0)" onclick="onThingLocation();">
                    <img src="{{url('assets/images/menu/dev_location.png')}}" alt="" style="width:30px;">
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- right panels -->
<div class="sd-bar rt-bar nicescroll" id="rt-bar">
    <div class="container" id="right-panel-container">
        <div class="panel panel-border panel-primary m-t-15" id="sensor-info-panel">
            <div class="panel-heading">
                <h3 class="panel-title">Sensor Information</h3>
            </div>
            <div class="panel-body">
            </div>
        </div>

        <div class="panel panel-border panel-primary m-t-15" id="notify-recent-panel">
            <div class="panel-heading">
                <h3 class="panel-title">Recent Notify</h3>
                <div class="text-right">
                    <a href="javascript:;" onclick="onSeeAllNotify();">
                        <small class="font-600">See all notifications</small>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="nicescroll p-20" style="height: 600px;">
                    <div class="timeline-2" id="new_notify_contents">
                    </div>
                </div>
                <div class="text-right">
                    <a href="javascript:;" onclick="onReadAllNewNotify();">
                        <small class="font-600 ">Mark Read all</small>
                    </a>
                </div>
            </div>
        </div>

        <div class="panel panel-border panel-primary m-t-15" id="notify-all-panel">
            <div class="panel-heading">
                <h3 class="panel-title">All notifications</h3>
            </div>
            <div class="panel-body">
                <div class="timeline-2" id="all_notify_contents">
                </div>

                <!-- <div class="nicescroll p-20" style="height: 600px;">
                </div> -->
                <div class="text-right">
                    <a href="javascript:;" onclick="onReadAllNewNotify();">
                        <small class="font-600 ">Mark Read all</small>
                    </a>
                </div>
            </div>
        </div>


        <div class="panel panel-border panel-primary m-t-15" id="temperature-panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-thermometer-2 fa-lg"></i> Temperature</h3>
            </div>
            <div class="panel-body">
                <div class="m-t-20">
                    <i class="fa fa-clock-o"> Current</i><span class="pull-right" id="temperature_cur">27 ºC</span>
                </div>
                <div class="m-t-20">
                    <i class="fa fa-calendar-check-o"> Weekly</i><span class="pull-right" id="temperature_week"> 27.1 ºC</span>
                </div>
                <!-- <div class="m-t-20">
                    <i class="fa fa-wpbeginner"> Herd</i><span class="pull-right"> 27.1 ºC</span>
                </div> -->

            </div>
        </div>

        <!-- <div class="panel panel-border panel-primary m-t-15" id="activity-panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ion-ios7-speedometer-outline fa-lg"></i> Activity</h3>
            </div>
            <div class="panel-body">
                <div class="m-t-20">
                    <i class="fa fa-clock-o"> Daily</i><span class="pull-right">27 h</span>
                </div>
                <div class="m-t-20">
                    <i class="fa fa-calendar-check-o"> Weekly</i><span class="pull-right"> 27.1 h</span>
                </div>
                <div class="m-t-20">
                    <i class="fa fa-wpbeginner"> Herd</i><span class="pull-right"> 27.1 h</span>
                </div>

            </div>
        </div> -->

        <div class="panel panel-border panel-primary m-t-15" id="distance-panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa ti-ruler-alt fa-lg"></i> Distance</h3>
            </div>
            <div class="panel-body">
                <div class="m-t-20">
                    <i class="fa fa-clock-o"> Daily</i><span class="pull-right" id="distance_daily"></span>
                </div>
                <div class="m-t-20">
                    <i class="fa fa-calendar-check-o"> Weekly</i><span class="pull-right" id="distance_weekely"></span>
                </div>
            </div>
        </div>

        <div class="panel panel-border panel-primary m-t-15" id="location-panel">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="ion-location fa-lg"></i> Location</h3>
            </div>
            <div class="panel-body">
                <h3 class="panel-title" id="thing_location"><i class="ion-location"></i> Finca La DehesIlla</h3>
            </div>
        </div>

        @include('user.home.devices')
        @include('user.home.areas')
        @include('user.home.personal')

    </div>

    <div class="footer" style="left:0; padding: 10px !important;">
        <button type="button" class="btn btn-success btn-custom waves-effect waves-light" onclick="onCloseRightPanel();">
            <i class="fa  fa-chevron-right"></i>
        </button>
    </div>

</div>

@section('footer_right')
<script>
    function onCloseRightPanel() {
        showRightSideBar(false);
        clearMapDrawings();
    }

    function showRightPanel(id) {
        var container = document.getElementById("right-panel-container");
        var panels = container.getElementsByClassName("panel");

        for (let i = 0; i < panels.length; i++) {
            if (panels[i].id == id)
                panels[i].style.display = "block";
            else
                panels[i].style.display = "none";
        }
    }

    function onRightLeafItem(idx) {
        showRightPanel(idx);
        showRightSideBar(true);
        showLeftSideBar(false);
    }


    function updateAllNotify() {
        document.getElementById('all_notify_contents').innerHTML = '';

        $.ajax({
            url: "{{ url('/api/user/get_all_notifies')}}",
            data: {
                token: "{{$token}}"
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == 200) {
                    var notifies = data.data;
                    var content = '';
                    for (let i = 0; i < notifies.length; i++) {
                        let sClr = 'success';
                        if (notifies[i].type == 'warnning')
                            sClr = 'warning';
                        else if (notifies[i].type == 'critical')
                            sClr = 'danger';

                        let thingStr = '';
                        if (notifies[i].thing_name != '') {
                            thingStr = '<strong><a href="javascript:;" class="text-info" onclick="onGotoThing(' + notifies[i].thing_id + ');">' + notifies[i].thing_name + '</a></strong>';
                        }
                        content += '<div class="time-item">' +
                            '<div class="item-info">' +
                            '<div class="text-' + sClr + '"><small>' + notifies[i].at + '</small>';
                        if (notifies[i].read == 0)
                            content += '<a href="javascript:;" onclick="onReadNotify(' + notifies[i].id + ')"><small class="font-600"> [Read]</small></a>';
                        content += '</div>' +
                            '<p>' + thingStr + '<span>  </span>' + notifies[i].message + '</p>' +
                            '</div>' +
                            '</div>';
                    }
                    document.getElementById('all_notify_contents').innerHTML = content;
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });

    }

    function onSeeAllNotify() {
        updateAllNotify();
        onRightLeafItem('notify-all-panel');
    }


    function updateNewNotify(thingId) {
        document.getElementById('new_notify_contents').innerHTML = '';

        $.ajax({
            url: "{{ url('/api/user/get_new_notifies')}}",
            data: {
                token: "{{$token}}",
                thingId: thingId
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == 200) {
                    var notifies = data.data;
                    var content = '';
                    for (let i = 0; i < notifies.length; i++) {
                        let sClr = 'success';
                        if (notifies[i].type == 'warnning')
                            sClr = 'warning';
                        else if (notifies[i].type == 'critical')
                            sClr = 'danger';

                        let thingStr = '';
                        if (notifies[i].thing_name != '') {
                            thingStr = '<strong><a href="javascript:;" class="text-info" onclick="onGotoThing(' + notifies[i].thing_id + ');">' + notifies[i].thing_name + '</a></strong>';
                        }
                        content += '<div class="time-item">' +
                            '<div class="item-info">' +
                            '<div class="text-' + sClr + '"><small>' + notifies[i].at + '</small>' +
                            '<a href="javascript:;" onclick="onReadNotify(' + notifies[i].id + ')"><small class="font-600"> [Read]</small></a>' +
                            '</div>' +
                            '<p>' + thingStr + '<span>  </span>' + notifies[i].message + '</p>' +
                            '</div>' +
                            '</div>';
                    }
                    document.getElementById('new_notify_contents').innerHTML = content;
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    }

    function onThingNotify() {
        let thingId = '';
        if (_curThing != null)
            thingId = _curThing.id;

        updateNewNotify(thingId);
        onRightLeafItem('notify-recent-panel');
    }

    function onGotoThing(thingId) {
        var ele = _things[thingId];
        if (ele != null) {
            _map.setZoom(12);
            _map.setCenter(ele.marker.getPosition());
        }
    }

    function onReadNotify(id) {
        $.ajax({
            url: "{{ url('/api/user/set_read_notify')}}",
            data: {
                token: "{{$token}}",
                id: id
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {},
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    }

    function onReadAllNotify() {
        $.ajax({
            url: "{{ url('/api/user/set_read_all_notify')}}",
            data: {
                token: "{{$token}}"
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {},
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    }

    function onReadAllNewNotify(id) {
        $.ajax({
            url: "{{ url('/api/user/set_read_all_notify')}}",
            data: {
                token: "{{$token}}"
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                onCloseRightPanel();
                showRightLeaf(false);
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    }

    function onThingPath() {
        if (_curThing == null) return;

        if(_lastPath!=null)
        {
            _lastPath.setMap(null);
            _lastPath = null;
        }                        

        $.ajax({
            url: "{{ url('/api/user/get_thing_path')}}",
            data: {
                token: "{{$token}}",
                id: _curThing.id
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == 200) {                    
                    var paths = data.data;

                    if(paths.length > 1)
                    {
                        var pathCoords = [];
                        for(let j=0; j<paths.length; j++)
                            pathCoords.push(new google.maps.LatLng(paths[j][0] , paths[j][1]));
                        _lastPath = new google.maps.Polyline({path: pathCoords,
                                    geodesic: true,
                                    strokeColor: '#FF0000',
                                    strokeOpacity: 1.0,
                                    strokeWeight: 2
                        });
                        _lastPath.setMap(_map);
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });

    }


    function onThingTemperature()
    {
        if (_curThing == null) return;
        $.ajax({
            url: "{{ url('/api/user/get_thing_temperature')}}",
            data: {
                token: "{{$token}}",
                id: _curThing.id
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == 200) {                    
                    var temp = data.data;
                    document.getElementById('temperature_cur').innerText = temp.cur + ' ºC';
                    document.getElementById('temperature_week').innerText = temp.weekely + ' ºC';
                    onRightLeafItem('temperature-panel');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    }

    function onThingDistance()
    {
        if (_curThing == null) return;
        $.ajax({
            url: "{{ url('/api/user/get_thing_distance')}}",
            data: {
                token: "{{$token}}",
                id: _curThing.id
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == 200) {                    
                    var dist = data.data;
                    var daily = 0;
                    for(let i=1; i<dist.daily.length; i++)
                    {
                        daily +=google.maps.geometry.spherical.computeDistanceBetween(
                            new google.maps.LatLng(dist.daily[i-1][0] , dist.daily[i-1][1]),
                            new google.maps.LatLng(dist.daily[i][0] , dist.daily[i][1])
                        );
                    }

                    var weekely = 0;
                    for(let i=1; i<dist.weekely.length; i++)
                    {
                        weekely +=google.maps.geometry.spherical.computeDistanceBetween(
                            new google.maps.LatLng(dist.weekely[i-1][0] , dist.weekely[i-1][1]),
                            new google.maps.LatLng(dist.weekely[i][0] , dist.weekely[i][1])
                        );
                    }
                    document.getElementById('distance_daily').innerText = (Math.round(daily / 1000)).toFixed(2) + ' Km';
                    document.getElementById('distance_weekely').innerText = (Math.round(weekely / 1000)).toFixed(2) + ' Km';
                    onRightLeafItem('distance-panel');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    }

    function onThingLocation()
    {
        if (_curThing == null) return;
        $.ajax({
            url: "{{ url('/api/user/get_thing_location')}}",
            data: {
                token: "{{$token}}",
                id: _curThing.id
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == 200) {
                    document.getElementById('thing_location').innerText = '';
                    if(data.data!=null)
                        document.getElementById('thing_location').innerText = data.data.area_name;
                    onRightLeafItem('location-panel');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {}
        });
    }    

</script>
@endsection