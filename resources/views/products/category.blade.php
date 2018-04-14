@extends('users.template')
@section('user_content')

    @if(count($category)>=1)
    @php
        $category = $category[0];
    @endphp
    <div class="category">
        <div class="row">
            <div class="col-md-12">
                <h3>
                    {{$category->name}}
                </h3>
            </div>
        </div>
    </div>

    @else
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger text-danger">
                    We do not find categories for the search criteria
                </div>
            </div>
        </div>
    @endif

@endsection