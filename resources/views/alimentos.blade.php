@extends('layouts.alimentos')

@section('content')

<div class="table-responsive">
    <table id="myTable" class="display table" width="100%" > 
           
        <thead> 
                
              <tr> 
                
                <th>#</th>  
                <th>Nombre</th>  
                <th>Indice G.</th>  
                <th>Carbohidratos</th> 
                <th>Calorias</th> 
                
              </tr> 
              
              
         </thead>  
            
            
         <tbody>  
             
             @foreach($alimentos as $alimento)  
             
              <tr>                   
                <td>{{ $alimento->id }}</td>  
                <td>{{ $alimento->nombre }}</td>  
                <td>{{ $alimento->indiceg }}</td>  
                <td>{{ $alimento->carbohidratos }}</td>    
                <td>{{ $alimento->calorias }}</td> 
              </tr>  
            @endforeach
            
         </tbody>
         
    </table>  
</div>



<div style=" height: 100px; " ></div>

<div>
    <h4><i class="glyphicon glyphicon-plus"></i>  Registrar nuevo Alimento</h4>
    <hr>
</div>

<div>
    {!! Form::open(array('url' => 'postAlimento', 'method' => 'POST'), array('role' => 'form', 'id' => 'Alimentos')) !!}
    <table class="table table-bordered">
          <thead> 

                  <tr> 

                    <th>Nuevo #</th>  
                    <th>Nombre</th>  
                    <th>Indice G.</th>  
                    <th>Carbohidratos</th> 
                    <th>Calorias</th> 

                  </tr> 

          </thead>        
          <tbody>  
                <tr>
                    <td> {{ $alimento->id+1 }}</td>
                    <td>
                        {!! Form::text('nombre', null, array('class' => 'form-control','placeholder' => 'Arepa/Pan')) !!}
                    </td>
                    <td>
                        {!! Form::text('indiceg', null, array('class' => 'form-control','placeholder' => '100')) !!}
                    </td>
                    <td>
                        {!! Form::text('carbohidratos', null, array('class' => 'form-control','placeholder' => '100')) !!}
                    </td>
                    <td>
                        {!! Form::text('calorias', null, array('class' => 'form-control','placeholder' => '100')) !!}
                    </td>
                    <!-- Boton para submit -->
                    <td>
                        {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-success btn-block', 'id' => 'boton_guardar')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
   
         </tbody>
    </table>

</div>

@endsection
