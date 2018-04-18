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
                                    {{number_format($product->amount, 10, ',', '.')}} SBB - Token
                                </h3>
                            </div>
                        </div>
                    </h3>
                    <p class="text-muted text-small description">
                        {{$product->description}}
                    </p>
                    <button @click="buy" class="btn-sb" v-if="loading==0">
                        Buy product
                    </button>
                    <button class="btn-sb" v-if="loading==1">
                        LOADING
                    </button>
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
                        loading: 0
                    }
                },
                
                methods: {
                    buy: function () {
                        vm = this;

                        var amount = parseFloat($('.amount').attr('amount'));
                        var currency = $('.amount').attr('currency');
                        
                        vm.loading = 1;

                        $.ajax({
                            type: "post",
                            url: vm.url+"/product/register_transaction",
                            data: {
                                amount: amount,
                                currency: currency,
                                product_id: $('.product').attr('product-id')
                            },
                            dataType: "json",
                            success: function (response) {
                                vm.loading = 0;
                                console.log(response);
                                
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

@endsection