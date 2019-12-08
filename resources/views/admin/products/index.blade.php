@extends('layouts.app', [
    'namePage' => 'Icons',
    'class' => 'sidebar-mini',
    'activePage' => 'icons',
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">100 Awesome Nucleo Icons</h5>
            <p class="category">Handcrafted by our friends from
              <a href="https://nucleoapp.com/?ref=1712">NucleoApp</a>
            </p>
          </div>
          <div class="card-body all-icons">
            <div class="row">
              @foreach($products as $product)
              <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                <div class="font-icon-detail">
                  @if($product->image)
                    @if(file_exists('images/'.$product->image->filename))
                      <img src="/images/{{$product->image->filename}}" class="img-fluid">
                    @else
                      <img src="/images/placeholder.jpg" class="img-fluid">
                    @endif
                  @endif
                  <p>{{ $product->name }}</p>
                </div>
              </div>
              @endforeach
            </div>
          </div>

          <div class="pagination">
            {{ $products->links() }}
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection