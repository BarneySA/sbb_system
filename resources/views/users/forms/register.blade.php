    <form action="{{url('register')}}" method="post">

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
                    <label>Age</label>
                    <input type="text" class="form-control" name="age" placeholder="Age">
                </div>
                <p class="text-danger" style="margin-top: -10px; opacity: 1;">
                    {{ $errors->first('age') }}
                </p>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="form-control" id="">
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
                    <select name="city" class="form-control" id="">
                        <option>Zürich</option>
                        <option>Geneva</option>
                        <option>Basel</option>
                        <option>Bern</option>
                        <option>Lausanne</option>
                        <option>Winterthur</option>
                        <option>Lucerne</option>
                        <option>St. Gallen</option>
                        <option>Lugano</option>
                        <option>Biel/Bienne</option>
                        <option>Thun</option>
                        <option>Köniz </option>
                        <option>La Chaux-de-Fonds</option>
                        <option>Fribourg</option>
                        <option>Schaffhausen</option>
                        <option>Vernier</option>
                        <option>Chur</option>
                        <option>Sion</option>
                        <option>Uster</option>
                        <option>Neuchâtel</option>
                    </select>
                </div>
                <p class="text-danger" style="margin-top: -10px; opacity: 1;">
                    {{ $errors->first('city') }}
                </p>
            </div>
        </div>


        <button type="submit" class="btn-sb">
            Continue
        </button>
    </form>
