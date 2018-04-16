<form class="formulariologin" action="{{url('/login_form')}}" method="post" >
    <div class="email_and_password" v-if="step==1">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email">
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>
        </div>
    </div>
    <div class="token_security" v-if="step==2">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label>We send you a security token to your email that you need to enter in this step!</label>
                    <input type="password" class="form-control" name="token" placeholder="Token">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
            <div v-if="loading==0">
                <button type="button" @click="auth" class="btn-sb inverse" v-if="step==1">
                    LOGIN
                </button>
                <button type="button" @click="auth" class="btn-sb inverse" v-if="step==2">
                    VALIDATE
                </button>
            </div>
            <div v-if="loading==1">
                <button type="button" disabled class="btn-sb inverse">
                    LOADING...
                </button>
            </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.16/vue.min.js"></script>
<script>

    $(document).ready(function(){
        const app = new Vue({
            el: '.formulariologin',
            data: function () {
                var url = $('meta[name="site_url"]').attr('content');

                return {
                    step: 1,
                    url: url,
                    loading: 0
                }
            },
            
            methods: {
                auth: function () {
                    var vm = this;
                    vm.loading = 1;

                    if(vm.step==1) {
                        $.ajax({
                            type: "post",
                            url: vm.url+"/login",
                            data: $('.formulariologin').serialize(),
                            dataType: "json",
                            success: function (response) {
                                
                                if(response.error==true) {
                                    if (response.input) {
                                        $('.errortrue').remove();
                                        $.each(response.response, function (indexInArray, valueOfElement) { 
                                            var input = $('.formulariologin input[name="'+indexInArray+'"]');
                                                                            
                                            input.after(`
                                                <div class="text-danger errortrue" style="margin-top: 3px;">
                                                    ${valueOfElement}
                                                </div>                                 
                                            `);
                                        });
                                    } else {
                                        $('.errortrue').remove();
                                        $('.formulariologin').after(`
                                            <div class="alert alert-danger text-danger errortrue" style="margin-top: 3px;">
                                                ${response.response}
                                            </div>    
                                        `); 
                                    }
                                } else {
                                    $('.errortrue').remove();
                                    $('.formulariologin').after(`
                                        <div class="alert alert-success text-success errortrue" style="margin-top: 3px;">
                                            ${response.response}
                                        </div>    
                                    `); 
                                    vm.step = 2;
                                }

                                vm.loading = 0;
                            }
                        });
                    } 

                    if(vm.step==2) {
                        $.ajax({
                            type: "post",
                            url: vm.url+"/login/auth_token",
                            data: $('.formulariologin').serialize(),
                            dataType: "json",
                            success: function (response) {

                                if(response.error==true) {
                                    if (response.input) {
                                        $('.errortrue').remove();
                                        $.each(response.response, function (indexInArray, valueOfElement) { 
                                            var input = $('.formulariologin input[name="'+indexInArray+'"]');
                                                                            
                                            input.after(`
                                                <div class="text-danger errortrue" style="margin-top: 3px;">
                                                    ${valueOfElement}
                                                </div>                                 
                                            `);
                                        });
                                    } else {
                                        $('.errortrue').remove();
                                        $('.formulariologin').after(`
                                            <div class="alert alert-danger text-danger errortrue" style="margin-top: 3px;">
                                                ${response.response}
                                            </div>    
                                        `); 
                                    }
                                } else {
                                    $('.errortrue').remove();
                                    $('.formulariologin').after(`
                                        <div class="alert alert-success text-success errortrue" style="margin-top: 3px;">
                                            ${response.response}
                                        </div>    
                                    `); 
                                    if (response.redirect) {
                                        setTimeout(() => {
                                            window.location.href=response.redirect;
                                        }, 1500);
                                    }
                                }

                                vm.loading = 0;
                            }
                        });
                    }

                    
                }
            }
        });
    });
</script>