@extends('layouts.app', [
    'namePage' => 'Products',
    'class' => 'sidebar-mini',
    'activePage' => 'products',
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">All Products</h5>
            <!-- <p class="category">Handcrafted by our friends from
              <a href="https://nucleoapp.com/?ref=1712">NucleoApp</a>
            </p> -->
          </div>
          <div class="card-body all-products">
            <div class="row">
              @foreach($products as $product)
              <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                <div class="product-detail">
                  @if($product->photo)
                    @if(file_exists('images/'.$product->photo->filename))
                      <img src="/images/{{$product->photo->filename}}" class="img-fluid">
                    @else
                      <img src="/images/placeholder.jpg" class="img-fluid">
                    @endif
                  @endif
                  <p>{{ $product->name }} <strong>${{ $product->price }}</strong></p>

                  <a type="button" href="{{route("products.edit", $product)}}" rel="tooltip" class="btn btn-success btn-icon btn-sm " data-original-title="" title="">
                    <i class="now-ui-icons ui-2_settings-90"></i>
                  </a>
                  <form action="{{ route('products.destroy', $product) }}" method="post" style="display:inline-block;" class ="delete-form">
                    @csrf
                    @method('delete')
                    <button type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm delete-button" data-original-title="" title="" onclick="confirm('{{ __('Are you sure you want to delete this product?') }}') ? this.parentElement.submit() : ''">
                      <i class="now-ui-icons ui-1_simple-remove"></i>
                    </button>
                  </form>

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