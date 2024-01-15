@extends('adminlte::page')

@section('title', 'Role')

@section('content_header')

@stop

@section('content')
    <div class="content-header">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-shield-halved"></i> <b>GESTIÓN DE ROLES</b>
                    </div>
                    <div class="card-body">
                        @livewire('roles.table-roles')
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-shield-halved"></i> <b>REGISTRO DE SISTEMAS</b>
                    </div>
                    <div class="card-body">
                        @livewire('sistemas.tables-sistema')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa-solid fa-shield-halved"></i> <b>GESTIÓN  PERMISOS</b>
                    </div>
                    <div class="card-body">
                        @livewire('permisos.permisos-table')
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
