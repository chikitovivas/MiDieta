<!DOCTYPE html>
<html lang="en">
<head>
        @include('includes.head')
    
</head>
<body>   
    
        @include('includes.sidebar')

        
        <div id="main"> 
            <nav class="navbar navbar-default navbar-static-top"  role="navigation" style="margin-bottom: 0; background: #67D1A3 ;
                 height: 170px ; background-image: url('images/imagen1.jpg')  " >

            </nav>
            <div class="row" style=" height: 75px;"></div>

            <div class="row">
                
                <div class="col-md-0 col-xs-0"></div>
                
                <section  class="col-md-11 col-xs-11" > 
                    @yield('content')
                </section>
            </div>  
        </div>

     @include('includes.footer')
     </div>

</html>
