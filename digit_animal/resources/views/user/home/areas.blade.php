<div class="panel panel-border panel-primary m-t-15" id="areas-panel">
    <div class="panel-heading">
        <a href="javascript:;" class="pull-right btn btn-default btn-sm waves-effect waves-light" onclick="onAddNewArea();">Add <i class="fa fa-plus"></i></a>
        <h3 class="panel-title"><i class="ion-location fa-lg"></i> Areas</h3>
    </div>
    <div class="panel-body m-t-20" style="padding:4px !important;">
        <table class="table table-bordered  m-t-10" id="table_areas" style="width:100% !important;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div class="panel panel-border panel-primary m-t-15" id="area-edit-panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="ion-location fa-lg"></i> Area Edit</h3>
    </div>
    <div class="panel-body" style="padding:4px !important;">
        <div class="card-box">
            <input hidden id="new_area_id">
            <label> Name:</label>
            <input type="text" id="new_area_name" name="new_area_name" class="form-control" placeholder="Name">

            <div class="text-left m-t-20 m-b-5">
                <p class="text-muted font-13">Area Type :<span class="m-l-15" id="new_area_type_str">Green</span></p>
            </div>
            <select class="image-picker" id="new_area_type">
                <option data-img-label="Green" data-img-src="{{url('assets/images/app/farm.svg')}}" data-img-class="thumb-md m-b-5" value="green">Green</option>
                <option data-img-label="Yellow" data-img-src="{{url('assets/images/app/enclosure.svg')}}" data-img-class="thumb-md m-b-5" value="yellow">Yellow</option>
            </select>
        </div>

        <div class="text-center m-t-40">
            <button class="btn btn-icon waves-effect waves-light btn-success" onclick="onSaveNewArea();"> <i class="fa fa-save"></i> </button>
            <button class="btn btn-icon waves-effect waves-light btn-danger" onclick="onCloseAreaEdit();"> <i class="ion-close"></i> </button>
        </div>
    </div>
</div>

<div class="panel panel-border panel-primary m-t-15" id="area-view-panel">
    <div class="panel-heading">
        <a href="javascript:;" class="pull-right m-t-10" onclick="onCloseAreaEdit();">
            <small class="font-600"><i class="fa fa-list"></i><span> </span>Areas</small>
        </a>
        <h3 class="panel-title"><i class="ion-location fa-lg"></i> Area</h3>

        <div class="text-center m-t-20 m-b-15">
            <button type="button" class="btn btn-facebook waves-effect waves-light  pull-left" onclick="onGotoArea();">
                <i class="fa fa-map-marker"></i>
            </button>
            <img class="thumb-xs" src="{{url('assets/images/app/farm.svg')}}" id="area_view_type_img"><span class="text-success" id="area_view_name"> HHH1</span>
            <!-- <button type="button" class="btn btn-danger waves-effect waves-light pull-right">
                <i class="fa fa-trash"></i>
            </button> -->
        </div>

    </div>
    <div class="panel-body" style="padding:4px !important;" id="area-view-panel-content">
    </div>
</div>


