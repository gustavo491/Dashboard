@extends('layouts.admin')

@section('content')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

  <div class="container pt-5">
    <h1>Adicionar Estudante</h1>
    <form action="{{ url('/students/save') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group pb-3">
        <label for="name">Nome do Aluno</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Digite o nome do Aluno">
      </div>
      <div class="form-group pb-3">
        <input type="checkbox" id="status" name="status" value="active">
        <label for="status">Ativo</label><br>
      </div>
      <div class="form-group pb-3">
        <div class="row">
          <div class="col-md-2">
            <label for="zipcode">CEP</label><br>
            <input name="zipcode" type="text" id="zipcode" value="" maxlength="9" onblur="pesquisazipcode(this.value);">
          </div>
          <div class="col-md-2">
            <label for="street">Logradouro</label><br>
            <input name="street" id="street" type="text">
          </div>
          <div class="col-md-2">
            <label for="neighborhood">Bairro</label><br>
            <input name="neighborhood" id="neighborhood" type="text">
          </div>
          <div class="col-md-2">
            <label for="city">Cidade</label><br>
            <input name="city" id="city" type="text">
          </div>
          <div class="col-md-2">
            <label for="state">Estado</label><br>
            <input name="state" id="state" type="text">
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <label for="number">Número</label><br>
            <input name="number" id="number" type="text">
          </div>
          <div class="col-md-2">
            <label for="complement">Complemento</label><br>
            <input name="complement" id="complement" type="text">
          </div>
        </div>
      </div>
      <div class="form-group pb-3">
        <label for="course">Curso</label>
        <select class="form-control" id="course_id" name="course_id" onchange="filterClass();">
          <option value=""></option>
          @foreach($courses as $course)
            <option value="{{ $course->id }}">{{ $course->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group pb-3">
        <label for="class">Turma</label>
        <select class="form-control" id="class_id" name="class_id">
            <option value=""></option>
        </select>
      </div>
      <div class="form-group pb-3">
        Selecione a foto de Perfil
        <input type="file" name="student_photo" id="student_photo" accept="image/png, image/jpeg">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Salvar</button>
      </div>
    </form>
</div>

<script type="text/javascript">
 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  function limpa_formulário_zipcode() {
          document.getElementById('street').value=("");
          document.getElementById('neighborhood').value=("");
          document.getElementById('city').value=("");
          document.getElementById('state').value=("");
          document.getElementById('ibge').value=("");
  }

  function meu_callback(conteudo) {
      if (!("erro" in conteudo)) {
          //Atualiza os campos com os valores.
          document.getElementById('street').value=(conteudo.logradouro);
          document.getElementById('neighborhood').value=(conteudo.bairro);
          document.getElementById('city').value=(conteudo.localidade);
          document.getElementById('state').value=(conteudo.uf);
      } //end if.
      else {
          limpa_formulário_zipcode();
          alert("CEP não encontrado.");
      }
  }
      
  function pesquisazipcode(valor) {
      var zipcode = valor.replace(/\D/g, '');
      if (zipcode != "") {
        var validazipcode = /^[0-9]{8}$/;

        if(validazipcode.test(zipcode)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('street').value="...";
            document.getElementById('neighborhood').value="...";
            document.getElementById('city').value="...";
            document.getElementById('state').value="...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/'+ zipcode + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            limpa_formulário_zipcode();
            alert("Formato de CEP inválido.");
        }
      } else {
        limpa_formulário_zipcode();
      }
    };

function filterClass(){
    var  courseId = document.getElementById('course_id').value;
    let _token   = $('meta[name="csrf-token"]').attr('content');
    
    $.ajax({
           type:'POST',
           url:"{{ url('/students/classes') }}",
           data:{course_id:courseId},
           dataType: 'json',
           success:function(data){
            document.getElementById("class_id").innerHTML = data;
           }
        });
  }

</script>

@endsection
