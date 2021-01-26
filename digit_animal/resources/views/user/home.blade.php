@extends('layouts.user')

@section('header')
<link href="{{ url('assets/plugins/custombox/css/custombox.css')}}" rel="stylesheet">
<link href="{{ url('assets/css/app.css')}}" rel="stylesheet">
<link href="{{ url('assets/plugins/image-picker/image-picker.css')}}" rel="stylesheet" />

<link href="{{ url('assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/plugins/datatables/fixedColumns.dataTables.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ url('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />

@endsection

@section('content')
    <div id="map"></div>
    @include('user.home.left')
    @include('user.home.right')
@endsection




@section('footer')

<script src="{{url('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
<script src="{{url('assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/buttons.bootstrap.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{url('assets/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/responsive.bootstrap.min.js')}}"></script>
<script src="{{url('assets/plugins/datatables/dataTables.colVis.js')}}"></script>
<script src="{{url('assets/plugins/datatables/dataTables.fixedColumns.min.js')}}"></script>


<script src="{{ url('assets/plugins/image-picker/image-picker.min.js')}}" type="text/javascript"></script>
<script src="{{ url('assets/plugins/custombox/js/custombox.min.js')}}"></script>
<script src="{{ url('assets/plugins/custombox/js/legacy.min.js')}}"></script>

<script src="{{ url('assets/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{ url('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')}}" type="text/javascript"></script>
@endsection


