@extends('users.template')
@section('user_content')

    @if(count($category)>=1)
    @php
        $category = $category[0];
    @endphp
    <div class="category">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    {{$category->name}}
                </h3>
            </div>
        </div>
    </div>

    @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger text-danger">
                    We do not find categories for the search criteria
                </div>
            </div>
        </div>
    @endif

    @if(count($products)>=1)
    
    <div class="category mt-3">
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3">
            <div class="product">
                <a class="content" href="{{url('/product/'.str_slug($product->title))}}">
                    <div class="banner" style="background:url('{{url('/images/products/'.$product->billboard)}}')">
                    </div>
                    <h6 class="title">{{$product->title}}</h6>
                    <p class="text-muted text-small description">
                        {{str_limit($product->description, 80)}}
                    </p>
                    <p class="price">
                        {{number_format($product->amount, 10, ',', '.')}} SBB - Token
                    </p>
                </a>
            </div>
            </div>
            @endforeach
        </div>
    </div>

    @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger text-danger">
                    We do not find products for the selected category.
                </div>
            </div>
        </div>
    @endif

@endsection