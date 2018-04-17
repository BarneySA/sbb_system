@extends('parts.admin_template')
@section('content')
    <!-- START PAGE HEADING -->
    <div class="app-heading app-heading-bordered app-heading-page">
        <div class="title">
            <h1>Create new product</h1>
            <p>Complete each of the fields correctly</p>
        </div>
    </div>
    <!-- END PAGE HEADING -->
    
    <!-- START PAGE CONTAINER -->
    <div class="container">


    <div class="row mt-3 userlist_">
        <div class="col-md-12">


            @if(session('status')!=null)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        {{session('status')}}
                    </div>
                </div>
            </div>
            @endif

            @if(session('success')!=null)
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                </div>
            </div>
            @endif
            <form action="" method="post"  enctype="multipart/form-data">
            
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name', null)}}">
                                <p class="text-danger" style="margin: 5px 0; opacity: 1;">
                                    {{ $errors->first('name') }}
                                </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" name="amount" placeholder="Amount" value="{{old('amount', null)}}">
                            <p class="text-danger" style="margin: 5px 0; opacity: 1;">
                                {{ $errors->first('amount') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Currency</label>
                            <select name="" class="form-control">
                                <option>GAS</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                @foreach(\App\Category::where('status', 1)->get() as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control"></textarea>
                            <p class="text-danger" style="margin: 5px 0; opacity: 1;">
                                {{ $errors->first('description') }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="billboard">
                            <p class="text-danger" style="margin: 5px 0; opacity: 1;">
                                {{ $errors->first('billboard') }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <br>
                <button class="btn btn-success" type="submit">Save</button>
            </form>


        </div>
    </div>
    </div>
    




@endsection