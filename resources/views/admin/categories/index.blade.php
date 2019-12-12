@extends('layouts.app', [
    'namePage' => 'Categories',
    'class' => 'sidebar-mini',
    'activePage' => 'categories',
    'activeNav' => '',
])

@section('content')
  <div class="panel-header">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">{{ __('Category') }}</h4>
            <div class="col-12 mt-2">
              @include('alerts.success')
              @include('alerts.errors')
            </div>

            <div class="ajax-alerts"></div>

            <form id="add-category" method="post" action="{{ route('categories.store') }}" autocomplete="off">
              @csrf
              <div class="row">
                <div class="col-sm-10 form-group">
                  <input type="text" class="form-control" placeholder="Category name..." name="name" required>
                </div>
                <div class="col-sm">
                  <input type="submit" class="btn btn-primary" value="Add">
                </div>
              </div>
            </form>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            <table id="datatable" class="table table-striped table-bordered categories" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Creation date') }}</th>
                  <th class="disabled-sorting text-right">{{ __('Actions') }}</th>
                </tr>
              </thead>
              
              <tbody>
                @foreach($categories as $category)
                  <tr id="cat{{$category->id}}">
                    <td>{{$category->name}}</td>
                    <td>{{ $category->created_at->diffForHumans() }}</td>
                      <td class="text-right">
                      <a type="button" href="{{route("categories.edit",$category)}}" rel="tooltip" class="btn btn-success btn-icon btn-sm " data-original-title="" title="">
                        <i class="now-ui-icons ui-2_settings-90"></i>
                      </a>
                      <form class="deletecategory" action="{{ route('categories.destroy', $category) }}" method="post" style="display:inline-block;">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <input type="submit" value="X" class="btn btn-danger btn-sm">
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>
      <!-- end col-md-12 -->
    </div>
    <!-- end row -->
  </div>
@endsection