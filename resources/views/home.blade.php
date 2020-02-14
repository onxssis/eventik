@extends('layouts.master')

@section('content')
<profile-page :data="{{ $data }}" owner="{{ auth()->user()->name }}"></profile-page>
@endsection