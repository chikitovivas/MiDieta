@extends('layouts.perfil')

@section('content')

    <h3><span class="icon fa-user "></span>  Datos personales</h3>
    <hr>

    {!! Form::open(array('url' => 'updatePerfil', 'method' => 'POST'), array('role' => 'form', 'id' => 'Perfil')) !!} 
    <!-- Datos del usuario  -->
    <div >        
        <div class="col-md-6 col-xs-6 col-sm-6 form-group">
            {!! Form::label('name', 'Nombre de Usuario:') !!}
            <input id="name" name="name" class="form-control" value="{{ $user->name }}">                   
        </div> 
        <div class="col-md-6 col-xs-6  col-sm-6 form-group">
            {!! Form::label('email', 'Email:') !!}
            <input id="email" name="email" type="email" class="form-control" value="{{ $user->email }}" >                   
        </div> 
    </div>
    
    <!-- Contrasena  -->
    <br> <br> <br> <br>
    <h4><span class="icon fa-key "></span> Cambiar password</h4>
     <hr>
    <div>  
        <div class="col-md-6 col-xs-6 col-sm-6 form-group">
            {!! Form::label('password', 'Password:') !!}
            <input id="password" name="password" class="form-control" >                   
        </div> 
        <div class="col-md-6 col-xs-6 col-sm-6 form-group">
            {!! Form::label('re-password', 'Confirmar password:') !!}
            <input id="re-password" name="re-password" class="form-control" >                   
        </div> 
    </div>
    <!-- Informacion del doctor  -->
    <br> <br> <br> <br>
    
    <h3><span class="icon fa-stethoscope "></span>   Información Doctor</h3>
    <hr>
    <div class="row" >  
        <div class="col-md-6 col-xs-6 col-sm-6 form-group">
             {!! Form::label('email_doctor', 'Email Doctor:') !!}
            <input id="email_doctor" name="email_doctor" class="form-control" value="{{ $user->email_doctor }}">                   
        </div> 
    </div>
    <div class="row" id="botenera_editar"> 
        <div class="col-md-6 col-xs-6 col-sm-6">
            <a name= 'editar' class = 'btn btn-warning btn-block' id = 'boton_editar'>
                Editar
            </a>                  
        </div> 
    </div>
    <div class="row" id="botenera_cancelar"> 
        <div class="col-md-6  col-xs-6 col-sm-6">
            <a name= 'cancelar' class = 'btn btn-danger btn-block' id = 'boton_cancelar'>
                Cancelar
            </a>                  
        </div> 
        <div class="col-md-6 col-xs-6 col-sm-6">
            {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-success btn-block', 'id' => 'boton_guardar')) !!}                  
        </div> 
    </div>
    
    
    {!! Form::close() !!}
    
@endsection
