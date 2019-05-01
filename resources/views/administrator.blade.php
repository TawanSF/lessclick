@extends('layouts.app')

@section('content')
<main class="container">
    <div class="row">
        <div class="list-group">
            <a href="/administrator/register" class="list-group-item list-group-item-action">Register</a>
            <a href="/administrator/list" class="list-group-item list-group-item-action">List</a>
            {{-- <a href="/administrator/update" class="list-group-item list-group-item-action">Update</a> --}}
        </div>
    </div>
</main>
@endsection
