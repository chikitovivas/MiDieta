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


        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
         <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
         <script>
           $(function() {
                $( "#datepicker" ).datepicker();
                $( "#datepicker" ).change(function() {
                  $( "#datepicker" ).datepicker( "option", "dateFormat", $( "#format" ).val() );
                });
              });
         $(function() {
           $( "#datepicker1" ).datepicker();
           $( "#datepicker1" ).change(function() {
                $( "#datepicker1" ).datepicker( "option", "dateFormat", $( "#format" ).val() );
           });
         });
         </script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            

        </script>
   
        <script type="text/javascript">
 
                    window.onload = function()
                    {    
                        if(<?php echo $muestra ?> === 0){
                            document.getElementById("chart_div").style.display = "none";
                            document.getElementById("chart_div1").style.display = "none";
                            document.getElementById("fechas").style.display = "block";
                        }else if(<?php echo $muestra ?> === 1){
                            document.getElementById("chart_div").style.display = "block";
                            document.getElementById("datepicker").value = "<?php echo $date_from ?>";
                            document.getElementById("datepicker1").value = "<?php echo $date_to ?>";
                            //document.getElementById("fechas").style.display = "none";
0                        }   
                        setInterval(function () 
                        {
                            if(document.getElementById("alert")){
                                document.getElementById("alert").style.display = "none";
                            } 
                        }, 
                        3000);
                    } 
                    document.getElementById("boton_pdf").onclick = function(){
                        if( document.getElementById("datepicker").value !== '' && 
                        document.getElementById("datepicker1").value !== '' ){
                    
                            window.open('historial/'+document.getElementById("datepicker").value+
                            '/'+document.getElementById("datepicker1").value+'/'+document.getElementById("letter").value+
                            '/'+1+'/pdf_email'
                            , '_blank');
                            
                         }
                    }
                    document.getElementById("boton_email").onclick = function(){
                        if( document.getElementById("datepicker").value !== '' && 
                        document.getElementById("datepicker1").value !== '' ){
                    
                            window.location = 'historial/'+document.getElementById("datepicker").value+
                            '/'+document.getElementById("datepicker1").value+'/'+document.getElementById("letter").value+
                            '/'+2+'/pdf_email';
                            
                         }
                    }

         </script>