<div class="row">
    <div class="col-md-3">
        <div class="avatar" style="background: url({{url('/images/avatars/hugh-laurie.jpg')}})">

        </div>
        <br>

        <a href="" class="btn-block btn-sb text-center">
            Change image profile
        </a>
    </div>
    <div class="col-md-6">
    <form action="">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    Update profile information
                </h3>
                <p class="text-muted">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat atque similique veritatis, delectus quasi nesciunt dolorum placeat rem sint non dignissimos dolorem eum nisi dolor earum molestias adipisci officia architecto?
                </p>
            </div>
        </div>

        @include('users.forms.edit_profile')

    </form>
    </div>
</div>