@extends('layouts.historial')

@section('content')
<!-- HEAD -->
    @if($muestra != 0)
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
          google.load("visualization", "1", {packages:["corechart"]});
          google.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['tiempo', 'carbohidratos','calorias','indice glicemico'],
              <?php if($letter == 'd'){  // Si la letra introducida es d = dia?>
                    <?php          
                      for( $x = 0; $x < $cantidad ; $x++){
                      ?>
                    [ 'Dia{{$x}}'  ,  {{  $carb_m[$x] }},{{ $calo_m[$x] }},{{ $indi_m[$x]}} ],

                    <?php  }   ?>
              <?php }else if($letter == 'm'){ // Si la letra introducida es m = mes?>       
                    <?php          
                      for( $x = 0; $x < $cantidad ; $x++){
                      ?>
                    [ 'Mes{{$x}}'  ,  {{  $carb_m[$x] }},{{ $calo_m[$x] }},{{ $indi_m[$x]}} ],

                    <?php  }   ?>
              <?php }else{ // Si no es A#o?>
                    <?php          
                      for( $x = 0; $x < $cantidad ; $x++){
                      ?>
                    [ 'Year{{$x}}'  ,  {{  $carb_m[$x] }},{{ $calo_m[$x] }},{{ $indi_m[$x]}} ],

                    <?php  }   ?>     
               <?php  }   ?>           
           ]);

            var options = {
              title: 'Grafico Consumo de Calorias Carbohidratos e indice glicemico',
              hAxis: {title: 
                          <?php if($letter == 'd'){  // Si la letra introducida es d = dia ?>
                          'Valores por dia',  
                          <?php }else if($letter == 'm'){ // Si la letra introducida es m = mes  ?>
                          'Valores por mes',    
                          <?php }else{ // Si no es A#o?>
                           'Valores por A#o',   
                          <?php  }   ?>   
              titleTextStyle: {color: '#333'}},
              vAxis: {minValue: 0}
            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
          }
        </script>
    <!-- /Head -->
    @endif 
    
				  
        <!-- Comienza el body  -->
    @if (count($errors) > 0)
            <div class="alert alert-danger" id='alert'>
                    <strong>Whoops!</strong> Hay problemas:<br><br>
                    <ul>
                         <h4>{{$errors->first()}}</h4>
                    </ul>
            </div>
    @endif
    
    <h3><span class="fa fa-calendar"> Historial </span></h3>
    <hr>
    

    <div class="col-md-12 col-xs-12">
        <div class="" id="chart_div" style="width: auto; height: 500px;"></div>
    </div>
    
    <div id="fechas">
        @if($muestra == 0)
            <br><Br><Br><Br><Br><Br><Br><br>
             <div class="col-md-12 col-xs-2" ></div>
        @endif 
        {!! Form::open(array('url' => 'historial', 'method' => 'POST'),array('role' => 'form', 'id' => 'HistorialG')) !!}  
          <div class="clearfix visible-xs"></div>
        <div class="col-md-1 col-xs-2">
          <label> Desde: </label>   
        </div>
        <div class="col-md-3 col-xs-4 form-group"> 
            <input class="form-control"  name="date_from" type="text" id="datepicker" readonly>
        </div>

        <div class="col-md-1 col-xs-2">
          <label> Hasta: </label>     
        </div>
        <div class="col-md-3 col-xs-4 form-group"> 
            <input class="form-control" name="date_to" type="text" id="datepicker1" readonly>
        </div>  
        <div class="col-md-1 col-xs-4 form-group"> 
          {!! Form::select('letter',$letras,NULL,['id' => 'letter', 'class' => 'form-control' ])  !!}                 
        </div> 
        <div class="col-md-1 col-xs-3" >
          {!! Form::button('Buscar', array('type' => 'submit', 'class' => 'btn btn-success btn-block', 'id' => 'boton_enviar')) !!}          
        </div>   
          {!!  Form::close()  !!}
        <div class="col-md-1 col-xs-3" >
         
        <button id="boton_pdf" class="btn btn-warning btn-block" >PDF</button>
        </div> 
        <div class="col-md-1 col-xs-2" >
         
        <button id="boton_email" class="btn btn-primary btn-block" >Email</button>
        </div>  
    </div>   
   
    <select id="format" hidden="enable">    
        <option selected="enable" value="yy-mm-dd">ISO 8601 - yy-mm-dd</option>
    </select>



@endsection