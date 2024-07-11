@extends('layouts.ecommerce')
@section('content')
    @livewire('ecommerce.show-product', ['producto' => $producto], key($producto->id))
@endsection