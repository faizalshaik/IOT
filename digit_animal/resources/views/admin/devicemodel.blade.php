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
            <h4 class="page-title">Device Models</h4>
            <ol class="breadcrumb"> </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <div class="row">
                    <div class="btn-group pull-right">
                        <div class="m-b-10">
                            <button id="addToTable" class="btn btn-default waves-effect waves-light" onclick="addNew();">Add New <i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <table id="table1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Kind</th>
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
    <h4 class="custom-modal-title">Add/Edit Device Model</h4>
    <div class="custom-modal-text text-left">
        <div class="profile-detail card-box">
            <form class="form-horizontal" role="form" style="width:480px;">
                <input type="hidden" id="id" name="id" value="" />
                <div class="row">
                    <div class="form-group has-success">
                        <label class="col-md-3 control-label">Name*</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" id="name" name="name">
                        </div>
                    </div>

                    <div class="form-group has-success">
                        <label class="col-md-3 control-label">Brand*</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" id="brand" name="brand">
                        </div>
                    </div>

                    <div class="form-group has-success">
                        <label class="col-md-3 control-label">Kind*</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" id="kind" name="kind">
                        </div>
                    </div>

                    <div>
                        <button type="button" class="btn btn-pink btn-custom btn-rounded waves-effect waves-light" onclick="onSave();">Save</button>
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
        brand: $("#brand"),
        kind: $("#kind")
    }

    function clearData() {
        $dom.id.val("");
        $dom.name.val("");
        $dom.brand.val("");
        $dom.kind.val("");
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
            serverSide: true,
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
                orderable: false, //set not orderable
                className: "dt-center"
            }
        ], "{{ url('/api/admin/devicemodels') }}"
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
            url: "{{ url('/api/admin/edit_devicemodel') }}",
            data: {
                id: $dom.id.val(),
                name: $dom.name.val(),
                brand: $dom.brand.val(),
                kind: $dom.kind.val()
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
            url: "{{ url('/api/admin/get_devicemodel')}}",
            data: {
                id: _idx
            },
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                if(data.status==200)
                {
                    let device = data.data;
                    $dom.id.val(device.id);
                    $dom.name.val(device.model_name);
                    $dom.brand.val(device.brand);
                    $dom.kind.val(device.kind);

                    Custombox.open({
                        target: "#eidt-modal",
                        effect: "fadein",
                        overlaySpeed: "200",
                        overlayColor: "#36404a"
                    });
                }
                else
                {
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
        }).then( function() {
                $.ajax({
                    url: "{{ url('/api/admin/del_devicemodel')}}",
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
           },function (dismiss){});
    }
</script>

@endsection