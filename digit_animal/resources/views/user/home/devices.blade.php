<div class="panel panel-border panel-primary m-t-15" id="info-panel">
    <div class="panel-heading">
        <a href="javascript:;" class="pull-right m-t-10" onclick="showDevices();">
            <small class="font-600"><i class="fa fa-list"></i><span> </span>Devices</small>
        </a>
        <h3 class="panel-title"><i class="md-perm-device-info fa-lg"> </i>Information</h3>
    </div>
    <div class="panel-body">
        <div>
            <img src="{{url('assets/images/app/cow.svg')}}" class="thumb-sm" alt="" id="info_thumb_img">
            <!-- <img src="{{url('assets/images/app/male.svg')}}" class="thumb-sm" alt="image"> -->
            <div class="pull-right">
                <!-- <button class="btn btn-icon waves-effect waves-light btn-success"> <i class="fa fa-picture-o"></i> </button> -->
                <button class="btn btn-icon waves-effect waves-light btn-primary" onclick="onEditInfomation();"> <i class="fa fa-pencil"></i> </button>
                <button class="btn btn-icon waves-effect waves-light btn-pink" onclick="onEditSetting();"> <i class="icon-bell"></i> </button>
                <button class="btn btn-icon waves-effect waves-light btn-danger" onclick="onRemoveDevice();"> <i class="fa fa-trash"></i> </button>
            </div>
        </div>

        <div class="m-t-15">
            <label class="label label-default" style="display:block !important; margin-bottom:0px !important; border-radius:0px !important;" id="info_name">Lola</label>
            <img src="{{url('assets/images/animals/AH613_Vaca.jpg')}}" class="img-responsive" style="width: 100%;" alt="" id="info_thing_img">
            <input type="file" class="form-control  btn btn-default" style="border-radius:0px !important;" name="device_pic" id="device_pic" data-buttonname="btn-primary" accept="image/*">
            <div class="text-left m-t-15">
                <p class="text-muted font-13"><strong>Device :</strong> <span class="m-l-15" id="info_device_name">AH613</span></p>
                <p class="text-muted font-13"><strong>Date :</strong><span class="m-l-15" id="info_date">2019-12-20 09:42:08</span></p>
            </div>
        </div>

        <div class="m-t-15">
            <label class="label label-default" style="display:block !important; margin-bottom:0px !important; border-radius:0px !important;">Monitoring</label>
            <div class="m-t-5 text-center" id='info_setting_imgs_4_8'>
                <!-- <img src="{{url('assets/images/app/rule_type_4.svg')}}" class="thumb-sm" alt="image"> -->
            </div>
        </div>

        <!-- <div class="m-t-15">
            <label class="label label-default" style="display:block !important; margin-bottom:0px !important; border-radius:0px !important;">Geofencing</label>
            <div class="m-t-5 text-center" id='info_setting_imgs_1_3'>
                <img src="{{url('assets/images/app/rule_type_3.svg')}}" class="thumb-sm" alt="image">
            </div>
        </div> -->


    </div>
</div>

