@extends('layouts.app')
@section('content')
<div class="container">
          <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">   
    <div class="row justify-content-center col-md-12">
        <div>
                <img class="mx-auto d-block" src="imagenes/nielmuni1.png" width="180" height="100">
        </div>
        <div >
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
          <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent" style="flex-grow: 0.5;">
                    <ul class="navbar-nav list-inline justify-content-center">
                     <li class="nav-item dropdown list-inline-item">
                        <a class="nav-link " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-right: 0rem;
    padding-left: 0rem;">
                             <img src="imagenes/ciudad.png" width="96" height="96" >
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <a class="dropdown-item" href="#">Inicio</a>
                              <a class="dropdown-item" href="#">Convocatoria CAS</a>
                              <a class="dropdown-item" href="#">Organización</a>
                             </div>
                      </li>
                      <li class="nav-item dropdown list-inline-item">
                        <a class="nav-link " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-right: 0rem;
    padding-left: 0rem;">
                             <img src="imagenes/muni.png" width="96" height="96" >
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <a class="dropdown-item" href="#">Turismo Municipal</a>
                              <a class="dropdown-item" href="#">Historia Municipal</a>
                                <a class="dropdown-item" href="#">Información General</a>
                            </div>
                      </li>
                      <li class="nav-item dropdown list-inline-item">
                        <a class="nav-link " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-right: 0rem;
    padding-left: 0rem;">
                             <img src="imagenes/servicio.png" width="96" height="96" >
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <a class="dropdown-item" href="#">Noticas al Dia</a>
                              <a class="dropdown-item" href="#">Padron del Covid-19</a>
                             </div>
                      </li>
                       <li class="nav-item dropdown list-inline-item">
                        <a class="nav-link " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-right: 0rem;
    padding-left: 0rem;">
                             <img src="imagenes/seguridad.png" width="96" height="96" >
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <a class="dropdown-item" href="#">Serenazgo</a>
                             </div>
                      </li>
                        <li class="nav-item dropdown list-inline-item">
                        <a class="nav-link " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-right: 0rem;
    padding-left: 0rem;">
                             <img src="imagenes/normatividad.png" width="96" height="96" >
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <a class="dropdown-item" href="#">Ordenanza Municipal</a>
                              <a class="dropdown-item" href="#">Decreto de Alcaldia</a>
                              <a class="dropdown-item" href="#">Acuerdo de Concejo</a>
                            </div>
                      </li>
                    </ul>
          </div>
                <div>
                            <a class="navbar-brand" href="http://www.transparencia.gob.pe/enlaces/pte_transparencia_enlaces.aspx?id_entidad=11125&id_tema=1&ver=D#.XllFFDIzaUk">
                        <img class="mx-auto d-block" src="imagenes/transparencia.png" width="180" height="100">
                                </a>
                  
                </div>
    
            </div>
          </div>
        
        </nav>   
       
    </div>
    <div class="container mx-auto py-2">
        <router-view></router-view>
    </div>
@endsection