@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')

@stop

@section('content')
    <div class="content-header">
        <div class="card">
            <div class="card-header">
                <b>GESTIÓN DE USUARIOS</b>
            </div>
            <div class="card-body">
                @livewire('user.table-users')
            </div>
        </div>
    </div>
    
@stop

@section('css')
@stop

@section('js')


@stop
