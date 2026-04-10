{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::work')

@section('title', 'Danh sách công việc hằng ngày')

@section('content')
<nav class="navbar navbar-expand-md navbar-light bg-light nav-todolist">
    <a style="text-transform: uppercase" class="navbar-brand">
        @if (request()->date == 'month')
            {{ 'Tháng này' }} {{ request()->ngaybatdau.', '.request()->ngayketthuc }}
        @elseif (request()->date == 'week')
            {{ 'Tuần này' }} {{ request()->ngaybatdau.', '.request()->ngayketthuc }}
        @else
            {{ 'Hôm nay, '.sw_get_current_weekday() }}
        @endif
    </a>
    <a id="showDate" type="submit" class="btn btn-secondary btn-sm"><span class="fa fa-calendar"></span></a>
    <a style="margin-left: 5px;" href="/admin/work/worklist/todo/list?ngaybatdau={{ date('d/m/Y') }}&ngayketthuc={{ date("d/m/Y") }}&date=today" type="submit" name="submit" class="btn btn-secondary btn-sm">HÔM NAY</a>
    <a style="margin-left: 5px;" href="/admin/work/worklist/todo/list?ngaybatdau={{ \Carbon\Carbon::now()->startOfWeek()->format('d/m/Y') }}&ngayketthuc={{ \Carbon\Carbon::now()->endOfWeek()->format('d/m/Y') }}&date=week" type="submit" name="submit" class="btn btn-secondary btn-sm">TUẦN NÀY</a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav navbar-nav__color">
            @foreach ($listAllDepartment as $item)
                @if ($item->parent_id == null)
                    <a style="text-transform: uppercase" href="{{route('work.worklist.detailDepartment', $item->id)}}" class="nav-item nav-link">{{ $item->title }}</a>
                @endif
            @endforeach
        </div>
        <div class="navbar-nav ml-auto">
            @can('work-show')
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off"></i> {{ __('adminlte::adminlte.log_out') }}
            </a>
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                @if(config('adminlte.logout_method'))
                    {{ method_field(config('adminlte.logout_method')) }}
                @endif
                {{ csrf_field() }}
            </form>
                <a style="margin-left: 5px;" class="btn btn-secondary btn-sm" href="{{ route('work.worklist.create') }}" target="_blank"> <span class="fa fa-plus"></span> Thêm</a>
                @else
                <a href="/admin" class="nav-item nav-link">Đăng Nhập</a>
            @endcan
        </div>
    </div>
</nav>
<div id="dateModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Xem theo ngày</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="ngaybatdau_text">Ngày</span>
                                        </div>
                                        <input type="text" class="form-control" name="ngaybatdau" id="ngaybatdau" placeholder=""
                                            aria-describedby="ngaybatdau" value="{{ !empty(request()->ngaybatdau)? request()->ngaybatdau : date('d/m/Y') }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="ngayketthuc_text">Đến Ngày</span>
                                        </div>
                                        <input type="text" class="form-control" name="ngayketthuc" id="ngayketthuc" placeholder=""
                                            aria-describedby="ngayketthuc" value="{{ !empty(request()->ngayketthuc)? request()->ngayketthuc : date('d/m/Y') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="submit" id="action_view" value="Xem" class="btn btn-secondary" />
                        <a href="/admin/work/worklist/todo/list?ngaybatdau={{ date('d/m/Y') }}&ngayketthuc={{ date("d/m/Y") }}&date=today" type="submit" name="submit" class="btn btn-info">HÔM NAY</a>
                        <a href="/admin/work/worklist/todo/list?ngaybatdau={{ \Carbon\Carbon::now()->startOfWeek()->format('d/m/Y') }}&ngayketthuc={{ \Carbon\Carbon::now()->endOfWeek()->format('d/m/Y') }}&date=week" type="submit" name="submit" class="btn btn-info">TUẦN NÀY</a>
                        <a href="/admin/work/worklist/todo/list?ngaybatdau={{ date('01/m/Y') }}&ngayketthuc={{ date("t/m/Y", strtotime(date('Y-m-d'))) }}&date=month" type="submit" name="submit" class="btn btn-info">THÁNG NÀY</a>
                        {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row padding-top-work">
    @foreach ($listDepartment as $item)
        @if ($item->parent_id == null)
            <div class="col-md-6" id="listWork">
                <div class="card">
                    <div class="todo-wrapper">
                        <div class="todo-content">
                            <div class="department">
                                <div class="todo-header">
                                    @can('1work-create')
                                        <div class="add-circle" data-department_id="{{ $item->id }}">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    @else
                                        @if (!empty(auth()->user()) && auth()->user()->department_id)
                                            <div data-toggle="modal" data-target=".bd-example-modal-lg" class="add-circle" data-department_id="{{ auth()->user()->department_id }}">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        @endif
                                    @endcan
                                </div>
                                <div class="todo-content-title">
                                <a href="{{route('work.worklist.detailDepartment', $item->id)}}" target="_blank"> <h2>{{ $item->title }} </h2> </a>
                                <p class="task-report">{{ $item->worklists->count() }} Việc</p>
                                </div>
                            </div>
                            <ul class="todo-list">
                            @foreach ($item->worklists as $row)
                                <li class="task-item">
                                    <div class="panel-group wrap" id="accordion-{{$row->id}}" role="tablist"
                                        aria-multiselectable="true">
                                        <div class="panel">
                                            <div role="tab" id="headingOne-{{$row->id}}">
                                                <div class="listwork collapsed" role="button" data-toggle="collapse" data-parent="#accordion-{{$row->id}}"
                                                    href="#collapse-{{$row->id}}" aria-expanded="false" aria-controls="collapse-{{$row->id}}">
                                                    <i class="fa fa-fw fa-chevron-down"></i>
                                                    <i class="fa fa-fw fa-chevron-right"></i>
                                                    {{ $row->title }} <span class="text-right">{{ $row->created_at->format('H:i d/m/y') }} / {{ $row->updated_at->format('H:i d/m/y') }}<span>
                                                </div>
                                                <div class="task-action">
                                                    <span class="more">
                                                        @can('work-create')
                                                            <i data-id="{{ $row->id }}" data-department_id="{{ $item->id }}" style="color: #00c8e5" class="edit fa fa-edit"></i>
                                                            <a href="{{ route('work.worklist.ajaxDelete', $row->id) }}" id="deleteWork" data-id="{{ $row->id }}">
                                                                <i style="color: #FF6666" class="edit fa fa-trash"></i>
                                                            </a>
                                                        @else
                                                        {{-- @if (!empty(auth()->user()) && auth()->user()->department_id == $item->id) --}}
                                                        @if (!empty(auth()->user()) && auth()->user()->id == $row->user_id)
                                                            <i data-id="{{ $row->id }}" data-department_id="{{ $item->id }}" style="color: #00c8e5" class="edit fa fa-edit"></i>
                                                            <a href="{{ route('work.worklist.ajaxDelete', $row->id) }}" id="deleteWork" data-id="{{ $row->id }}">
                                                                <i style="color: #FF6666" class="edit fa fa-trash"></i>
                                                            </a>
                                                        @endif
                                                        @endcan
                                                    </span>
                                                    </div>
                                            </div>
                                            <div id="collapse-{{$row->id}}" class="panel-collapse in collapse" role="tabpanel"
                                                aria-labelledby="headingOne-{{$row->id}}">
                                                <div class="panel-body">{!! $row->description !!}</div>
                                            </div>
                                        </div>
                                        <!-- end of panel -->
                                    </div>
                                </li>
                            @endforeach
                            @php
                                $start = !empty(request()->ngaybatdau)? \Carbon\Carbon::createFromFormat('d/m/Y', request()->ngaybatdau)->format('Y-m-d') : date('Y-m-d');
                                $end = !empty(request()->ngayketthuc)? \Carbon\Carbon::createFromFormat('d/m/Y', request()->ngayketthuc)->format('Y-m-d') : date('Y-m-d');
                            @endphp
                            @if ($item->children()->count() > 0)
                                @foreach ($item->children as $row)
                                <li class="task-item">
                                    <div class="panel-group wrap" id="accordion-{{$row->id}}-group" role="tablist"
                                        aria-multiselectable="true">
                                        <div class="panel">
                                            <div role="tab" id="headingOne-{{$row->id}}-group">
                                                <div class="listwork collapsed pb" role="button" data-toggle="collapse" data-parent="#accordion-{{$row->id}}-group"
                                                    href="#collapse-{{$row->id}}-group" aria-expanded="false" aria-controls="collapse-{{$row->id}}-group">
                                                    <i class="fa fa-list-alt"></i>
                                                    @php
                                                    $count = $row->worklists()
                                                            ->where(function ($query) use ($start, $end) {
                                                                if ( $start == $end ) {
                                                                    $query->where('start_at', '<=', $start);
                                                                    $query->where('end_at', '>=', $end);
                                                                } else {
                                                                    $query->whereBetween('start_at', [$start, $end])
                                                                        ->orWhereBetween('end_at', [$start, $end]);
                                                                }
                                                            })->count()
                                                    @endphp
                                                    {{ $row->title }} <span class="job">({{ $count }} Việc)</span>
                                                </div>
                                            </div>
                                            <div id="collapse-{{$row->id}}-group" class="panel-collapse in collapse @if (!empty(auth()->user()) && auth()->user()->department_id == $row->id) show @endif " role="tabpanel"
                                                aria-labelledby="headingOne-{{$row->id}}-group">
                                                <div class="panel-body">
                                                    <ul class="listbophan">
                                                        @foreach ($row->worklists()
                                                            ->where(function ($query) use ($start, $end) {
                                                                if ( $start == $end ) {
                                                                    $query->where('start_at', '<=', $start);
                                                                    $query->where('end_at', '>=', $end);
                                                                } else {
                                                                    $query->whereBetween('start_at', [$start, $end])
                                                                        ->orWhereBetween('end_at', [$start, $end]);
                                                                }
                                                            })->get() as $list)
                                                            <li class="task-item children">
                                                                <div class="panel-group wrap" id="accordion-{{$list->id}}" role="tablist" aria-multiselectable="true">
                                                                    <div class="panel">
                                                                        <div role="tab" id="headingOne-{{$list->id}}">
                                                                            <div class="listwork" role="button" data-toggle="collapse" data-parent="#accordion-{{$list->id}}"
                                                                                href="#collapse-{{$list->id}}" aria-expanded="true" aria-controls="collapse-{{$list->id}}">
                                                                                <i class="fa fa-fw fa-chevron-down"></i>
                                                                                <i class="fa fa-fw fa-chevron-right"></i>
                                                                                {{ $list->title }} <span class="text-right">{{ $list->created_at->format('H:i d/m/y') }} / {{ $list->updated_at->format('H:i d/m/y') }}<span>
                                                                            </div>
                                                                            <div class="task-action">
                                                                                <span class="more">
                                                                                    @can('work-create')
                                                                                        <i data-id="{{ $list->id }}" data-department_id="{{ $item->id }}" style="color: #00c8e5" class="edit fa fa-edit"></i>
                                                                                        <a href="{{ route('work.worklist.ajaxDelete', $list->id) }}" id="deleteWork" data-id="{{ $list->id }}">
                                                                                           <i style="color: #FF6666" class="edit fa fa-trash"></i>
                                                                                        </a>
                                                                                    @else
                                                                                    @if (!empty(auth()->user()) && auth()->user()->id == $list->user_id)
                                                                                        <i data-id="{{ $list->id }}" data-department_id="{{ $item->id }}" style="color: #00c8e5" class="edit fa fa-edit"></i>
                                                                                        <a href="{{ route('work.worklist.ajaxDelete', $list->id) }}" id="deleteWork" data-id="{{ $list->id }}">
                                                                                            <i style="color: #FF6666" class="edit fa fa-trash"></i>
                                                                                        </a>
                                                                                    @endif
                                                                                    @endcan
                                                                                </span>
                                                                                </div>
                                                                        </div>
                                                                        <div id="collapse-{{$list->id}}" class="panel-collapse in collapse show" role="tabpanel"
                                                                            aria-labelledby="headingOne-{{$list->id}}">
                                                                            <div class="panel-body">{!! $list->description !!}</div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end of panel -->
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of panel -->
                                    </div>
                                </li>
                                @endforeach
                            @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
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
    <!-- /.modal-dialog -->
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/vendor/custom/css/work.css">
    <link rel="stylesheet" href="/vendor/datepicker/bootstrap-datepicker.min.css">
    <style>
        .cke_contents {
            max-height: 300px !important;
        }
    </style>
@stop

@section('plugins.Sweetalert2', true)
@section('js')
    <script src="/vendor/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="/vendor/ckeditor4/ckeditor.js"></script>
    <script>
        function initInputmaskDateTime() {
            $(".init-inputmask").each(function() {
                var id = $(this).attr('id');
                $('#'+id).datepicker({
                    todayHighlight: true,
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    autoShow:true,
                    showOn: "button",
                });
            });
        }
    $(function () {
            $(document).on('click', '.add-circle', function(){
                var department_id = $(this).attr("data-department_id");

                setTimeout(function() {
                    $('#department_id').val(department_id).change();
                },300);
                $('#workModal').modal('show');
                $('#worklist_from')[0].reset();
                $('#form_output').html('');
                $('#button_action').val('method_action');
                $('#method_action').val('insert');
                $('#action').val('Thêm');
                CKEDITOR.instances['description'].setData('');
                initInputmaskDateTime();

            });
            $(document).on('click', '#showDate', function(){

                $('#dateModal').modal('show');
                $("#ngaybatdau").focus();
                $('.datepicker').css('display', 'block');
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

    $(document).ready(function() {
        $("#goto").change(function(){
            if ($(this).val()!='') {
                window.location.href = $(this).val();
            }
        });
    });

    // delete
    $("body").on("click","#deleteWork",function(e){

            if (!confirm("Bạn chắc chắn muốn xóa công việc này?")) {
                return false;
            }
            e.preventDefault();
            var id = $(this).data("id");
            // var id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            var url = e.target;

            $.ajax({
                url: "/admin/work/worklist/delete/"+id,
                type: 'DELETE',
                data: {
                    _token: token,
                    _method: "DELETE",
                    id: id
                },
                success: function (response) {
                    Swal.fire(
                        'Thông báo!',
                        'Xóa thành công!',
                        'success'
                    )
                    setTimeout(function() {
                        location.reload();
                    },500);
                }
            });
            return false;
            });
        });
    </script>
    <script>
        var app = new Loader();
        $(function () {
            var options = app.appendCkeditor();
            CKEDITOR.replace('description', options);
        });
    </script>

@stop
