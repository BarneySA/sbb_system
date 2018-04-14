<div class="top_bar_transactions">
    <div class="row">
        <div class="col-12 col-md-1">
            <img src="{{App\User::auth()->qr}}" style="width: 100%;" alt="">
        </div>
        <div class="col-12 col-md-7">
            <h3>
                My wallet
                <span class="wallet_number">
                    {{App\User::auth()->getAddress}}
                </span>
            </h3>
        </div>
        <div class="col-6 col-md-2 text-center">
            <h5>
                {{number_format(App\User::auth()->balance->NEO->balance, 10, ',', '.')}}
                <span style="font-size: 14px; margin-top: 5px; display: block; opacity: .7;">
                    NEO
                    <span style="display: block; margin-top: 0">
                        Balance
                    </span>
                </span>
            </h5>

        </div>
        <div class="col-6 col-md-2 text-center">
            <h5>
                {{number_format(App\User::auth()->balance->GAS->balance, 10, ',', '.')}}
                <span style="font-size: 14px; margin-top: 5px; display: block; opacity: .7;">
                    GAS
                    <span style="display: block; margin-top: 0">
                        Balance
                    </span>
                </span>
            </h5>

        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12">
        <button class="btn-sb openwalletqr">
            Add funds to my wallet
        </button>


        <a href="" class="btn-link" style="color: #000">
            Download transaction history
        </a>
    </div>
</div>


<div class="row mt-3">
    <div class="col-md-12">

        <div class="row">
            <div class="col-md-12">
                <h3>
                    My last transactions
                </h3>
                <p class="text-muted">
                    Here we present your last transactions, you can see fund income as well as expenses made in your account.
                </p>
                <a href="" class="btn-"></a>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12 my_transactions">

                <div class="transaction in">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="y">
                                2018
                            </div>
                            <div class="dd">
                                March 28
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="amount">
                                0.005535
                                <span>
                                    NEO TOKEN
                                </span>
                            </div>
                            <div class="description">
                                Ticket payment for transport A78 from the city of milan italy, to new Swiss port.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="transaction out">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="y">
                                2018
                            </div>
                            <div class="dd">
                                March 28
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="amount">
                                0.005535
                                <span>
                                    NEO TOKEN
                                </span>
                            </div>
                            <div class="description">
                                Ticket payment for transport A78 from the city of milan italy, to new Swiss port.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="transaction out">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="y">
                                2018
                            </div>
                            <div class="dd">
                                March 28
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="amount">
                                0.005535
                                <span>
                                    NEO TOKEN
                                </span>
                            </div>
                            <div class="description">
                                Ticket payment for transport A78 from the city of milan italy, to new Swiss port.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="transaction out">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="y">
                                2018
                            </div>
                            <div class="dd">
                                March 28
                            </div>
                        </div>
                        <div class="col-md-11">
                            <div class="amount">
                                0.005535
                                <span>
                                    NEO TOKEN
                                </span>
                            </div>
                            <div class="description">
                                Ticket payment for transport A78 from the city of milan italy, to new Swiss port.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
