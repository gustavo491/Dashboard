@extends('layouts.admin')

@section('content')
  <div class="container pt-5">
    <h1>Importar XML</h1>
    <form action="{{ url('/courses/import/xml') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group pb-3">
        Selecione ao XML
        <input type="file" name="xml" id="xml">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </form>
  </div>
@endsection
