@extends('layouts.landing')

@section('content')
	
	<div class="menu" onclick="openNav();">
		<div class="bar1"></div>
		<div class="bar2"></div>
		<div class="bar3"></div>
	</div>

	<div id="mySidenav" class="sidenav">
	    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
	    <a href="{{ url('/') }}#intro">Inicio</a>
	    <a href="{{ url('/') }}#classes">Clases</a>
	    <a href="{{ url('/') }}#studio">Instalaciones</a>
	    <a href="{{ url('/') }}#contact">Contacto</a>
	    <a href="{{ url('/login') }}">Iniciar Sesión</a>
	</div>
	
	<div class="intro intro-aero">
		<h1>Aerobics</h1>

		<div class="logo-m">
			<img src="/assets/images/VerticalWhite.svg" alt="Vertical Pole & Fitness">
		</div>
	</div>

	<div class="classes classes-in" >
		<div class="description">
			Las rutinas clásicas con un <i>twist</i>. Nuestras clases de aerobics combinan diferentes sets de movimientos para trabajar gran parte de tus músculos. ¡Arriba, Abajo y mucho más! Cada clase puede tener su propio estilo además que te divertirás con un ritmo como ningún otro. ¡Nosotras disfrutamos cada una de las sesiones, y sin dudarlo tu también lo harás!<br><br>
			
			No importa qué edad tengas y tampoco si eres una deportista innata o una papa en el sofá. Las rutinas van subiendo de intensidad poco a poco para que el trabajo no sea tan abrumador.<br><br> ¡Atrévete a probarlo! <br><br>
		</div>
		<a href="{{ url('/') }}#contact">
		<div class="c-btn aero-s-btn">
			Incríbete
		</div>
		</a>
	</div>
	<footer>
		<a href="http://www.nuva.rocks" target="_blank">
			<img src="/assets/images/nuva.svg" alt="Desarrollado por Nuva Rocks">
		</a>
	</footer>

@endsection