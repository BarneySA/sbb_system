<form class="formulariologin" action="{{url('/login_form')}}" method="post" >
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" placeholder="Email">
            </div>
            <p class="text-danger" style="margin-top: -10px; opacity: 1;">
                {{ $errors->first('email') }}
            </p>
        </div>

        <div class="col-6">
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
        <div class="col-md-12">
            <div class="form-group">
                <button type="submit" class="btn-sb inverse">
                    Login @{{hola}}
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    const app = new Vue({
        el: '.formulariologin',
        data: function () {
            return {
                hola: 'Hola guapo'
            }
        }
    });

</script>