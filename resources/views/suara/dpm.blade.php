@extends('layouts.app')
@section('styles')
<style>
  .grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    grid-gap: 15px;
  }
</style>
@endsection
@section('content')
<div class="container">
  <section class="py-5 mb-5 text-center bg-primary">
    <h1>Pemilihan Dewan Perwakilan Mahasiswa FK UB 2021</h1>
    <h3>Pilih salah satu kandidat dengan menekan tombol <b>Pilih</b></h3>
  </section>
  <section class="row row-cols-4 mb-4 grid">
    {{-- Template --}}
    {{-- <article class="col text-center">
      <img class="w-100" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png"
        alt="">
      <h4 class="my-3"><b>Lorem Ipsum Dulur</b></h4>
      <a href="" class="btn btn-primary btn-lg">Pilih</a>
    </article> --}}
    @foreach ($calonsDpms as $calonDpm)    
      <article class="col text-center">
        <img class="w-100" src="{{ $calonDpm->image->getUrl() ?? "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" }}"
          alt="">
        <h4 class="my-3"><b>{{ $calonDpm->name ?? "Nama" }}</b></h4>
        <a href="" class="btn btn-primary btn-lg">Pilih</a>
      </article>
    @endforeach
  </section>
</div>
@endsection