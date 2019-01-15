@extends('empleado.show')
@section('submodulos')
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="#">Contactos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Empleados</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Dirección</a>
  </li>
</ul>

<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab">Contactos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab">Empleados</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab">Dirección</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
</div>
@endsection