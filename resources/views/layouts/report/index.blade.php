@extends('layouts.app')

@section('title')
    Report - {{ config('app.name') }}
@endsection

@section('content')
    @livewire('report-old')
@endsection


