@extends('users.template')
@section('user_content')

    <div class="categories">
        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-3">
                <a class="category" href="{{url('/products/category/'.str_slug($category->name))}}">
                    <div class="content">
                        {{$category->name}}
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

@endsection