@section('footer_for_areas')
<script>
    var _curAreaId = 0;
    var _tblAreas = $('#table_areas').DataTable({
        dom: "lfBrtip",
        buttons: [],
        bInfo: false,
        bLengthChange: false,

        responsive: !0,
        processing: true,
        serverSide: false,
        sPaginationType: "full_numbers",
        language: {
            paginate: {
                next: '<i class="fa fa-angle-right"></i>',
                previous: '<i class="fa fa-angle-left"></i>',
                first: '<i class="fa fa-angle-double-left"></i>',
                last: '<i class="fa fa-angle-double-right"></i>'
            }
        },
        //Set column definition initialisation properties.
        columnDefs: [{
                targets: [0], //first column 
                orderable: true, //set not orderable
                width: '200px',
                className: "dt-center"
            },
            {
                targets: [1], //first column 
                orderable: true, //set not orderable
                width: '30px',
                className: "dt-center"
            },
            {
                targets: [-1], //first column 
                width: '50px',
                className: "dt-action"
            }
        ],
        ajax: {
            url: "{{ url('/api/user/areas') }}",
            type: "POST",
            data: {
                "token": "{{$token}}"
            }
        },
    });


    $("#new_area_type").imagepicker({
        hide_select: true,
        show_label: false
    });
    $("#new_area_type").change(function() {
        $("#new_area_type_str").text($("#new_area_type option:selected").text());
    });

    function onSaveNewArea() {
        clearMapDrawings();
        var areaName = document.getElementById("new_area_name").value;
        if(areaName == "") {
            $( '#new_area_name').focus();
            return;
        }
        $.ajax({
            url: "{{ url('/api/user/edit_area') }}",
            data: {
                token: "{{$token}}",
                id: document.getElementById("new_area_id").value,
                new_area_name: document.getElementById("new_area_name").value,
                new_area_type: document.getElementById("new_area_type").value,
                new_area_region: _pathAry
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status != 200) {
                    swal("Error!", data.message, "error");
                } else {
                    _tblAreas.ajax.reload();
                    showRightPanel('areas-panel');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal("Error!", "", "error");
            }
        });
    }

    function onCloseAreaEdit() {
        clearMapDrawings();        
        showRightPanel('areas-panel');
    }

    function onAddNewArea(){
        onCloseRightPanel();
        _drawingManager.setMap(_map);
        _drawingManager.setDrawingMode(google.maps.drawing.OverlayType.POLYGON);        
    }

    function onNewArea() {
        document.getElementById("new_area_id").value = '';
        document.getElementById("new_area_name").value = '';
        $("#new_area_type").val('green').trigger('change');        
        onRightLeafItem('area-edit-panel');        
    }

    function onEditArea(idx) {
        $.ajax({
            url: "{{ url('/api/user/get_area')}}",
            data: {
                token: "{{$token}}",
                id: idx
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == 200) {
                    let area = data.data;
                    document.getElementById("new_area_id").value = area.id;
                    document.getElementById("new_area_name").value = area.area_name;
                    $('#new_area_type').val(area.area_type).trigger('change');
                    showRightPanel('area-edit-panel');
                } else {
                    swal("Error!", data.message, "error");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal("Error!", "", "error");
            }
        });
    }

    function onGotoArea()
    {
        if(_curAreaId==0) return;
        var areaEle = _areas[_curAreaId];
        if(areaEle==null) return;

        var areaData = areaEle.polygon.customInfo;

        var x1 = 40000, x2 = -40000, y1 = 40000, y2 = -40000
        //calc center
        for(let i=0; i<areaData.region.length; i++)
        {
            if(areaData.region[i][0] < x1) x1 = areaData.region[i][0];
            if(areaData.region[i][0] > x2) x2 = areaData.region[i][0];
            if(areaData.region[i][1] < y1) y1 = areaData.region[i][1];
            if(areaData.region[i][1] > y2) y2 = areaData.region[i][1];
        }

        var centerLat = Number(x1) + Number((x2-x1)/2);
        var centerLng = Number(y1) + Number((y2-y1)/2);
        _map.setCenter({lat:centerLat, lng:centerLng});
        _map.setZoom(10);
    }

    function updateAreaView(data)
    {
        //display area.   
        if(data.area.area_type=='farm')
            document.getElementById('area_view_type_img').src = "{{url('assets/images/app/farm.svg')}}";
        else
            document.getElementById('area_view_type_img').src = "{{url('assets/images/app/enclosure.svg')}}";
        document.getElementById('area_view_name').innerText = data.area.area_name;
        
        //display list
        var contents ='';
        for(let i=0 ;i<data.list.length; i++)
        {
            contents += '<div class="portlet">' + 
                            '<div class="portlet-heading">' + 
                                '<img class="thumb-sm" src="' + data.list[i].img +'"><span class="text-muted"> ' + data.list[i].devices.length + ' Devices</span>'+
                                '<div class="portlet-widgets">'+                                
                                    '<a data-toggle="collapse" aria-expanded="false" class="collapsed" href="#area-view-list-' + i + '"><i class="ion-minus-round"></i></a>' +
                                    '<span class="divider"></span>' +
                                '</div>' + 
                                '<div class="clearfix"></div>' + 
                            '</div>' + 
                            '<div id="area-view-list-' + i + '" class="panel-collapse collapse"  aria-expanded="false">' + 
                                '<div class="portlet-body">'+
                                    '<table class="table table-bordered  m-t-10" style="width:100% !important;">'+
                                        '<tbody>';
                            for(let j=0; j<data.list[i].devices.length; j++)
                            {
                                contents += '<tr>'+
                                                '<td>' + data.list[i].devices[j].name +'</td>'+
                                                '<td>' + data.list[i].devices[j].device +'</td>' + 
                                            '</tr>';
                            }
                            contents += '</tbody>'+
                                    '</table>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
        }
        document.getElementById('area-view-panel-content').innerHTML = contents;
        showRightPanel('area-view-panel');
    }    

    function onViewArea(idx) {
        $.ajax({
                url: "{{ url('/api/user/get_area_details')}}",
                data: {
                    token: "{{$token}}",
                    id: idx
                },
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if(data.status==200)
                    {
                        _curAreaId = idx;
                        updateAreaView(data.data);
                    }
                    else
                        swal("Error!", data.message, "error");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Error!", "", "error");
                }
        });
    }

    function onDeleteArea(idx) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this area information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger m-l-10',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                url: "{{ url('/api/user/del_area')}}",
                data: {
                    token: "{{$token}}",
                    id: idx
                },
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    swal("Remove!", "", "success");
                    _tblAreas.ajax.reload();
                    showRightPanel('areas-panel');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Error!", "", "error");
                }
            });
        }, function(dismiss) {});
    }
</script>
@endsection