@section('footer_main')
<script>
    var _drawingManager = null;
    var _map = null;

    var _pathAry = null;
    var _areaNew = null;

    var _markerPosition = null;
    var _markerNew = null;


    function clearMapDrawings()
    {
        if(_areaNew!=null)
            _areaNew.setMap(null);
        _areaNew = null;

        if(_markerNew!=null)
            _markerNew.setMap(null);
        _markerNew = null;
        _drawingManager.setMap(null);
    }

    function isVisibleRightSideBar() {
        return document.getElementById('wrapper').classList.contains('rt-bar-enabled');
    }

    function isVisibleLeftSideBar() {
        return document.getElementById('wrapper').classList.contains('lt-bar-enabled');
    }

    function showRightSideBar(bShow) {
        if (isVisibleRightSideBar() != bShow)
            $('#wrapper').toggleClass('rt-bar-enabled');
    }

    function showLeftSideBar(bShow) {
        if (isVisibleLeftSideBar() != bShow)
            $('#wrapper').toggleClass('lt-bar-enabled');
    }
    function showRightLeaf(bShow) {
        var x = document.getElementById("sidebar1");
        if (x.style.display === "none") {
            if (bShow == true)
            {
                x.style.display = "block";
            }
        } else {
            if (bShow == false) {
                x.style.display = "none";
                _curMarker = null;
            }
        }

        if(bShow && _curThing!=null)
        {
            if(_curThing.new_notify > 0)
                document.getElementById('thing_new_notify').innerText = _curThing.new_notify;
            else
                document.getElementById('thing_new_notify').innerText = '';                    
        }
    }    

    function initMap() {

        // The location of madrid
        var uluru = {
            lat: 40.416775,
            lng: -3.703790
        };
        // The map, centered at Uluru
        _map = new google.maps.Map(
            document.getElementById('map'), {
                zoom: 7,
                center: uluru,
                mapTypeId: google.maps.MapTypeId.TERRAIN
            });

         _map.addListener('click', function() {
            if (isVisibleRightSideBar())
                showRightSideBar(false);
            else
                showRightLeaf(false);

            if (isVisibleLeftSideBar())
                showLeftSideBar(false);
        });

        _drawingManager = new google.maps.drawing.DrawingManager({
            // drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: false,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: ['polygon', 'marker']
            }
        });

        // _drawingManager.setMap(_map);
        google.maps.event.addListener(_drawingManager, 'overlaycomplete', (event) => {
            // Polygon drawn
            if (event.type === google.maps.drawing.OverlayType.POLYGON) {
                // event.overlay.setVisible(false);
                path = event.overlay.getPath().getArray();
                _pathAry = [];
                for(let i=0; i<path.length; i++)
                {
                    pt = [path[i].lat(), path[i].lng()];
                    _pathAry.push(pt);
                }
                //event.overlay.setMap(null);
                if(_areaNew!=null)
                    _areaNew.setMap(null);
                _areaNew = event.overlay;
                _drawingManager.setMap(null);

                onNewArea();
            }
            else if(event.type === google.maps.drawing.OverlayType.MARKER)
            {
                // event.overlay.setVisible(false);
                _markerPosition = event.overlay.position;                
                if(_markerNew!=null)
                    _markerNew.setMap(null);
                _markerNew = event.overlay;
                //event.overlay.setMap(null);
                _drawingManager.setMap(null);
                onNewDevice();
            }
        });
        updateMap();
    }


    var _things = {};
    var _areas = {};
    var _curThing = null;
    var _inQueryMapUpdate = false;
    var _lastPath = null;

    setInterval(updateMap, 5000);
    function refreshMap(data)
    {
        //first init updated state
        Object.keys(_things).forEach(function(key) {
            if(_things[key]!=null)
                _things[key].updated = false;
        });        

        things = data.things;
        for(let i=0; i<things.length; i++)
        {
            var ele = _things[things[i].id];            
            var iconUrl = things[i].marker_ok;            
            if(things[i].state=="medium")
                iconUrl = things[i].marker_medium;
            else if(things[i].state=="critical")
                iconUrl = things[i].marker_critical;
            var icon = {
                url: iconUrl,
                scaledSize: new google.maps.Size(32, 32), // scaled size
                origin: new google.maps.Point(0, 0), // origin
                anchor: new google.maps.Point(16, 32) // anchor
            };
            if(ele == null)
            {                
                var marker = new google.maps.Marker({
                    icon:icon,
                    position: {lat:things[i].lat, lng:things[i].lng},
                    map: _map,
                    title:things[i].name,
                    customInfo:things[i]
                });
                marker.addListener('click', function() 
                {
                    if(_curThing!=this.customInfo)
                        showRightSideBar(false);

                    if(_lastPath!=null)
                    {
                        _lastPath.setMap(null);
                        _lastPath = null;
                    }                        

                    _curThing = this.customInfo;
                    showRightLeaf(true);
                    _map.setZoom(12);
                    _map.setCenter(this.getPosition());
                });
                _things[things[i].id] = {marker:marker, updated:true};
            }
            else
            {
                var oldThingData = ele.marker.customInfo;
                if(oldThingData.lat != things[i].lat || oldThingData.lng != things[i].lng)
                    _things[things[i].id].marker.setPosition(new google.maps.LatLng(things[i].lat,things[i].lng));
                if(oldThingData.state!=things[i].state || oldThingData.kind!=things[i].kind)
                {
                    _things[things[i].id].marker.setIcon(icon);
                }
                    
                if(oldThingData.name != things[i].name)
                    _things[things[i].id].marker.setTitle(things[i].name);

                _things[things[i].id].marker.customInfo = things[i];
                _things[things[i].id].updated = true;
            }
        }

        //if not updated remove marker
        Object.keys(_things).forEach(function(key) {
            if(_things[key]!=null && _things[key].updated == false)
            {
                _things[key].marker.setMap(null);
                _things[key] = null;
            }
        });           



        Object.keys(_areas).forEach(function(key) {
            if(_areas[key]!=null)
                _areas[key].updated = false;
        }); 

        areas = data.areas;
        for(let i=0; i<areas.length; i++)
        {
            var ele = _areas[areas[i].id];
            if(ele == null)
            {
                var triangleCoords = [];
                for(let j=0; j<areas[i].region.length; j++)
                    triangleCoords.push(new google.maps.LatLng(areas[i].region[j][0] , areas[i].region[j][1]));
                if(areas[i].type=='green')
                {
                    polygon = new google.maps.Polygon({
                        paths: triangleCoords,
                        clickable:false,
                        strokeColor: "#00FF00",
                        strokeOpacity: 0.8,
                        strokeWeight: 1,
                        fillColor: "#00FF00",
                        fillOpacity: 0.15,
                        customInfo:areas[i]
                    });
                }
                else
                {
                    polygon = new google.maps.Polygon({
                        paths: triangleCoords,
                        clickable:false,
                        strokeColor: "#FFFF00",
                        strokeOpacity: 0.8,
                        strokeWeight: 1,
                        fillColor: "#FFFF00",
                        fillOpacity: 0.15,
                        customInfo:areas[i]
                    });
                }
                polygon.setMap(_map);
                _areas[areas[i].id] = {polygon:polygon, updated:true};
            }
            else
            {
                var oldAreaData = ele.polygon.customInfo;
                if(oldAreaData.type != areas[i].type)
                {
                    if(areas[i].type=="green")       
                    {
                        ele.polygon.setOptions({strokeColor: "#00FF00",fillColor:"#00FF00"});
                    }   
                    else
                    {
                        ele.polygon.setOptions({strokeColor: "#FFFF00",fillColor:"#FFFF00"});  
                    }                        
                }
                _areas[areas[i].id].polygon.customInfo = areas[i];
                _areas[areas[i].id].updated = true;
            }            
        }
        Object.keys(_areas).forEach(function(key) {
            if(_areas[key]!=null && _areas[key].updated == false)
            {
                _areas[key].polygon.setMap(null);
                _areas[key] = null;
            }
        });           

    }    
    function updateMap()
    {
        if(_inQueryMapUpdate) return;
        _inQueryMapUpdate = true;
        $.ajax({
            url: "{{ url('/api/user/map_elements')}}",
            data: {
                token: "{{$token}}"
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {                
                if(data.status==200)
                    refreshMap(data.data);
                _inQueryMapUpdate = false;
            },
            error: function(jqXHR, textStatus, errorThrown) {
                _inQueryMapUpdate = false;
            }
        });
    }


</script>
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLmZzdDJKrAMjp3PxZTMhgr6Ovaag1y-U&callback=initMap&libraries=drawing,geometry" type="text/javascript"></script> -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCijIfpaDNi6iMfhL_2M-pMHEQhqHxf9lI&callback=initMap&libraries=drawing,geometry" type="text/javascript"></script>


@endsection