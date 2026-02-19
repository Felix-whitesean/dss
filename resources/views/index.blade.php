@extends('layouts.app')

@section('title')
    Home - {{ config('app.name') }}
@endsection

@section('content')
    @include('components.index')
@endsection
