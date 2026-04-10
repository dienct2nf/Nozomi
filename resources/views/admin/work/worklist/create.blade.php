{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', $text)

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('work.worklist.index') }}">Danh sách công việc</a></li>
        <li class="breadcrumb-item active" aria-current="page">Thêm công việc hàng ngày</li>
    </ol>
</nav>
@stop
@section('content')
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <span>Thêm công việc hàng ngày</span>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif
                <form action="{{ route('work.worklist.store_multiple') }}" method="POST">
                    {{csrf_field()}}
                    <section>
                        <div class="panel panel-footer">
                            <table class="table table-bordered" id="crud_table">
                                <thead>
                                    <tr>
                                        <th width="20%">Tên công việc</th>
                                        <th>Mô tả công việc</th>
                                        <th width="10%">Phòng Ban</th>
                                        <th width="10%">Ngày bắt đầu</th>
                                        <th width="10%">Ngày kết thúc</th>
                                        <th width="5%">
                                            <a href="#" class="btn btn-primary addRow">
                                                <i class="material-icons">Thêm</i>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                @if(old('row')!= '')
                                    <tbody class="original-tbody-destination" id="original-tbody-destination">
                                        <?php
                                        $old_row = old('row');
                                        $rowReplace = count($old_row);
                                        ?>
                                        @foreach($old_row as $key=>$value)
                                            <tr class="num-row main_data validation" id="num-row-{{$key}}">
                                                <td>
                                                    <input type="hidden" name="row[{{$key}}][order]" value="{{ $value['order'] }}">
                                                    <div class="form-group {{ $errors->has("row.$key.title") ? 'has-error' : '' }}">
                                                        <input type="text" name="row[{{$key}}][title]" class="form-control title" id="title" value="{{ $value['title'] }}">
                                                        <span class="text-danger">{{ $errors->first("row.$key.title") }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group {{ $errors->has("row.$key.description") ? 'has-error' : '' }}">
                                                        <textarea rows="3" type="text" name="row[{{$key}}][description]" class="form-control description" id="description-row-{{$key}}">{{ $value['description'] }}</textarea>
                                                        <span class="text-danger">{{ $errors->first("row.$key.description") }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group {{ $errors->has("row.$key.department_id") ? 'has-error' : '' }}">
                                                        <select type="text" name="row[{{$key}}][department_id]" class="form-control department_id" id="department_id">
                                                            @foreach ($listDepartment as $item)
                                                                @if (!empty(auth()->user()) && auth()->user()->department_id == $item->id)
                                                                        @if ($item->parent_id == null)
                                                                            <option value="{{ $item->id }}" {{ $value['department_id'] == $item->id? 'selected' : '' }}>{{ $item->title }} </option>
                                                                        @endif
                                                                        @if ($item->children()->count() > 1)
                                                                            @foreach ($item->children as $row)
                                                                                <option value="{{ $row->id }}" {{ $value['department_id'] == $row->id? 'selected' : '' }}>--- {{ $row->title }} </option>
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
                                                        <span class="text-danger">{{ $errors->first("row.$key.department_id") }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group {{ $errors->has("row.$key.start_at") ? 'has-error' : '' }}">
                                                    <input type="text" name="row[{{$key}}][start_at]" class="form-control init-inputmask" id="ngaybatdau{{$key}}" value="{{ $value['start_at'] }}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                                        <span class="text-danger">{{ $errors->first("row.$key.start_at") }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group {{ $errors->has("row.$key.end_at") ? 'has-error' : '' }}">
                                                        <input type="text" name="row[{{$key}}][end_at]" class="form-control init-inputmask" id="ngayketthuc{{$key}}" value="{{ $value['end_at'] }}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                                                        <span class="text-danger">{{ $errors->first("row.$key.end_at") }}</span>
                                                    </div>
                                                </td>
                                                <td><a href="#" class="btn btn-danger remove"><i class="material-icons">Xóa</i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @else
                                    <tbody class="original-tbody-destination" id="original-tbody-destination">
                                    </tbody>
                                @endif
                                <tfoot>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td><input type="submit" value="Lưu lại" class="btn btn-success submit" id="submit"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </section>
                </form>
            </div>
        </div>
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
@section('js')
<script src="/vendor/input-mask/moment.min.js"></script>
<script src="/vendor/input-mask/jquery.inputmask.bundle.min.js"></script>
<script src="/vendor/datepicker/bootstrap-datepicker.min.js"></script>
<script src="/vendor/ckeditor4/ckeditor.js"></script>

<script type="text/javascript">
    var app = new Loader();
    var int = "{{ $rowReplace }}";
    var today = "{{ date('d/m/Y') }}";
    var options = app.appendCkeditor();
    function addRow(){
            var tr='<tr class="table_field main_data " id="table_field-'+ (int) +'"><input type="hidden" name="row['+ (int) +'][order]" value="'+ (int) +'">'+
                '<td><input type="text" name="row['+ (int) +'][title]" class="form-control title" id="title"></td>'+
                '<td><textarea rows="3" type="text" name="row['+ (int) +'][description]" class="form-control textarea" id="textarea-'+ (int) +'"></textarea></td>'+
                '<td><select type="text" name="row['+ (int) +'][department_id]" class="form-control department_id" id="department_id"> @foreach ($listDepartment as $item) @if ($item->parent_id == null) <option value="{{ $item->id }}">{{ $item->title }} </option> @endif @if ($item->children()->count() > 1) @foreach ($item->children as $row) <option value="{{ $row->id }}">--- {{ $row->title }} </option> @endforeach @endif @endforeach</select></td>'+
                '<td><input type="text" value="'+today+'" name="row['+ (int) +'][start_at]" class="form-control init-inputmask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="ngaybatdau-'+ (int) +'" data-mask></td>'+
                '<td><input type="text" value="'+today+'" name="row['+ (int) +'][end_at]" class="form-control init-inputmask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="ngayketthuc-'+ (int) +'" data-mask></td>'+
                '<td><a href="#" class="btn btn-danger remove"><i class="material-icons">Xóa</i></a></td>'+
                '</tr>';
            $('.original-tbody-destination').append(tr);
                CKEDITOR.replace('textarea-'+ (int), options);
                int++;
                initInputmaskDateTime();
    };
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
    $(function() {
        @if(old('row') == '')
            $('.addRow').trigger("click");
            @else
            initInputmaskDateTime();
            @foreach($old_row as $key=>$value)
                CKEDITOR.replace('description-row-{{$key}}', options);
            @endforeach
        @endif
    });
    $('.addRow').on('click',function(){
        addRow();
    });

    $(document).on('click', '.remove', function(){
        var delete_row = $(this).data(".table_field");
            $(this).parent().parent().remove();
        });
</script>
@stop

