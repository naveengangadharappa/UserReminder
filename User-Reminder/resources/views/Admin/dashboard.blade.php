@extends('layouts.app')

@section('content')
@if ( Auth::user()->roles=='admin')
<h1>welcome admin</h1>
@endif
@endsection