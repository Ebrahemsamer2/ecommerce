@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Edit product',
    'activePage' => 'editproduct',
    'activeNav' => '',
])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Product Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('products.index') }}" class="btn btn-primary btn-round">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    @include('alerts.errors')
                    <div class="card-body">
                        <form method="post" action="{{ route('products.update', $product) }}" autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <h6 class="heading-small text-muted mb-4">{{ __('Product information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ $product->name }}" required autofocus>
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>

                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                    <textarea name="description" id="input-description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="{{ __('Description') }}" required>{{ $product->description }}</textarea>

                                    @include('alerts.feedback', ['field' => 'description'])
                                </div>
                                    
                                <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-category_id">{{ __('Category') }}</label>
                                    <select name="category_id" id="input-category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}" required>
                                        <option value="0">Select Category</option>
                                        @foreach(\App\Category::orderBy('id', 'desc')->get() as $category)
                                            <option <?php if($product->category_id == $category->id) echo 'selected'; ?> value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                    @include('alerts.feedback', ['field' => 'category_id'])
                                </div>

                                <div class="form-group{{ $errors->has('quantity') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-quantity">{{ __('Quantity') }}</label>
                                    <input min="1" type="number" name="quantity" id="input-quantity" class="form-control{{ $errors->has('discount') ? ' is-invalid' : '' }}" placeholder="{{ __('Quantity') }}" value="{{ $product->quantity }}" required>

                                    @include('alerts.feedback', ['field' => 'quantity'])
                                </div>

                                <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-price">{{ __('Price') }}</label>
                                    <input min="5" type="number" name="price" id="input-price" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="{{ __('Price') }}" value="{{ $product->price }}" required>

                                    @include('alerts.feedback', ['field' => 'price'])
                                </div>

                                <div class="form-group{{ $errors->has('discount') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-discount">{{ __('Discount') }}</label>
                                    <input min="5" type="number" name="discount" id="input-discount" class="form-control{{ $errors->has('discount') ? ' is-invalid' : '' }}" placeholder="{{ __('Discount') }}" value="{{ $product->discount }}">

                                    @include('alerts.feedback', ['field' => 'discount'])
                                </div>

                                <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-image">{{ __('Image') }}</label>
                                    <input type="file" name="image" id="input-image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}">

                                    @include('alerts.feedback', ['field' => 'image'])
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection