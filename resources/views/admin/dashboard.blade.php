{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">CPU Traffic</span>
          <span class="info-box-number">
            0
            <small>%</small>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-fw fa-newspaper"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Article</span>
            <span class="info-box-number">{{ $post->count() }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-fw fa-folder-open "></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Category</span>
          <span class="info-box-number">{{ $category->count() }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Members</span>
          <span class="info-box-number">{{ $user->count() }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <div class="row">
    <div class="col-12 col-sm-6 col-md-4">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Recently Article</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                @php($i = 1)
                @foreach ($post as $item)
                    <li class="item">
                        <div class="product-img">
                        <img src="{{ !is_null($item->img)? '/uploads/'.$item->img : \setting('noimage') }}" alt="Product Image" class="img-size-50">
                        </div>
                        <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">{{ $item->categories->first()->title }}
                            <span class="badge badge-warning float-right">{{$item->view_count}}</span></a>
                        <span class="product-description">
                            {{$item->title}}
                        </span>
                        </div>
                    </li>
                @if($i==4)
                @break
                @endif
                @php ($i++)
                @endforeach
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="{{ route('post.index') }}" class="uppercase">View All Products</a>
            </div>
            <!-- /.card-footer -->
          </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-4">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Category</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                @php($i = 1)
                @foreach ($category as $item)
                    <li class="item">
                        <div class="product-img">
                        <img src="{{ !is_null($item->img)? '/uploads/'.$item->img : \setting('noimage') }}" alt="Product Image" class="img-size-50">
                        </div>
                        <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">{{ $item->title }}
                            <span class="badge badge-warning float-right">{{$item->posts->count()}}</span></a>
                        <span class="product-description">
                            {{$item->description}}
                        </span>
                        </div>
                    </li>
                @if($i==4)
                @break
                @endif
                @php ($i++)
                @endforeach
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="{{ route('category.create') }}" class="uppercase">View All Category</a>
            </div>
            <!-- /.card-footer -->
          </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-4">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Latest Members</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="users-list clearfix">
                @php($i = 1)
                @foreach ($user as $item)
                <li>
                    <img src="{{ !is_null($item->img)? '/uploads/'.$item->img : \setting('noimage') }}" alt="User Image" class="img-size-64">
                    <a class="users-list-name" href="#">{{ $item->name }}</a>
                    <span class="users-list-date">{{ $item->job['name'] }}</span>
                </li>
                @if($i==8)
                @break
                @endif
                @php ($i++)
                @endforeach
              </ul>
              <!-- /.users-list -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="{{ route('user.index') }}">View All Users</a>
            </div>
            <!-- /.card-footer -->
          </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
@stop

@section('js')
@stop
