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
	
	<div class="intro intro-gap">
		<h1>GAP</h1>

		<div class="logo-m">
			<img src="/assets/images/VerticalWhite.svg" alt="Vertical Pole & Fitness">
		</div>
	</div>

	<div class="classes classes-in" >
		<div class="description">
			¿Tienes alguna llantita que no puedes quemar? ¿Te cansaste de no lograr firmeza en tu cuerpo? Entonces GAP es la clase ideal para ti. Nuestras intensas rutinas harán que descubras ese cuerpo que siempre quisiste. <br><br> ¡Una vez que comiences no podrás detenerte! ¿Sabes cuál es su significado? Son las siglas de las tres partes del cuerpo que se trabajan más:<br><br>
			- Glúteos<br>
			- Abdomen<br>
			- Pierna<br>
		</div>
		<a href="{{ url('/') }}#contact">
		<div class="c-btn gap-s-btn">
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