@extends('layouts.landing')

@section('content')


<!-- <div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.
                </div>
            </div>
        </div>
    </div>
</div> -->
    
    <div class="menu" onclick="openNav();">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="{{ url('/') }}#intro" onclick="closeNav()">Inicio</a>
        <a href="{{ url('/') }}#classes" onclick="closeNav()">Clases</a>
        <a href="{{ url('/') }}#studio" onclick="closeNav()">Instalaciones</a>
        <a href="{{ url('/') }}#contact" onclick="closeNav()">Contacto</a>
        <a href="{{ url('/login') }}" onclick="closeNav()">Iniciar Sesión</a>
    </div>
    
    <div class="intro" id="intro">
        <a href="{{ url('/login') }}" class="login-btn">Iniciar Sesión</a>

        <h1>Hora<br>de ser<br>increíble</h1>

        <div class="logo-m">
            <img src="/assets/images/vertical.svg" alt="Vertical Pole & Fitness">
        </div>
    </div>

    <div class="classes" id="classes">
        <div class="description">
            Vertical es el estudio donde podrás alcanzar tus metas de una manera divertida en compañía de personal altamente calificado. ¡Eres una mujer fuerte y queremos que transmitas esa fortaleza en cada paso que des! No esperes más y ponte en contacto con nosotros, estamos seguras que nuestras rutinas se adaptarán a tu estilo de vida.
        </div>
        <h1>clases</h1>
        <div class="classes-btns">
            <a href="{{ url('/pole-fitness') }}">
                <div class="pole-btn">
                    <div>
                        <h2>Pole Fitness</h2>
                    </div>
                </div>
            </a>
            <a href="{{ url('/gap') }}">
                <div class="gap-btn">
                    <div>
                        <h2>GAP</h2>
                    </div>
                </div>
            </a>
            <a href="{{ url('/vtraining') }}">
                <div class="zumba-btn">
                    <div>
                        <h2>Vertical Training</h2>
                    </div>
                </div>
            </a>
            <a href="{{ url('/aerobics') }}">
                <div class="aero-btn">
                    <div>
                        <h2>Aerobics</h2>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="motivational">
        <div class="mark left">"</div>
        <div class="phrase">No es más fácil,<br><span>tú Estás mejorando</span></div>
        <div class="mark right">"</div>
    </div>

    <div class="studio" id="studio">
        <h1>el studio</h1>
        <div class="img-cont">
            <div class="install">
                <div class="mask">
                    <p class="mask-p">Instalaciones de Calidad</p>
                </div>
            </div>
            <div class="imgs">
                <div class="img1">
                    <div class="mask2">
                        <p class="mask-p">Personal Capacitado</p>
                    </div>
                </div>
                <div class="img2">
                    <div class="mask3">
                        <p class="mask-p">¡El mejor ambiente para ti!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact" id="contact">
        <h1>Contacto</h1>
        <div class="c-cont">
            <div class="c-info">
                <h2>¿Quieres inscribirte?</h2>
                <p>Llama al <strong>(444) 581 2357</strong> o visítanos en nuestra dirección:</p>
                <p>
                    Av. Tercer Milenio #385<br>
                    San Luis Potosí, SLP.
                </p>
                <div class="social-media">
                    <a href="https://www.facebook.com/VerticalFitMx/" target="_blank">
                        <img src="/assets/images/facebook.svg" alt="Facebook Vertical">
                    </a>
                    <a href="https://www.instagram.com/verticalfitmx/" target="_blank">
                        <img src="/assets/images/instagram.svg" alt="Instagram Vertical">
                    </a>
                </div>
                <div class="c-btn" id="myBtn" onclick="document.getElementById('myModal').style.display='block'">
                    Déjanos un Mensaje
                </div>
            </div>
            <div class="map">
                
                <div id="map" style="width:100%;height:400px"></div>
            </div>
        </div>
    </div>

    <footer>
        <a href="http://www.nuva.rocks" target="_blank">
            <img src="/assets/images/nuva.svg" alt="Desarrollado por Nuva Rocks">
        </a>
    </footer>

    <!-- The Modal -->
    <div id="myModal" class="modal">
      <!-- Modal content -->
      <div class="modal-content animate">
        <span class="close" onclick="closeModal();">&times;</span>
        <h2>Déjanos un mensaje y pronto nos pondremos en contacto.</h2>
        <div class="contact-form">
            <form method="POST" action="https://formspree.io/contacto@verticalfit.mx">
                <input type="text" placeholder="Nombre" required class="text-input" name="Nombre"/>
                <input type="email" placeholder="E-mail" required class="text-input" name="Mail"/>
                <textarea placeholder="Mensaje" rows="4" required class="text-input" name="Msj"></textarea> 
                <input type="submit"  class="c-btn" value="Enviar"/>
                <input type="hidden" name="_next" value="thanks.html" />
                <input type="hidden" name="_subject" value="Nuevo Mensaje" />
            </form>
        </div>
      </div>

    </div>

@endsection