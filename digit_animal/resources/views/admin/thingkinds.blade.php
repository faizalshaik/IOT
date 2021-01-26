@extends('layouts.admin')

@section('header')
<link href="{{ url('assets/plugins/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/plugins/datatables/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/plugins/datatables/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/plugins/datatables/scroller.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/plugins/datatables/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/plugins/datatables/fixedColumns.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/plugins/custombox/css/custombox.css')}}" rel="stylesheet">

<link href="{{ url('assets/plugins/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" />


<link href="{{ url('assets/plugins/bootstrap-sweetalert/sweet-alert.css')}}" rel="stylesheet" type="text/css">
@endsection



@section('content')
<div class="container">

    <div class="row">
        <div class="col-sm-6">
            <h4 class="page-title">Things</h4>
            <ol class="breadcrumb"> </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <div class="row">
                    <div class="btn-group pull-right">
                        <div class="m-b-10">
                            <button id="addToTable" class="btn btn-default waves-effect waves-light" onclick="addNew();">Add Area <i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <table id="table1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Descr</th>
                            <th>Thumb</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> <!-- container -->

<div id="eidt-modal" class="modal-demo col-sm-12" style="padding: 0px !important;">
    <button type="button" class="close" onclick="Custombox.close(); tbl.ajax.reload();">
        <span>&times;</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Add/Edit Kind</h4>
    <div class="custom-modal-text text-left">
        <div class="card-box">
            <form class="form-horizontal" role="form" action="{{url('api/admin/edit_thingkind')}}" style="width:480px;" method="post" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id" value="" />
                <div class="row">

                    <lavel>Image *:</lavel>
                    <div class="form-group has-success">
                        <div class="col-md-3">
                            <img class="img-responsive thumb-sm pull-right" id="kindPic" src="{{url('uploads/kind-imgs/default.jpg')}}">
                        </div>                            
                        <div class="col-md-9">
                            <input type="file" class="form-control  btn btn-default" name="kind_pic" id="kind_pic" data-buttonname="btn-primary" accept="image/*">
                        </div>
                    </div>

                    <lavel>Marker [OK] *:</lavel>
                    <div class="form-group has-success">
                        <div class="col-md-3">
                            <img class="img-responsive thumb-sm pull-right"  style="width:20px !important;" id="img_marker_ok" src="{{url('uploads/kind-imgs/default.jpg')}}">
                        </div>                            
                        <div class="col-md-9">
                            <input type="file" class="form-control  btn btn-default" name="marker_ok" id="marker_ok" data-buttonname="btn-primary" accept="image/*">
                        </div>
                    </div>

                    <lavel>Marker  [Medium] *:</lavel>
                    <div class="form-group has-success">
                        <div class="col-md-3">
                            <img class="img-responsive thumb-sm pull-right" style="width:20px !important;" id="img_marker_medium" src="{{url('uploads/kind-imgs/default.jpg')}}">
                        </div>                            
                        <div class="col-md-9">
                            <input type="file" class="form-control  btn btn-default" name="marker_medium" id="marker_medium" data-buttonname="btn-primary" accept="image/*">
                        </div>
                    </div>
                    <lavel>Marker [Critical] *:</lavel>
                    <div class="form-group has-success">
                        <div class="col-md-3">
                            <img class="img-responsive thumb-sm pull-right"  style="width:20px !important;" id="img_marker_critical" src="{{url('uploads/kind-imgs/default.jpg')}}">
                        </div>                            
                        <div class="col-md-9">
                            <input type="file" class="form-control  btn btn-default" name="marker_critical" id="marker_critical" data-buttonname="btn-primary" accept="image/*">
                        </div>
                    </div>


                    <div class="form-group has-success">
                        <label class="col-md-3 control-label">Kind Name*</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" id="name" name="name">
                        </div>
                    </div>

                    <div class="form-group has-success">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" id="descr" name="descr">
                        </div>
                    </div>

                    <div class="text-center">
                        <!-- <button type="button" class="btn btn-pink btn-custom btn-rounded waves-effect waves-light" onclick="onSave();">Save</button> -->
                        <button type="submit" class="btn btn-pink btn-custom btn-rounded waves-effect waves-light">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
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

<script src="{{ url('assets/plugins/custombox/js/custombox.min.js')}}"></script>
<script src="{{ url('assets/plugins/custombox/js/legacy.min.js')}}"></script>


