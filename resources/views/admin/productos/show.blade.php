@extends('adminlte::page')

@section('title', 'Show')

@section('content_header')

@stop

@section('content')
    <div class="content-header">
        @livewire('products.update-product', ['producto' => $producto], key($producto->id))
    </div>
@stop

@section('css')
@stop

@section('js')

@stop
