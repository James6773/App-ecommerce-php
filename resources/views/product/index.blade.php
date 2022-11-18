@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('New Product') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('product.store') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" 
                                                type="text" 
                                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                                name="name" value="{{ old('name') }}" 
                                                required 
                                                autocomplete="name"
                                                autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Description And Specifications') }}</label>

                                    <div class="col-md-6">
                                        <textarea
                                                rows="5"
                                                class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                                                name="description" 
                                                value="{{ old('description') }}" 
                                                required 
                                                autocomplete="description"></textarea>

                                        @if ($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" 
                                        class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                                    <div class="col-md-6">
                                        <input  type="number" 
                                                class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" 
                                                name="price" 
                                                value="{{ old('price') }}" 
                                                required 
                                                autocomplete="price"
                                                autofocus>

                                        @if ($errors->has('price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" 
                                        class="col-md-4 col-form-label text-md-right">{{ __('Inventory') }}</label>

                                    <div class="col-md-6">
                                        <input  type="number" 
                                                class="form-control{{ $errors->has('inventory') ? ' is-invalid' : '' }}" 
                                                name="inventory" 
                                                value="{{ old('inventory') }}" 
                                                required 
                                                autocomplete="inventory"
                                                autofocus>

                                        @if ($errors->has('inventory'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('inventory') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                                    <div class="col-md-6">
                                        <select name="category_id" 
                                                class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}"  >
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">
                                                    {{$category->name}}
                                                </option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('category_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('category_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Brand') }}</label>

                                    <div class="col-md-6">
                                        <select name="brand_id" 
                                                class="form-control{{ $errors->has('brand_id') ? ' is-invalid' : '' }}"  >
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">
                                                    {{$brand->name}}
                                                </option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('brand_id'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('brand_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Image Url') }}</label>

                                    <div class="col-md-6">
                                        <input type="url" 
                                                class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" 
                                                name="image" value="{{ old('image') }}" 
                                                required 
                                                autocomplete="image">

                                        @if ($errors->has('image'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Create') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if(!empty($products))
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Inventory</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Seller</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->inventory }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ $product->brand->name }}</td>
                                                <td>{{ $product->seller->name }}</td>
                                                <td>
                                                    <a class="btn btn-success btn-sm" 
                                                       >
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                     @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
