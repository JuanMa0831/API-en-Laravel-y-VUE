<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Listado de Comunas</title>
  </head>
  <body>
    <div class= "container">
    <h1>Listado de Comunas</h1>
    <div class="mb-3"> <!-- Agregamos una clase de margen inferior para separar el botón del encabezado -->
      <a href="{{ route('comunas.create') }}" class="btn btn-success">Add</a>
    </div>
    <table class="table table-dark table-striped">
      <thead>
        <tr>
          <th scope="col">Codigo</th>
          <th scope="col">Comuna</th>
          <th scope="col">Municipio</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($comunas as $comuna)
        <tr>
          <th scope="row">{{ $comuna->comu_codi }}</th>
          <td>{{$comuna->comu_nomb}}</td>
          <td>{{$comuna->muni_nomb}}</td>
          <td>
            <a href="{{ route('comunas.edit', ['comuna' => $comuna->comu_codi]) }}" class="btn btn-info">Editar</a></li>
            <form action="{{ route('comunas.destroy', ['comuna' => $comuna->comu_codi]) }}" method="POST" style="display: inline-block">
              @method('delete')
              @csrf
              <input class="btn btn-danger" type="submit" value="Eliminar">
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
  </body>
</html>
