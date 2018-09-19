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
                        @php
                            $client = new \GuzzleHttp\Client();
                            $gas_amount = $client->get('https://api.coinmarketcap.com/v1/ticker/gas/?convert=CHF')->getBody();
                            $gas_amount = json_decode($gas_amount);
                            
                            $product_amount['gas'] = $product->amount;
                            $product_amount['chf'] = $product->amount * $gas_amount[0]->price_chf;

                        @endphp
                        {{number_format($product_amount['gas']*100000, 3, ',', '.')}} SBB - Token
                        <br>
                        {{number_format($product_amount['chf']*100000, 3, ',', '.')}} CHF                    
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