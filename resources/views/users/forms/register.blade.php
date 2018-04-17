    <form  method="post" id="fromregister">

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name">
                </div>
                <p class="text-danger" style="margin-top: -10px; opacity: 1;">
                    {{ $errors->first('name') }}
                </p>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <p class="text-danger" style="margin-top: -10px; opacity: 1;">
                    {{ $errors->first('email') }}
                </p>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <p class="text-danger" style="margin-top: -10px; opacity: 1;">
                    {{ $errors->first('password') }}
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Birthdate</label>
                    <input type="text" class="form-control date" name="birthdate" placeholder="Age">
                </div>
                <p class="text-danger" style="margin-top: -10px; opacity: 1;">
                    {{ $errors->first('age') }}
                </p>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control" >
                        <option>F</option>
                        <option>M</option>
                    </select>
                </div>
                <p class="text-danger" style="margin-top: -10px; opacity: 1;">
                    {{ $errors->first('gender') }}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control">
                </div>
                <p class="text-danger" style="margin-top: -10px; opacity: 1;">
                    {{ $errors->first('city') }}
                </p>
            </div>
        </div>


        <button v-if="register_loading==0" type="button" @click="register()" class="btn-sb">
            Continue
        </button>

        <div v-if="register_loading==1">
            <button type="button" disabled class="btn-sb">
                LOADING...
            </button>
        </div>

    </form>


<script>

    $(document).ready(function(){
        const app = new Vue({
            el: '#fromregister',
            data: function () {
                var url = $('meta[name="site_url"]').attr('content');
                return {
                    step: 1,
                    url: url+'/register',
                    register_loading: 0
                }
            },
            
            methods: {
                register: function () {
                    var vm = this;
                    vm.register_loading = 1;
                    $('.errortrue').remove();

                    $.ajax({
                        type: "post",
                        url: vm.url,
                        data: $('#fromregister').serialize(),
                        dataType: "json",
                        success: function (response) {
                            vm.register_loading = 0;
                            console.log(response);

                            if(response.error==true) {
                                if (response.input) {
                                    $('.errortrue').remove();
                                    $.each(response.response, function (indexInArray, valueOfElement) { 
                                        var input = $('#fromregister input[name="'+indexInArray+'"]');
                                                                        
                                        input.after(`
                                            <div class="text-danger errortrue" style="margin-top: 3px;">
                                                ${valueOfElement}
                                            </div>                                 
                                        `);
                                    });
                                } else {
                                    $('.errortrue').remove();
                                    $('#fromregister').after(`
                                        <div class="alert alert-danger text-danger errortrue" style="margin-top: 3px;">
                                            ${response.response}
                                        </div>    
                                    `); 
                                }
                            } else {
                                $('.errortrue').remove();
                                $('#fromregister').after(`
                                    <div class="alert alert-success text-success errortrue" style="margin-top: 10px;">
                                        ${response.response}
                                    </div>    
                                `); 
                                if (response.redirect) {
                                    setTimeout(() => {
                                        window.location.href=response.redirect;
                                    }, 1500);
                                }
                            }



                        }
                    });
                }
            }
        });
    });
</script>