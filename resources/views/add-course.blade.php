@extends('layouts.admin')

@section('content')
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="container pt-5">
    <h1>Adicionar Curso</h1>
    <form action="{{ url('/courses/save') }}" method="POST">
      @csrf
      <div class="form-group pb-3">
        <label for="name">Nome do curso</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do curso">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </form>
</div>

</body>
</html>

@endsection
