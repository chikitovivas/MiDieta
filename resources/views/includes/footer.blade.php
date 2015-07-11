       <footer>
            <!-- Footer -->
                <div id="footer">

                <!-- Copyright -->
                        <ul class="copyright">
                                <li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                        </ul>

                </div>                      
        </footer>   
            
	<!-- Scripts -->
 	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script> 
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/jquery.scrolly.min.js"></script>
        <script src="assets/js/jquery.scrollzer.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
        <script src="assets/js/main.js"></script>
         <script src="assets/js/jquery-1.11.2.min.js"></script>
         <script src="jquery-1.11.3.min.js"></script>
       
        


        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            

        </script>

        
        
        <script type="text/javascript" 
        src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

        
        
        <script type="text/javascript">
                    $(document).ready(function(){
                $('#myTable').dataTable();
            });
                      window.onload = function(){
                          /* Los valores de los div para introducir una nueva comida al historial, sean de solo lectura */
                         document.getElementById("desayuno_calorias").readOnly = true;
                         document.getElementById("desayuno_carbohidratos").readOnly = true;
                         document.getElementById("desayuno_indiceg").readOnly = true;
                         document.getElementById("cena_calorias").readOnly = true;
                         document.getElementById("cena_carbohidratos").readOnly = true;
                         document.getElementById("cena_indiceg").readOnly = true;
                         document.getElementById("almuerzo_calorias").readOnly = true;
                         document.getElementById("almuerzo_carbohidratos").readOnly = true;
                         document.getElementById("almuerzo_indiceg").readOnly = true;
                         /* Los valores del select, comiencen en nada */
                         document.getElementById("Alimentos_id_desayuno").value = '';
                         document.getElementById("Alimentos_id_almuerzo").value = '';
                         document.getElementById("Alimentos_id_cena").value = '';
                         /* los botones de guardar se desactiven */
                         document.getElementById("boton_guardar_desayuno").disabled = true;
                         document.getElementById("boton_guardar_almuerzo").disabled = true;
                         document.getElementById("boton_guardar_cena").disabled = true;
                         /* los valores de los indices, comiencen en nada */
                         document.getElementById("desayuno_calorias").value = '';
                         document.getElementById("desayuno_carbohidratos").value = '';
                         document.getElementById("desayuno_indiceg").value = '';
                         document.getElementById("almuerzo_calorias").value = '';
                         document.getElementById("almuerzo_carbohidratos").value = '';
                         document.getElementById("almuerzo_indiceg").value = '';
                         document.getElementById("cena_calorias").value = '';
                         document.getElementById("cena_carbohidratos").value = '';
                         document.getElementById("cena_indiceg").value = '';
                         document.getElementById("totales").style.display = "none";
                         document.getElementById("boton_cerrar").style.display = "none";
                         setInterval(function () 
                         {
                            if(document.getElementById("alert")){
                                document.getElementById("alert").style.display = "none";
                            } 
                         }, 
                         3000);
                         
                      }
                      
                      document.getElementById("boton").onclick = function() {
                          document.getElementById("totales").style.display = "block";
                          document.getElementById("boton_cerrar").style.display = "block";
                          document.getElementById("boton").style.display = "none";
                      }
                     document.getElementById("boton_cerrar").onclick = function() {
                          document.getElementById("totales").style.display = "none";
                          document.getElementById("boton_cerrar").style.display = "none";
                          document.getElementById("boton").style.display = "block";
                      }           
                      //Desayuno
                      document.getElementById("Alimentos_id_desayuno").onchange= function() 
                      {                         
                          if(document.getElementById("Alimentos_id_desayuno").value === ''){
                              $('#desayuno_calorias').val(null);
                              $('#desayuno_carbohidratos').val(null);
                              $('#desayuno_indiceg').val(null);
                              document.getElementById("boton_guardar_desayuno").disabled = true;
                          }else{
                              document.getElementById("boton_guardar_desayuno").disabled = false;
                            $.ajax({
                                  type : "POST",
                                  url: "getInfoA",
                                  cache: false,
                                  dataType: "json",
                                  data : {id : document.getElementById("Alimentos_id_desayuno").value},
                                  success : function(json){
                                      $('#desayuno_calorias').val(json.info.calorias);
                                      $('#desayuno_carbohidratos').val(json.info.carbohidratos);
                                      $('#desayuno_indiceg').val(json.info.indiceg);
                                  },
                                  async:   false
                              });
                            }
                      };
                      
                      //Almuerzo
                      document.getElementById("Alimentos_id_almuerzo").onchange= function() 
                      {                            
                          if(document.getElementById("Alimentos_id_almuerzo").value === ''){
                              $('#almuerzo_calorias').val(null);
                              $('#almuerzo_carbohidratos').val(null);
                              $('#almuerzo_indiceg').val(null);
                              document.getElementById("boton_guardar_almuerzo").disabled = true;
                          }else{
                              document.getElementById("boton_guardar_almuerzo").disabled = false;
                            $.ajax({
                                  type : "POST",
                                  url: "getInfoA",
                                  cache: false,
                                  dataType: "json",
                                  data : {id : document.getElementById("Alimentos_id_almuerzo").value},
                                  success : function(json){
                                      $('#almuerzo_calorias').val(json.info.calorias);
                                      $('#almuerzo_carbohidratos').val(json.info.carbohidratos);
                                      $('#almuerzo_indiceg').val(json.info.indiceg);
                                  },
                                  async:   false
                              });
                            }
                      };
                      
                      //Cena
                      document.getElementById("Alimentos_id_cena").onchange= function() 
                      {                              
                          if(document.getElementById("Alimentos_id_cena").value === ''){
                              $('#desayuno_calorias').val(null);
                              $('#desayuno_carbohidratos').val(null);
                              $('#desayuno_indiceg').val(null);
                              document.getElementById("boton_guardar_cena").disabled = true;
                          }else{
                              document.getElementById("boton_guardar_cena").disabled = false;
                            $.ajax({
                                  type : "POST",
                                  url: "getInfoA",
                                  cache: false,
                                  dataType: "json",
                                  data : {id : document.getElementById("Alimentos_id_cena").value},
                                  success : function(json){
                                      $('#cena_calorias').val(json.info.calorias);
                                      $('#cena_carbohidratos').val(json.info.carbohidratos);
                                      $('#cena_indiceg').val(json.info.indiceg);
                                  },
                                  async:   false
                              });
                            }
                      };

         </script>