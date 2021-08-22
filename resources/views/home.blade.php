@extends('layouts.app')

@section('content')
    <home-component :user_id="{{ $id }}"></home-component>
@endsection