<script type="text/javascript">
    var $dom = {
        id: $("#id"),
        name: $("#name"),
        descr: $("#descr"),
        fileUpload: $("#kind_pic"),
        kindPic: $("#kindPic"),
        imgMarkerOk: $("#img_marker_ok"),
        imgMarkerMedium: $("#img_marker_medium"),
        imgMarkerCritical: $("#img_marker_critical"),

        markerOk: $("#marker_ok"),
        markerMedium: $("#marker_medium"),
        markerCritical: $("#marker_critical")
    }

    $dom.fileUpload.change(function() {
        if (typeof(FileReader) != "undefined") {
            var reader = new FileReader();
            reader.onload = function(e) {
                $dom.kindPic.attr("src", e.target.result);
            }
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            showMsg("Error", "This browser does not support FileReader.");
        }
    });    

    $dom.markerOk.change(function() {
        if (typeof(FileReader) != "undefined") {
            var reader = new FileReader();
            reader.onload = function(e) {
                $dom.imgMarkerOk.attr("src", e.target.result);
            }
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            showMsg("Error", "This browser does not support FileReader.");
        }
    });
    $dom.markerMedium.change(function() {
        if (typeof(FileReader) != "undefined") {
            var reader = new FileReader();
            reader.onload = function(e) {
                $dom.imgMarkerMedium.attr("src", e.target.result);
            }
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            showMsg("Error", "This browser does not support FileReader.");
        }
    });

    $dom.markerCritical.change(function() {
        if (typeof(FileReader) != "undefined") {
            var reader = new FileReader();
            reader.onload = function(e) {
                $dom.imgMarkerCritical.attr("src", e.target.result);
            }
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            showMsg("Error", "This browser does not support FileReader.");
        }
    });    




    function clearData() {
        $dom.id.val("");
        $dom.name.val("");
        $dom.descr.val("");
    }

    function initTable(tagId, cols, dataUrl) {
        var tblObj = $(tagId).DataTable({
            dom: "lfBrtip",
            buttons: [{
                extend: "copy",
                className: "btn-sm"
            }, {
                extend: "csv",
                className: "btn-sm"
            }, {
                extend: "excel",
                className: "btn-sm"
            }, {
                extend: "pdf",
                className: "btn-sm"
            }, {
                extend: "print",
                className: "btn-sm"
            }],
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
            columnDefs: cols,
            ajax: {
                url: dataUrl,
                type: "POST",
            },
        });
        return tblObj;
    }

    var tbl = initTable("#table1",
        [{
                targets: [0], //first column 
                orderable: true, //set not orderable
                className: "dt-center"
            },
            {
                targets: [1], //first column 
                orderable: true, //set not orderable
                className: "dt-center"
            },
            {
                targets: [2], //first column 
                orderable: true, //set not orderable
                className: "dt-center"
            },
            {
                targets: [3], //first column 
                orderable: true, //set not orderable
                className: "dt-center"
            }
        ], "{{ url('/api/admin/thingkinds') }}"
    );

    function addNew() {
        clearData();
        Custombox.open({
            target: "#eidt-modal",
            effect: "fadein",
            overlaySpeed: "200",
            overlayColor: "#36404a"
        });
    }


    function onSave() {
        Custombox.close();
        $.ajax({
            url: "{{ url('/api/admin/edit_thingkind') }}",
            data: {
                id: $dom.id.val(),
                area_name: $dom.name.val(),
                area_type: $dom.areatype.val()
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                tbl.ajax.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal("Error!", "", "error");
            }
        });
    }

    function onEdit(_idx) {
        clearData();
        $.ajax({
            url: "{{ url('/api/admin/get_thingkind')}}",
            data: {
                id: _idx
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if (data.status == 200) {
                    let kind = data.data;
                    $dom.id.val(kind.id);
                    $dom.name.val(kind.kind_name);
                    $dom.descr.val(kind.descr);
                    if(kind.thumb_image !="")
                        $dom.kindPic.attr("src", "{{url('')}}" + "/" + kind.thumb_image);
                    if(kind.marker_image_ok !="")
                        $dom.imgMarkerOk.attr("src", "{{url('')}}" + "/" + kind.marker_image_ok);
                    if(kind.marker_image_medium !="")
                        $dom.imgMarkerMedium.attr("src", "{{url('')}}" + "/" + kind.marker_image_medium);
                    if(kind.marker_image_critical !="")
                        $dom.imgMarkerCritical.attr("src", "{{url('')}}" + "/" + kind.marker_image_critical);
                    
                    //image

                    Custombox.open({
                        target: "#eidt-modal",
                        effect: "fadein",
                        overlaySpeed: "200",
                        overlayColor: "#36404a"
                    });
                } else {
                    swal("Error!", data.message, "error");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal("Error!", "", "error");
            }
        });
    }

    function onDelete(_idx) {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this user information!",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger m-l-10',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                url: "{{ url('/api/admin/del_thingkind')}}",
                data: {
                    id: _idx
                },
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    swal("Remove!", "", "success");
                    tbl.ajax.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal("Error!", "", "error");
                }
            });
        }, function(dismiss) {});
    }
</script>

@endsection