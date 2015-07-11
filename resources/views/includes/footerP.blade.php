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
                        document.getElementById("name").disabled = true;
                        document.getElementById("email").disabled = true;
                        document.getElementById("password").disabled = true;
                        document.getElementById("re-password").disabled = true;
                        document.getElementById("email_doctor").disabled = true;
                        document.getElementById("boton_guardar").disabled = true;
                        document.getElementById("botenera_cancelar").style.display = "none";
                    }
                    
                    document.getElementById("boton_editar").onclick = function() 
                    {
                        document.getElementById("name").disabled = false;
                        document.getElementById("email").disabled = false;
                        document.getElementById("password").disabled = false;
                        document.getElementById("re-password").disabled = false;
                        document.getElementById("email_doctor").disabled = false;
                        document.getElementById("boton_guardar").disabled = false;
                        document.getElementById("botenera_editar").style.display = "none";
                        document.getElementById("botenera_cancelar").style.display = "block";
                    } 
                    document.getElementById("boton_cancelar").onclick = function() 
                    {
                        document.getElementById("name").disabled = true;
                        document.getElementById("email").disabled = true;
                        document.getElementById("password").disabled = true;
                        document.getElementById("re-password").disabled = true;
                        document.getElementById("email_doctor").disabled = true;                        
                        document.getElementById("botenera_editar").style.display = "block";
                        document.getElementById("botenera_cancelar").style.display = "none";
                    } 
                      

                      
 

         </script>