@extends('layouts.app')

@section('content')
<div>
        <?php if($total[3] % 114 > 35){ ?>
            <button id="boton" style="position: fixed; bottom: 220px; left:50px;" type="button" class="btn btn-success btn-circle">
                <span class="fa fa-info"> </span>
            </button> 
        <?php }elseif($total[3] % 114 > 70){ ?>
            <button id="boton" style="position: fixed; bottom: 220px; left:50px;" type="button" class="btn btn-warning btn-circle">
                <span class="fa fa-io"> </span>
            </button>         
        <?php }else{ ?>
            <button id="boton" style="position: fixed; bottom: 220px; left:50px;" type="button" class="btn btn-danger btn-circle">
                <span class="fa fa-info"> </span>
            </button>             
        <?php } ?>
        
        <button id="boton_cerrar" style="position: fixed; bottom: 238px; left:252px;" type="button" class="btn-xs btn-danger btn-circleC">
            <span class="fa fa-remove"> </span>
        </button>    
    
    <div id="totales" style="position: fixed; bottom: 150px; left:50px;">
         <table title="Totales del dia" class="table table-striped table-condensed " id="">
            <thead>
                <tr style=" font-size: small; background-color:  #67D1A3; opacity: .9;">
                    <th class="transbox"><b title="Calorias totales del dia">Calorias</b></th>
                    <th class="transbox"><b title="Carbohidratos totales del dia">Carbohidratos</b></th>
                    <th class="transbox"><b title="Indice G. totales del dia">Indice G.</b></th>
                    
                </tr>           
            </thead>
                <tr style="background: #67D1A3; opacity: .9; text-align: center;">
                    <td>
                        <b style="margin: 5%;font-weight: bold;text-align:center;color: #000000;">
                            {{ $total[1] }}
                        </b>
                    </td>
                    <td>
                        <b style="margin: 5%;font-weight: bold;text-align:center;color: #000000;">
                            {{ $total[2] }}
                        </b>
                    </td>
                    <td>
                        <b style="margin: 5%;font-weight: bold;text-align:center;color: #000000;">
                            {{ $total[3] }}
                        </b>
                    </td>
                </tr>
            <tbody>
                
                
            </tbody>
         </table>
    </div>
                    <!-- 

                    DESAYUNO

                    -->
    @if (count($errors) > 0)
            <div class="alert alert-danger" id='alert'>
                    <strong>Whoops!</strong> Hay problemas:<br><br>
                    <ul>
                         <h4>{{$errors->first()}}</h4>
                    </ul>
            </div>
    @endif
    
       <div class="panel panel-info">
            <div class="panel-heading">

                <h3 class="panel-title" title="Desayuno">Desayuno</h3>

            </div>
                  <table class="table table-striped table-condensed " id="">
            <thead>
                <tr>
                    
                    <th><b>#</b></th>
                    <th><b>Comida</b></th>
                    <th><b>Calorias</b></th>
                    <th><b>Carbohidratos</b></th>
                    <th><b>Indice G.</b></th>
                    <th></th>
                    
                </tr>           
            </thead>
            
            <tbody>
                @foreach ($comidas_desayuno as $comida)
                <tr class="odd gradeX">
                    <td>{{ $comida->cantidad }}</td>
                    <td>{{ $comida->comida }}</td>
                    <td>{{ $comida->calorias }}</td>
                    <td>{{ $comida->carbohidratos }}</td>
                    <td>{{ $comida->indiceg }}</td>
                    <td class="center">
                        <a href="{{URL::to('home/'.$Desayuno[0]->id.'/'.$comida->id.'/delete') }}" class="btn btn-danger btn-xs btn-block" role="button">
                        <span class="icon fa-eraser "></span>
                    </td>
                </tr>
                @endforeach
                
                <!-- TOTAL -->

                <tr class="odd gradeX" style=" background: lightblue; opacity: .7;">
                    <td><b>Total</b></td>
                    <td></td>
                    <td><b> {{$Desayuno[0]->calorias }} </b></td>
                    <td><b> {{$Desayuno[0]->carbohidratos }} </b></td>
                    <td><b> {{$Desayuno[0]->indiceg}} </b></td>
                    <td></td>
                </tr>

                
                {!! Form::open(array('url' => 'postHistorial', 'method' => 'POST'),
                    array('role' => 'form', 'id' => 'Historial')) !!} 
                {!! Form::hidden('Historial_id', $Desayuno[0]->id) !!}

                <tr>
                    <td>Nuevo</td>
                    <td id='nuevo'> 
                        {!! Form::select('Alimentos_id',$alimentos,NULL,['id' => 'Alimentos_id_desayuno', 'class' => 'Alimentos_id_desayuno'])  !!}
                        {!! Form::select('cantidad',$enteros,NULL,['id' => 'cantidad', 'class' => 'cantidad'])  !!}
                    </td>
                    <td> 
                        <div class="form-group">
                            <input id="desayuno_calorias" name="desayuno_calorias" class="form-control" >                   
                        </div>
                    </td>
                    <td> 
                        <div class="form-group">
                            <input id="desayuno_carbohidratos" name="desayuno_carbohidratos" class="form-control" >                   
                        </div> 
                    </td>
                    <td> 
                        <div class="form-group">
                            <input id="desayuno_indiceg" name="desayuno_indiceg" class="form-control" >                   
                        </div> 
                    </td>
                    <td> 
                        {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-success btn-block', 'id' => 'boton_guardar_desayuno')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tbody>
            
        </table>
       </div>

                    

                        <!-- 

                        ALMUERZO

                        -->
       <div class="panel panel-success">
            <div class="panel-heading">

                <h3 class="panel-title">Almuerzo</h3>

            </div>
                  <table class="table table-striped table-condensed " id="">
            <thead>
                <tr>
                    
                    <th><b> # </b></th>
                    <th><b>Comida</b></th>
                    <th><b>Calorias</b></th>
                    <th><b>Carbohidratos</b></th>
                    <th><b>Indice G.</b></th>
                    <th></th>
                    
                </tr>           
            </thead>
            
            <tbody>
                @foreach ($comidas_almuerzo as $comida)
                <tr class="odd gradeX">
                    <td>{{ $comida->cantidad }}</td>
                    <td>{{ $comida->comida }}</td>
                    <td>{{ $comida->calorias }}</td>
                    <td>{{ $comida->carbohidratos }}</td>
                    <td>{{ $comida->indiceg }}</td>
                    <td class="center">
                        <a href="{{URL::to('home/'.$Almuerzo[0]->id.'/'.$comida->id.'/delete') }}" class="btn btn-danger btn-xs btn-block" role="button">
                        <span class="icon fa-eraser "></span>
                    </td>
                </tr>
                @endforeach
                
                <!-- TOTAL -->

                <tr class="odd gradeX" style=" background: springgreen; opacity: .7;">
                    <td><b>Total</b></td>
                    <td></td>
                    <td><b> {{$Almuerzo[0]->calorias }} </b></td>
                    <td><b> {{$Almuerzo[0]->carbohidratos }} </b></td>
                    <td><b> {{$Almuerzo[0]->indiceg}} </b></td>
                    <td></td>
                </tr>

                
                {!! Form::open(array('url' => 'postHistorial', 'method' => 'POST'),
                    array('role' => 'form', 'id' => 'Historial')) !!} 
                {!! Form::hidden('Historial_id', $Almuerzo[0]->id) !!}

                <tr>
                    <td>Nuevo</td>
                    <td id='nuevo'> 
                        {!! Form::select('Alimentos_id',$alimentos,NULL,['id' => 'Alimentos_id_almuerzo','class' => 'Alimentos_id_almuerzo'])  !!}
                        {!! Form::select('cantidad',$enteros,NULL,['id' => 'cantidad','class' => 'cantidad'])  !!}
                    </td>
                    <td> 
                        <div class="form-group">
                            <input id="almuerzo_calorias" name="almuerzo_calorias" class="form-control" >                   
                        </div>
                    </td>
                    <td> 
                        <div class="form-group">
                            <input id="almuerzo_carbohidratos" name="almuerzo_carbohidratos" class="form-control" >                   
                        </div> 
                    </td>
                    <td> 
                        <div class="form-group">
                            <input id="almuerzo_indiceg" name="almuerzo_indiceg" class="form-control" >                   
                        </div> 
                    </td>
                    <td> 
                        {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-success btn-block', 'id' => 'boton_guardar_almuerzo')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tbody>
            
        </table>
     </div>

                            <!-- 

                            CENA

                            -->

       <div class="panel panel-danger" >
            <div class="panel-heading">

                <h3 class="panel-title">Cena</h3>

            </div>
                  <table class="table table-striped table-condensed " id="">
            <thead>
                <tr>
                    
                    <th><b> # </b></th>
                    <th><b>Comida</b></th>
                    <th><b>Calorias</b></th>
                    <th><b>Carbohidratos</b></th>
                    <th><b>Indice G.</b></th>
                    <th></th>
                    
                </tr>           
            </thead>
            
            <tbody>
                @foreach ($comidas_cena as $comida)
                <tr class="odd gradeX">
                    <td>{{ $comida->cantidad }}</td>
                    <td>{{ $comida->comida }}</td>
                    <td>{{ $comida->calorias }}</td>
                    <td>{{ $comida->carbohidratos }}</td>
                    <td>{{ $comida->indiceg }}</td>
                    <td class="center">
                        <a href="{{URL::to('home/'.$Cena[0]->id.'/'.$comida->id.'/delete') }}" class="btn btn-danger btn-xs btn-block" role="button">
                        <span class="icon fa-eraser "></span>
                    </td>
                </tr>
                @endforeach
                
                <!-- TOTAL -->

                <tr class="odd gradeX" style=" background: salmon; opacity: .7;">
                    <td><b>Total</b></td>
                    <td></td>
                    <td><b> {{$Cena[0]->calorias }} </b></td>
                    <td><b> {{$Cena[0]->carbohidratos }} </b></td>
                    <td><b> {{$Cena[0]->indiceg}} </b></td>
                    <td></td>
                </tr>

                
                {!! Form::open(array('url' => 'postHistorial', 'method' => 'POST'),
                    array('role' => 'form', 'id' => 'Historial')) !!} 
                {!! Form::hidden('Historial_id', $Cena[0]->id) !!}

                <tr>
                    <td>Nuevo</td>
                    <td id='nuevo'>  
                        {!! Form::select('Alimentos_id',$alimentos,NULL,['id' => 'Alimentos_id_cena','class' => 'Alimentos_id_cena'])  !!}
                        {!! Form::select('cantidad',$enteros,NULL,['id' => 'cantidad','class' => 'cantidad'])  !!}
                    </td>
                    <td> 
                        <div class="form-group">
                            <input id="cena_calorias" name="cena_calorias" class="form-control" >                   
                        </div>
                    </td>
                    <td> 
                        <div class="form-group">
                            <input id="cena_carbohidratos" name="cena_carbohidratos" class="form-control" >                   
                        </div> 
                    </td>
                    <td> 
                        <div class="form-group">
                            <input id="cena_indiceg" name="cena_indiceg" class="form-control" >                   
                        </div> 
                    </td>
                    <td> 
                        {!! Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-success btn-block', 'id' => 'boton_guardar_cena')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tbody>
            
        </table>
     </div>
</div>



@endsection