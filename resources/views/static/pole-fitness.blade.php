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
	
	<div class="intro intro-pole">
		<h1>Pole<br>Fitness</h1>

		<div class="logo-m">
			<img src="/assets/images/VerticalWhite.svg" alt="Vertical Pole & Fitness">
		</div>
	</div>

	<div class="classes classes-in" >
		<div class="description">
			Pole Fitness, es la nueva manera de ponerte en forma. Combinando ejercicio aeróbico con rutinas de tonificación.
			¡Nunca habías sentido tus músculos así! En cada clase, con cada ejercicio, trabajaremos diferentes partes del cuerpo, tonificando brazos, piernas y abdomen. ¡Es un ejercicio como ningún otro!<br><br>
			De igual manera los beneficios generales del Pole Fitness son:<br><br>
			- Mejorará tu Autoestima<br>
			- Trabajarás Integralmente tu cuerpo<br>
			- Bajarás esos kilitos de más<br>
			- Brazos y Piernas firmes.
		</div>
		<a href="index.html#contact">
		<div class="c-btn pole-s-btn">
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