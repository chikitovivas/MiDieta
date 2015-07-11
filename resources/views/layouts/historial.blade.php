<!DOCTYPE html>
<html lang="en">
<head>
        @include('includes.head')
<link rel="stylesheet" href="css/datepicker3.css">

<script type="text/javascript" src="/bootstrap-datepicker.js"></script>
       <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
   
</head>
<body>   
          @include('includes.sidebar')



        <div id="main"> 
            <nav class="navbar navbar-default navbar-static-top"  role="navigation" style="margin-bottom: 0; background: #67D1A3 ;
                 height: 170px ; background-image: url('images/imagen1.jpg')  " >

            </nav>            
            
            <div class="row" style=" height: 75px; "></div>
            <div class="row">
                
                <div class="col-md-0"></div>
                
                <section  class="col-md-11 " > 
                    @yield('content')
                </section>
              
                
            </div>  
        </div>
     @include('includes.footerH')
     </div>
</body>
</html>
