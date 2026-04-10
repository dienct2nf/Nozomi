{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Danh sách công việc hàng ngày')

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('label.dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Danh sách công việc hàng ngày</li>
        </ol>
    </nav>
@stop

@section('content')
@if ($message = Session::get('status'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>Danh sách công việc hàng ngày</span>
                    <div class="pull-right">
                        <a class="btn btn-danger btn-sm" href="{{ route('work.worklist.create') }}"> <span class="fa fa-table"></span>Thêm nhiều</a>
                        <button type="button" name="add" id="add_data" class="btn btn-success btn-sm">Thêm nhanh</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table data-order='[[ 0, "desc" ]]' class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên công việc</th>
                                    <th>Mô tả</th>
                                    <th>Phòng ban</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Người tạo</th>
                                    <th width="100px">{{ __('label.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="workModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" id="worklist_from">
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm nhanh</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <span id="form_output"></span>
                        <div class="form-group">
                            <label>Tên công việc</label>
                            <input type="text" name="title" id="title" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea rows="3" type="text" name="description" id="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Phòng ban</label>
                            <select type="text" name="department_id" class="form-control" id="department_id">
                                @foreach ($listDepartment as $item)
                                    @if (!empty(auth()->user()) && auth()->user()->department_id == $item->id)
                                            @if ($item->parent_id == null)
                                                <option value="{{ $item->id }}">{{ $item->title }} </option>
                                            @endif
                                            @if ($item->children()->count() > 1)
                                                @foreach ($item->children as $row)
                                                    <option value="{{ $row->id }}">--- {{ $row->title }} </option>
                                                @endforeach
                                            @endif
                                    @else
                                    @if ($item->parent_id == null)
                                                <option value="{{ $item->id }}">{{ $item->title }} </option>
                                            @endif
                                            @if ($item->children()->count() > 1)
                                                @foreach ($item->children as $row)
                                                    <option value="{{ $row->id }}">--- {{ $row->title }} </option>
                                                @endforeach
                                            @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Ngày bắt đầu</label>
                                <input type="text" name="start_at" class="form-control init-inputmask" id="start_at"
                                    value="{{ date('d/m/Y') }}" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Ngày kết thúc</label>
                                <input type="text" name="end_at" class="form-control init-inputmask" id="end_at"
                                    value="{{ date('d/m/Y') }}" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="worklist_id" id="worklist_id" value="" />
                        <input type="hidden" name="order" id="order" value="1"/>
                        <input type="hidden" name="method_action" id="method_action" value="insert"/>
                        <input type="submit" name="submit" id="action" value="Thêm" class="btn btn-info" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="/vendor/datepicker/bootstrap-datepicker.min.css">
<style>
    .cke_contents {
        max-height: 300px !important;
    }
</style>
@stop
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('js')
    <script src="/vendor/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="/vendor/ckeditor4/ckeditor.js"></script>
    <script>
        var app = new Loader();
        function initInputmaskDateTime() {
            $(".init-inputmask").each(function() {
                var id = $(this).attr('id');
                $('#'+id).datepicker({
                    todayHighlight: true,
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });
            });
        }
        $(function () {
            app.submitConfirm();
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                "ordering": false,
                ajax: {
                    "url": "{{ route('work.worklist.loadData') }}",
                    "type": "get",
                    "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [
                    {data: 'id', name: 'id', 'width': '30'},
                    {data: 'title', name: 'title', width: '180'},
                    {data: 'description', name: 'description', width: '100'},
                    {data: 'departments[0].title', name: 'departments[0].title',  width: '100'},
                    {data: 'start_at', name: 'start_at', width: '80'},
                    {data: 'end_at', name: 'end_at', width: '80'},
                    {data: 'author.name', name: 'author.name', width: '80'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $(function () {
                $(document).on('click', '#add_data', function(){
                    var department_id = $(this).attr("data-department_id");
                    setTimeout(function() {
                        $('#department_id').val(department_id).change();
                    },300);
                    $('#workModal').modal('show');
                    $('#worklist_from')[0].reset();
                    $('#form_output').html('');
                    $('#method_action').val('insert');
                    $('#button_action').val('insert');
                    $('#action').val('Thêm');
                    CKEDITOR.instances['description'].setData('');
                    initInputmaskDateTime();
                });

                $('#ngaybatdau, #ngayketthuc').datepicker({
                    todayHighlight: true,
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });
                $('#worklist_from').on('submit', function(event){
                    event.preventDefault();
                    var description = CKEDITOR.instances['description'].getData();
                    var form_data = {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        title: $('#title').val(),
                        description: description,
                        department_id: $('#department_id').val(),
                        start_at: $('#start_at').val(),
                        end_at: $('#end_at').val(),
                        order: 1,
                        worklist_id: $('#worklist_id').val(),
                        method_action: $('#method_action').val(),
                    }
                    $.ajax({
                        url: "{{ route('work.worklist.store') }}",
                        data: form_data,
                        type: 'POST',
                        datatype: 'JSON',
                        "headers": {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data)
                        {
                            data = $.parseJSON(data);
                            if((data.errors).length > 0)
                            {
                                var error_html = '';
                                for(var count = 0; count < data.errors.length; count++)
                                {
                                    error_html += '<div class="alert alert-danger">'+data.errors[count]+'</div>';
                                }
                                $('#form_output').html(error_html);
                            } else {
                                $('#form_output').html(data.success);
                                $('#worklist_from')[0].reset();
                                $('#action').val('Thêm');
                                setTimeout(function() {
                                    location.reload();
                                },300);
                            }
                        },
                        error: function () {
                        },
                        complete: function () {
                        }
                    })
            });
            });

            $(document).on('click', '.edit', function(){
                initInputmaskDateTime();
                var id = $(this).attr("data-id");
                var department_id = $(this).attr("data-department_id");
                $('#form_output').html('');
                $.ajax({
                    url:"/admin/work/worklist/getjson/"+id,
                    method: 'get',
                    dataType: 'json',
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:function(data)
                    {
                        var start = data.start_at;
                        var end = data.end_at;
                        $('#title').val(data.title);
                        CKEDITOR.instances['description'].setData(data.description);
                        $('#start_at').val(data.start_at_edit);
                        $('#end_at').val(data.end_at_edit);
                        $('#method_action').val('update');
                        $('#worklist_id').val(id);
                        $('#action').val('Lưu lại');
                        $('#workModal').modal('show');
                        setTimeout(function() {
                            $("#department_id").val(data.department_id).change();
                        },300);
                    }
                })
            });
        })
        jQuery(function () {
            jQuery('[data-toggle="tooltip"]').tooltip();
        })
    </script>
    <script>
        var app = new Loader();
        $(function () {
            var options = app.appendCkeditor();
            CKEDITOR.replace('description', options);
        });
    </script>
@stop
