	<!-- Header -->
        <div id="header">
                    <div class="top">
                        <!-- Logo -->
                            <div id="logo">
                                  <!--  <span class="image avatar48"><img src="images/avatar.jpg" alt="" /></span> -->
                                <a href="{{ url('/') }}"> <span class="image avatar48">{!! HTML::image('images/avatar.jpg') !!}</span></a>
                                    <h1 id="title">Mi Dieta</h1>
                                    <!-- Nombre de usuario si esta logeado -->
                                    @if (Auth::guest())
                                        <p> Bienvenido </p>
                                    @else
                                        <p>{{Auth::user()->name }}</p>
                                    @endif 
                            </div>
                        <!-- Nav -->
                            <nav id="nav"> <!-- Lo que se muestra en el nav, si se esta logeado o no -->
                                    <ul>                                      
                                        @if (Auth::guest())
                                            <li><a href="{{ url('/auth/login') }}"    id="" class="skel-layers-ignoreHref"><span class="icon fa-sign-in"  >Login</span></a></li>
                                            <li><a href="{{ url('/auth/register') }}" id="" class="skel-layers-ignoreHref"><span class="icon fa-database" >Register</span></a></li>
                                        @else
                                            <li title="Home. (donde se introducen los alimentos consumidos en el dia)"><a href="{{ url('/') }}" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Home</span></a></li>
                                            <li title="Tabla de todos los alimentos"><a href="{{ url('alimentos') }}" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-lemon-o">Alimentos</span></a></li>
                                            <li title="Historial del usuario"><a href="{{ url('historial') }}" id="a" class="skel-layers-ignoreHref"><span class="icon fa-history">Historial</span></a></li>
                                            <li title="Perfil del usuario"><a href="{{ url('perfil') }}" id="" class="skel-layers-ignoreHref"><span class="icon fa-user">Perfil</span></a></li>                                         
                                            
                                        @endif                                  
                                    </ul>
                            </nav>
                    </div>

                    <div class="bottom" id="nav"> <!-- Lo que se muestra en el bottom del nav -->
                            <ul>
                                <li class="bottom"> <!-- Se muestra logout si se esta loegado -->
                                     <ul>
                                         @if (!Auth::guest())
                                            <li><a href="{{ url('/auth/logout') }}" id="" class="skel-layers-ignoreHref"><span class="icon fa-sign-out" >Logout</span></a></li>                                       
                                         @endif
                                     </ul>
                                </li>
                            </ul>
                    </div>
            </div>
