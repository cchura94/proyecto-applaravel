@extends("layouts.base")

@section("titulo", "Lista de Categorias")

@section("contenido")

<div class="row">

    <div class="col-lg-12">

    @can("crear-categoria")
    <a href="{{route('categoria.create')}}" class="btn btn-primary">Nueva Categoria</a>
    @endcan
        
        <div class="card card-primary card-outline">
            <div class="card-body">
                <h5 class="card-title">Lista de Categoria</h5>

                @if(session("mensaje"))
                <div class="alert alert-success">
                    <p>
                        {{ session("mensaje") }}
                    </p>
                </div>
                @endif


                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>DETALLE</th>
                            <th>ESTADO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->nombre }}</td>
                            <td> {{ $cat->detalle }}</td>
                            <td>{{ $cat->estado }}</td>
                            <td>
                                @can("editar-categoria")
                                <a href="{{ route('categoria.edit', $cat->id) }}" class="btn btn-warning">
                                    <i class="fa fa-edit"></i>
                                </a>
                                @endcan
                                @can("eliminar-categoria")
                                <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalEliminar{{$cat->id}}">
  <i class="fa fa-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="ModalEliminar{{$cat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('categoria.destroy', $cat->id) }}" method="post">
          @csrf
          @method("DELETE")
      <div class="modal-body">
        ¿Está seguro de eliminar la categoria {{ $cat->nombre }}?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-danger">Eliminar</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endcan
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>

            </div>
        </div><!-- /.card -->
    </div>

</div>






@endsection