<div class="panel panel-border panel-primary m-t-15" id="info-edit-panel">
    <div class="panel-heading">
        <h3 class="panel-title">Edit-Information</h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" id="info_edit_name" name="info_edit_name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="md  md-bluetooth"></i></span>
                <select class="selectpicker form-control" data-style="btn-default" id="info_edit_device_name" name="info_edit_device_name">
                    @foreach($devicemodels as $device)
                    <option value="{{$device->id}}">{{$device->model_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="text-left m-t-20 m-b-5">
            <p class="text-muted font-13">Thing's kind :<span class="m-l-15" id="info_edit_kind_str"></span></p>
        </div>
        <select class="image-picker" id="info_edit_kind">
            @foreach($thingkinds as $kind)
            <option data-img-label="{{$kind->kind_name}}" data-img-src="{{url($kind->thumb_image)}}" data-img-class="thumb-md m-b-5" value="{{$kind->id}}">{{$kind->kind_name}}</option>
            @endforeach
        </select>

        <!-- <div class="text-left m-t-20 m-b-5">
            <p class="text-muted font-13">Thing's sex :<span class="m-l-15" id="animal_sex_str">Male</span></p>
        </div>
        <select class="image-picker" id="animal_sex">
            <option data-img-label="Male" data-img-src="{{url('assets/images/app/male.svg')}}" data-img-class="thumb-md m-b-5" value="Male">Male</option>
            <option data-img-label="Female" data-img-src="{{url('assets/images/app/female.svg')}}" data-img-class="thumb-md m-b-5" value="Female">Female</option>
        </select> -->

        <div class="form-group m-t-20">
            <div class="input-group">
                <span class="input-group-addon"><i class="icon-speech"></i></span>
                <textarea class="form-control" rows="2" id='info_edit_about'></textarea>
            </div>
        </div>

        <div class="text-right m-t-40">
            <button class="btn btn-icon waves-effect waves-light btn-success" onclick="onSaveInformation();"> <i class="fa fa-save"></i> </button>
            <button class="btn btn-icon waves-effect waves-light btn-danger" onclick="onCloseInformation();"> <i class="ion-close"></i> </button>
        </div>
    </div>
</div>

<div class="panel panel-border panel-primary m-t-15" id="info-setting-panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="icon-bell"> Setting-Notifications</i></h3>
    </div>
    <div class="panel-body">
        <ul class="nav nav-tabs tabs">
            <li class="active tab">
                <a href="#setting-device" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Devices</span>
                </a>
            </li>
            <li class="tab">
                <a href="#setting-enclosures" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                    <span class="hidden-xs">Enclosures</span>
                </a>
            </li>
        </ul>
        <div class="tab-content" style="padding: 5px !important;">
            <div class="tab-pane active" id="setting-device">
                <div class="m-t-15">
                    <label class="label label-default" style="display:block !important; margin-bottom:0px !important; border-radius:0px !important;">Monitoring</label>
                    <div class="checkbox checkbox-primary m-t-5">
                        <input id="info_setting_chk_0" type="checkbox" checked="">
                        <label for="info_setting_chk_0">Sensor</label>
                        <img class="thumb-xs pull-right" src="{{url('assets/images/app/setting_0.svg')}}">
                    </div>
                    <div class="checkbox checkbox-primary m-t-5">
                        <input id="info_setting_chk_1" type="checkbox" checked="">
                        <label for="info_setting_chk_1">Temperature</label>
                        <img class="thumb-xs pull-right" src="{{url('assets/images/app/setting_1.svg')}}">
                    </div>
                    <div class="checkbox checkbox-primary m-t-5">
                        <input id="info_setting_chk_2" type="checkbox" checked="">
                        <label for="info_setting_chk_2">Activity</label>
                        <img class="thumb-xs pull-right" src="{{url('assets/images/app/setting_2.svg')}}">
                    </div>
                    <div class="checkbox checkbox-primary m-t-5">
                        <input id="info_setting_chk_3" type="checkbox" checked="">
                        <label for="info_setting_chk_3">Distance</label>
                        <img class="thumb-xs pull-right" src="{{url('assets/images/app/setting_3.svg')}}">
                    </div>
                    <div class="checkbox checkbox-primary m-t-5">
                        <input id="info_setting_chk_4" type="checkbox" checked="">
                        <label for="info_setting_chk_4">Location</label>
                        <img class="thumb-xs pull-right" src="{{url('assets/images/app/setting_4.svg')}}">
                    </div>

                    <label class="label label-default" style="display:block !important; margin-bottom:0px !important; border-radius:0px !important;">Temperature Range</label>
                    <div class="input-group m-t-10">
                        <span class="input-group-addon"><i class="fa fa-thermometer"></i></span>
                        <input type="text" id="info_setting_temperature_range" class="form-control" placeholder="0.00~25.00">
                        <span class="input-group-addon">ºC</span>
                    </div>

                </div>
            </div>
            <div class="tab-pane" id="setting-enclosures">
                <table class="table table-bordered  m-t-10" id="table_area_notify">
                    <thead>
                        <tr>
                            <th style="width:60%;">Area</th>
                            <th style="width:40%;">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <img src="{{url('assets/images/app/area_out.svg')}}" style="width:20px;">
                                    </div>
                                    <div class="col-xs-6">
                                        <img src="{{url('assets/images/app/area_in.svg')}}" style="width:20px;">
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td>Olivos</td>
                            <td>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="checkbox checkbox-primary checkbox-circle chk-in-table">
                                            <input type="checkbox">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="checkbox checkbox-success checkbox-circle chk-in-table">
                                            <input type="checkbox" checked>
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="checkbox checkbox-danger checkbox-circle chk-in-table">
                                            <input type="checkbox">
                                            <label></label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Finca La Dehesilla</td>
                            <td>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="checkbox checkbox-primary checkbox-circle chk-in-table">
                                            <input type="checkbox" checked>
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="checkbox checkbox-success checkbox-circle chk-in-table">
                                            <input type="checkbox" checked>
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="checkbox checkbox-danger checkbox-circle chk-in-table">
                                            <input type="checkbox">
                                            <label></label>
                                        </div>
                                    </div>

                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Los Tomillares</td>
                            <td>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="checkbox checkbox-primary checkbox-circle chk-in-table">
                                            <input type="checkbox">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="checkbox checkbox-success checkbox-circle chk-in-table">
                                            <input type="checkbox">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="checkbox checkbox-danger checkbox-circle chk-in-table">
                                            <input type="checkbox" checked>
                                            <label></label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </td>
                        </tr> -->

                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-right m-t-40">
            <button class="btn btn-icon waves-effect waves-light btn-success" onclick="onSaveSetting();"> <i class="fa fa-save"></i> </button>
            <button class="btn btn-icon waves-effect waves-light btn-danger" onclick="onCloseInformation();"> <i class="ion-close"></i> </button>
        </div>
    </div>
</div>

<div class="panel panel-border panel-primary m-t-15" id="devices-panel">
    <div class="panel-heading">
        <a href="javascript:;" class="pull-right btn btn-default btn-sm waves-effect waves-light" onclick="onAddNewDevice();">Add <i class="fa fa-plus"></i></a>
        <h3 class="panel-title"><i class=" md-bluetooth-connected fa-lg"></i> Devices</h3>
    </div>
    <div class="panel-body m-t-20" style="padding:4px !important;">
        <table class="table table-bordered m-t-10" style="width:100% !important;" id="table_devices_all">
            <thead>
                <tr>
                    <th></th>
                    <th>Device</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

@section('footer_for_devices')
<script>
    $('#device_pic').change(function() {
        if (typeof(FileReader) != "undefined") {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#info_thing_img').attr("src", e.target.result);
            }
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            showMsg("Error", "This browser does not support FileReader.");
        }
    });


    $("#info_edit_kind").imagepicker({
        hide_select: true,
        show_label: false
    });

    $("#info_edit_kind").change(function() {
        $("#info_edit_kind_str").text($("#info_edit_kind option:selected").text());
    });

    function onAddNewDevice() {
        onCloseRightPanel();
        _drawingManager.setMap(_map);
        _drawingManager.setDrawingMode(google.maps.drawing.OverlayType.MARKER);
    }

    function onNewDevice() {
        _curThing = null;
        clearInformation();
        onRightLeafItem('info-panel');
    }

    // information editing
    function onSaveSetting() {
        //save device info
        var thingId = '';
        if (_curThing == null) {
            onCloseRightPanel();
            return;
        }
        thingId = _curThing.id;


        var areaNotify = '';
        for (let i = 0; i < _curThing.area_notify.length; i++) {
            var areaId = _curThing.area_notify[i].area_id;
            var chk_0 = 0;
            var chk_1 = 0;
            if (document.getElementById('chk_area_notify_' + areaId + '_0') != null &&
                document.getElementById('chk_area_notify_' + areaId + '_0').checked)
                chk_0 = 1;

            if (document.getElementById('chk_area_notify_' + areaId + '_1') != null &&
                document.getElementById('chk_area_notify_' + areaId + '_1').checked)
                chk_1 = 1;

            if (areaNotify != '')
                areaNotify += '_' + areaId + '-' + chk_0 + '-' + chk_1;
            else
                areaNotify = areaId + '-' + chk_0 + '-' + chk_1;
        }


        var settings = 0;
        for (let i = 0; i < 5; i++) {
            if (document.getElementById('info_setting_chk_' + i).checked)
                settings += Math.pow(2, i);
        }

        $.ajax({
            url: "{{ url('/api/user/edit_device_1')}}",
            data: {
                token: "{{$token}}",
                id: thingId,
                settings: settings,
                temp_range:$('#info_setting_temperature_range').val(),
                area_notify: areaNotify
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status != 200)
                    swal("Error!", data.message, "error");
                else {
                    if (_curThing != null)
                        _curThing.settings = settings;
                }
                onThingInfomation();
                //showRightPanel('info-panel');           
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal("Error!", "", "error");
            }
        });
    }

    function onSaveInformation() {
        clearMapDrawings();

        var formData = new FormData();
        if (document.getElementById("device_pic").files.length > 0)
            formData.append("device_pic", $("#device_pic")[0].files[0]);

        //save device info
        var thingId = '';
        if (_curThing != null) thingId = _curThing.id;

        formData.append('token', "{{$token}}");
        formData.append('id', thingId);
        formData.append('info_edit_name', document.getElementById('info_edit_name').value);
        formData.append('info_edit_device_name', document.getElementById('info_edit_device_name').value);
        formData.append('info_edit_about', document.getElementById('info_edit_about').value);
        formData.append('info_edit_kind', document.getElementById('info_edit_kind').value);
        if (_markerPosition != null) {
            formData.append('lat', _markerPosition.lat());
            formData.append('lng', _markerPosition.lng());
            _markerPosition = null;
        }


        $.ajax({
            url: "{{ url('/api/user/edit_device_0')}}",
            data: formData,
            type: "POST",
            processData: false,
            contentType: false,
            //dataType: "JSON",
            success: function(data) {
                if (data.status != 200)
                    swal("Error!", data.message, "error");
                else {
                    if (_curThing != null) {
                        _curThing.name = document.getElementById('info_edit_name').value;
                        _curThing.device = document.getElementById('info_edit_device_name').value;
                        _curThing.about = document.getElementById('info_edit_about').value;
                        _curThing.kind = document.getElementById('info_edit_kind').value;
                        _curThing.thumb = $("#info_edit_kind option:selected").attr('data-img-src');
                        if (data.data.image != "")
                            _curThing.image = "{{url('')}}" + "/" + data.data.image;
                    }
                }
                onThingInfomation();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal("Error!", "", "error");
            }
        });
    }

    function onCloseInformation() {
        showRightPanel('info-panel');
    }

    function onEditSetting() {
        showRightPanel('info-setting-panel');
    }

    function onRemoveDevice() {
        if (_curThing == null) return;
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this device information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger m-l-10',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                url: "{{ url('/api/user/del_device')}}",
                data: {
                    token: "{{$token}}",
                    id: _curThing.id
                },
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 200) {
                        swal("Remove!", "", "success");
                    } else {
                        swal("Error!", data.message, "error");
                    }
                    onCloseRightPanel();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Error!", "", "error");
                }
            });
        }, function(dismiss) {});

    }

    function onEditInfomation() {
        showRightPanel('info-edit-panel');
    }

    function clearInformation() {
        document.getElementById('info_thumb_img').src = '';
        document.getElementById('info_thing_img').src = '';
        document.getElementById('info_name').innerText = '';
        document.getElementById('info_device_name').innerText = '';
        document.getElementById('info_date').innerText = '';
        //update thing's edit panel
        document.getElementById('info_edit_name').value = '';
        document.getElementById('info_edit_device_name').value = '';
        document.getElementById('info_edit_about').value = '';


        $("#info_edit_device_name").val($("#info_edit_device_name option:first").val()).trigger('change');
        $("#info_edit_kind").val($("#info_edit_kind option:first").val()).trigger('change');

        _tblAreaNotify.clear();
        _tblAreaNotify.draw();
    }

    var _tblAreaNotify = $('#table_area_notify').DataTable({
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
                width: '160px',
                className: "dt-center"
            },
            {
                targets: [1], //first column 
                orderable: false, //set not orderable
                width: '160px',
                className: "dt-action"
            }        
        ]
    });

    function onEditDevice(id)
    {
        var ele = _things[id];
        if(ele==null) return;
        if(ele.marker != null)
        {
            _map.setZoom(12);
            _map.setCenter(ele.marker.getPosition());
        }
        _curThing = ele.marker.customInfo;
        onThingInfomation();
    }

    function onDeleteDevice(id)
    {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this device information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger m-l-10',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                url: "{{ url('/api/user/del_device')}}",
                data: {
                    token: "{{$token}}",
                    id: id
                },
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 200) {
                        swal("Remove!", "", "success");
                        showDevices();
                    } else {
                        swal("Error!", data.message, "error");
                    }                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Error!", "", "error");
                }
            });
        }, function(dismiss) {});        
    }    

    function onThingInfomation() {
        if (_curThing == null) {
            clearInformation();
            onCloseRightPanel();
            return;
        }

        //update thing's info
        document.getElementById('info_thumb_img').src = _curThing.thumb;
        document.getElementById('info_thing_img').src = _curThing.image;

        //mornitoring setting
        var url = "{{url('')}}";
        contents = '';
        for (let i = 0; i < 5; i++) {
            if (_curThing.settings & Math.pow(2, i))
                contents += '<img src="' + url + '/assets/images/app/setting_' + i + '.svg" class="thumb-sm" alt="image">';
        }
        document.getElementById('info_setting_imgs_4_8').innerHTML = contents;

        //name, device name.
        document.getElementById('info_name').innerText = _curThing.name;
        document.getElementById('info_device_name').innerText = _curThing.device;
        document.getElementById('info_date').innerText = _curThing.updated;


        //update thing's edit panel
        document.getElementById('info_edit_name').value = _curThing.name;
        $('#info_edit_device_name').val(_curThing.device_id).trigger('change');

        document.getElementById('info_edit_about').value = _curThing.about;
        $('#info_edit_kind').val(_curThing.kind).trigger('change');

        //update settings
        for (let i = 0; i < 5; i++) {
            if (_curThing.settings & Math.pow(2, i))
                $('#info_setting_chk_' + i).prop('checked', true);
            else
                $('#info_setting_chk_' + i).prop('checked', false);
        }
        $('#info_setting_temperature_range').val(_curThing.temperature_range);

        //update area notifys
        //
        _tblAreaNotify.clear();
        for (let i = 0; i < _curThing.area_notify.length; i++) {
            var getOut = '',
                getIn = '',
                notArrived = '';
            var area_id = _curThing.area_notify[i].area_id;
            var col_0 = _curThing.area_notify[i].area_name;
            if (_curThing.area_notify[i].get_out == 1)
                getOut = 'checked';
            if (_curThing.area_notify[i].get_in == 1)
                getIn = 'checked';
            if (_curThing.area_notify[i].not_arrived == 1)
                notArrived = 'checked';
            var col_1 = '<div class="row">' +
                '<div class="col-xs-4">' +
                '<div class="checkbox checkbox-warning checkbox-circle chk-in-table">' +
                '<input type="checkbox"' + 'id="chk_area_notify_' + area_id + '_0" ' + getOut + '><label></label>' +
                '</div>' +
                '</div>' +
                '<div class="col-xs-4">' +
                '<div class="checkbox checkbox-success checkbox-circle chk-in-table">' +
                '<input type="checkbox"' + 'id="chk_area_notify_' + area_id + '_1" ' + getIn + '><label></label>' +
                '</div>' +
                '</div>' +
                '</div>';

            _tblAreaNotify.row.add([col_0, col_1]);
        }
        _tblAreaNotify.draw();

        console.log("onThingInfomation");
        onRightLeafItem('info-panel');
    }


    //device list
    var _tblDevicesAll = $('#table_devices_all').DataTable({
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
                width: '60px',
                className: "dt-action"
            },
            {
                targets: [1], //first column 
                orderable: true, //set not orderable
                width: '260px',
                className: "dt-center"
            }             
        ]
    });



    function displayDevices(data) {
        var url = "{{url('')}}";
        _tblDevicesAll.clear();

        for (let i = 0; i < data.length; i++) {
            var col1 = '<div class="row devicelist-item">' +
                // '<div class="col-xs-2">' +
                // '<img class="thumb-sm marker-img" src="' + data[i].thumb_image + '">' +
                // '</div>' +
                '<div class="col-xs-7">' + data[i].name +
                '<div>';
            for (let j = 0; j < 5; j++) {
                if (data[i].monitor_settings & Math.pow(2, j))
                    col1 += '<img class="content-img" src="' + url + '/assets/images/app/setting_' + j + '.svg">';
            }
            // col1 += '</div>';
            // col1 += '<div>';
            // for (let j = 3; j < 8; j++) {
            //     if (data[i].notify_settings & Math.pow(2 , j))
            //         col1 += '<img class="content-img" src="' + url + '/assets/images/app/rule_type_' + (j+1) + '.svg">';
            // }
            var col3 = '<div class="pull-right"><a href="javascript:void(0)" class="on-default edit-row" ' +
                    'onclick="onEditDevice(' + data[i].id + ')" title="Edit" ><i class="fa fa-pencil"></i></a><span> </span>' +
                	'<a href="javascript:void(0)" class="on-default remove-row" ' +
                	'onclick="onDeleteDevice('  + data[i].id +  ')" title="Remove" ><i class="fa fa-trash-o text-danger"></i></a></div>';

            col1 += '</div>' +
                '</div>' +
                '<div class="col-xs-5 text-right">' + col3 + 
                '<p class="device-name">' + data[i].device_name + '</p>' +
                '</div>' +
                '</div>';

            let imgClass = '';
            let label = '';
            if (data[i].state == 'medium') {
                label = ' ';
                imgClass = 'img-circle bg-warning';
            } else if (data[i].state == 'critical') {
                label = '  ';
                imgClass = 'img-circle bg-danger';
            }
            col2 = '<a href="javascript:;" onclick="onGotoDevice(' + data[i].id + ');"><p>' + label + '</p>' +
                '<img class="m-t-10 thumb-sm ' + imgClass + '" src="' + data[i].thumb_image + '"></a>';

            _tblDevicesAll.row.add([col2, col1]);
        }
        _tblDevicesAll.draw();

        onRightLeafItem('devices-panel');
    }

    function showDevices() {
        $.ajax({
            url: "{{ url('/api/user/devices')}}",
            data: {
                token: "{{$token}}",
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == 200)
                    displayDevices(data.data);
                else
                    swal("Error!", data.message, "error");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal("Error!", "", "error");
            }
        });
    }

    function onGotoDevice(id)
    {
        var ele = _things[id];
        if(ele == null) return;

        if(ele.marker != null)
        {
            _map.setZoom(12);
            _map.setCenter(ele.marker.getPosition());
        }
    }
</script>
@endsection