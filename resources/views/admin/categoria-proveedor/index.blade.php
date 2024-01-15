@extends('adminlte::page')

@section('title', 'Categorias-proveedor')

@section('content_header')

@stop

@section('content')
    <div class="content-header">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-book"></i> <b>GESTIÓN DE CATEGORIAS</b>
                    </div>
                    <div class="card-body">
                        @livewire('categoria.admin-categorias')
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-people-carry-box"></i> <b>REGISTRO DE PROVEEDORES</b>
                    </div>
                    <div class="card-body">
                        @livewire('categoria.admin-proveedores')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')

@stop
