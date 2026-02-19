@extends('layouts.app')

@section('title')
    {{ ucfirst($dashboardType) }} Dashboard - {{ config('app.name') }}
@endsection

@section('content')
    @livewire('dashboard', ['dashboardType' => $dashboardType])
@endsection
