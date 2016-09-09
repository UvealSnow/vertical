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
	
	<div class="intro intro-vertical">
		<h1>Vertical<br>Training</h1>

		<div class="logo-m">
			<img src="/assets/images/VerticalWhite.svg" alt="Vertical Pole & Fitness">
		</div>
	</div>

	<div class="classes classes-in" >
		<div class="description">
			¡Una manera totalmente innovadora de hacer cardio! Vertical Training es una rutina origina de Vertical Pole & Fitness que consiste en trabajo cardiovascular intenso. ¡No te preocupes! Avanzaremos a tu paso y pronto verás que tu resistencia, condición y fortaleza han aumentado; además de por supuesto perderas peso paulatinamente. ¡Estamos seguras que te encantará! <br><br>
			Dentro de la rutina de Vertical Training combinamos diferentes objetos para que todo sea más dinámico:<br><br>
			- Mancuernas<br>
			- Trampolín<br>
			- Pelotas<br>
			- Ligas<br>
		</div>
		<a href="{{ url('/') }}#contact">
		<div class="c-btn vt-s-btn">
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