@extends('users.template')
@section('user_content')
    @if(count($products)>=1)
    
    <div class="category mt-3">
        <div class="row">
            @foreach($products as $product)
            <div class="col-md-12">
            <div class="product" product-id="{{$product->id}}">
                <div class="content in">
                    <div class="banner" style="background:url('{{url('/images/products/'.$product->billboard)}}')">
                    </div>
                    <h3 class="title">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>
                                    {{$product->title}}
                                </h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <h3 class="amount" amount="{{$product->amount}}" currency="{{$product->currency}}">
                                    
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

                                </h3>
                            </div>
                        </div>
                    </h3>
                    <p class="text-muted text-small description">
                        {{$product->description}}
                    </p>
                    
                    
                    <label>Where you want to execute your order</label>
                    <select name="select_city" class="form-control">
                        <option>Zúrich</option>
                        <option>Ginebra</option>
                        <option>Basilea</option>
                    </select>

                    <div v-if="select_city!=null">
                        <br>
                        <button @click="buy" class="btn-sb" v-if="loading==0">
                            Buy product
                        </button>

                        <button class="btn-sb" v-if="loading==1">
                            LOADING
                        </button>
                    </div>
                </div>
            </div>
            </div>
            @endforeach
        </div>
    </div>

    @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger text-danger">
                    The requested product does not exist, please check and try again.
                </div>
            </div>
        </div>
    @endif



    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script>
    <script>

        $(document).ready(function(){
            const app = new Vue({
                el: '.category',
                data: function () {
                    var url = $('meta[name="site_url"]').attr('content');
                    return {
                        url: url,
                        loading: 0,
                        select_city: 'Zúrich'
                    }
                },
                
                methods: {
                    buy: function () {
                        vm = this;

                        var amount = parseFloat($('.amount').attr('amount'));
                        var currency = $('.amount').attr('currency');
                        var city = $('select[name="select_city"]').find(":selected").text();
                        
                        vm.loading = 1;

                        $.ajax({
                            type: "post",
                            url: vm.url+"/product/register_transaction",
                            data: {
                                amount: amount,
                                currency: currency,
                                city: city,
                                product_id: $('.product').attr('product-id')
                            },
                            dataType: "json",
                            success: function (response) {
                                console.log(response);

                                vm.loading = 0;
                                
                                if (response.error==true) {
                                    $('.errortrue').remove();
                                    $('.product').after(`
                                        <div class="alert alert-danger text-danger errortrue" style="margin-top: 10px;">
                                            ${response.response}
                                        </div>    
                                    `); 
                                } else {
                                    $('.errortrue').remove();
                                    $('.product').after(`
                                        <div class="alert alert-success text-success errortrue" style="margin-top: 10px;">
                                            ${response.response}
                                        </div>    
                                    `); 
                                }
                            }
                        });
                    }
                }
            });
        });
    </script>

    <style>
        .category .product {
          max-height: initial;
          min-height: 500px !important;
            
        }
    </style>
@endsection