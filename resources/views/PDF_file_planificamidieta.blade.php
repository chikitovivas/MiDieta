<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Planifica mi dieta Historial PDF</title>
        <!-- grafica javascrip -->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['tiempo', 'carbohidratos','calorias','indice glicemico'],

            <?php           
                for($x=0;$x<$cantidad;$x=$x+1){
            ?>
            
            ['<?php echo $fecha[$x]; ?>',  <?php echo $carb_m[$x]; ?>,<?php echo $calo_m[$x]; ?>,<?php echo $indi_m[$x]; ?>],
                  
                <?php } ?>
        ]);

        

        var options = {
          title: 'Grafico de valores alimentos consumidos',
          hAxis: {title: 'Fechas',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
        
        
        
        
        <!-- fin grafica -->
    
    </head>
    <body>
        <!-- Cabecera proyecto -->
        <div class='cabecera' align='center'>
        <h1>Planifica mi dieta</h1>
        <h4>Universidad Catolica Andres Bello.</h4>
        <h4>Extension Guayana.</h4>
        <h4>Ingenieria Informaitca.</h4>
        <h4>Metodologia del Software.</h4>
        </div> 
        
        <!-- INICIO DE LA CABECERERA INFORMACION DE USUARIO -->

                
        <div  align='center'>

            <h2>Historial del usuario</h2>
           <table  align='center'>
                <tbody>
                    <tr>
                        <td><b>Nombre de usuario:</b> {{ Auth::user()->name }}</td>                                        

                    </tr>
                    <tr>
                        <td><b>Correo:</b> {{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <td><b>Correo de doctor:</b> {{ Auth::user()->email_doctor }} </td>                        
                    </tr>
                    <tr>
                        <td><b>Fecha de inicio en la aplicacion:</b> {{ Auth::user()->created_at }}</td>
                    </tr>
                    
                </tbody>
                
            </table>

        </div>
        
        
        <!--  INICIO DE LA TABLA  -->
        

        
        <h3 align='center'>Tabla de valores alimentos consumidos</h3>   
        
     <table border="1" align='center'>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Indice Glucemico</th>
                <th>Carbohidratos</th>
                <th>Calorias</th>
            </tr>
        </thead>
        <tbody>
        @for($i = 0 ; $i < $cantidad ; $i++)    
            <tr>
                
                <td>{{  $fecha[$i] }}</td>
                <td>{{  $indi_m[$i] }}</td>
                <td>{{  $carb_m[$i] }}</td>
                <td>{{  $calo_m[$i] }}</td>
                    
            </tr>
        @endfor    
        </tbody>
    </table>
    
    <!-- LLAMADA GRAFICA JAVASCRIPT-->
    
    <div align='center'>      
       <div id="chart_div" style="width: 900px; height: 500px;"></div>
    </div>
    
    <!-- INFORMACION ADICIONAL -->
      
    
    <div align="center">
    <p>Su promedio de <b>indice glucemico</b> es: <b>{{ $promedio_cg }}</b></p> 
            
        <p>Sus niveles de glucemia son: <b>  
                    @if( ($promedio_cg >= 0) && ($promedio_cg <= 35) )
                        "Bajos"                   
                    @elseif(($promedio_cg>35) && ($promedio_cg<=50))
                         "Medios"
                    @elseif($promedio_cg>50)
                         "Altos"
                    @endif   
               
        </b></p>
   
    </div>
    
    <!--    PIE DE PAGINA -->
    <div align='center'>                
        <h4>Documento impreso {{ $fecha_actual }}</h4>        
    </div>
    
    
    </body>
</html>
