@extends("layouts.base")

@section("titulo", "Ingreso de Productos")

@section("contenido")

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <h5 class="card-title">Datos Proveedor</h5>
                    </div>
                    <div class="col-md-4">
                        <label for="">RAZON SOCIAL</label>
                        <input type="text" disabled value="{{ $proveedor->razon_social }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="">DATOS CONTACTO</label>
                        <input type="text" disabled value="{{ $proveedor->datos_contacto }}" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="">TELEFONO</label>
                        <input type="text" disabled value="{{ $proveedor->telefono }}" class="form-control">

                    </div>
                    <div class="col-md-2">
                        <label for="">DIRECCION</label>
                        <input type="text" disabled value="{{ $proveedor->direccion }}" class="form-control">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>PRECIO</th>
                                <th>U. MEDIDA</th>
                                <th>CATEGORIA</th>
                                <th>IMG</th>
                                <th>ACCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $prod)
                            <tr>
                                <td>{{ $prod->nombre }}</td>
                                <td>{{ $prod->precio }}</td>
                                <td>{{ $prod->umedida }}</td>
                                <td>{{ $prod->categoria->nombre }}</td>
                                <td>
                                    <img src="{{ asset($prod->imagen) }}" alt="" width="100px">
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{$prod->id}}">
  asignar
</button>

<!-- Modal -->
<div class="modal fade" id="Modal{{$prod->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingresar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('asignar_cantidad') }}" method="post">
      <div class="modal-body">
          @csrf
          <input type="hidden" value="{{ $proveedor->id }}" name="proveedor_id">   
          <input type="hidden" value="{{ $prod->id }}" name="producto_id">  
          <label for="">Nombre Producto</label>      
        <input type="text" disabled class="form-control" value="{{ $prod->nombre }}">
        <label for="">Cantidad a Ingresar</label>
        <input type="number" class="form-control" name="cantidad" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Asignar Producto</button>
      </div>
      </form>
    </div>
  </div>
</div>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                    {{ $productos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection