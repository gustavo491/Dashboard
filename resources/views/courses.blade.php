@extends('layouts.admin')

@section('content')
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
<div class="container pt-5">
<h2>Cursos</h2>
<div class="row">
    <div class="col-md-6">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pesquise..." title="Escreva aqui">
    </div>
    <div class="col-md-6">
        <a href="{{ url('/courses/add') }}" class="btn btn-success">Adicionar</a>
    </div>
</div>
    <table id="myTable">
        <tr class="header">
            <th style="width:10%;">#</th>
            <th style="width:75%;">Nome</th>
            <th style="width:15%;" class="text-center">Ações</th>
        </tr>
        @foreach($courses as $course)
        <tr>
            <td>{{$course->id}}</td>
            <td>{{$course->name}}</td>
            <td>
              <div class="row">
                  <div class="col-md-6 px-1">
                    <a href="{{ url('/courses/edit/') }}/{{ $course->id }}" class="btn btn-primary">Editar</a>
                  </div>
                  <div class="col-md-6">
                    <a href="{{ url('/courses/delete/') }}/{{ $course->id }}" class="btn btn-danger">Apagar</a>
                  </div>
              </div>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $courses->links() }}

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>


@endsection
