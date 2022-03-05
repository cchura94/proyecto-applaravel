@extends("layouts.base")

@section("titulo", "Gestión Proveedores")

@section("contenido")

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary card-outline">
            <div class="card-body">
                <h5 class="card-title">Lista de Proveedores</h5>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                    Nuevo Proveedor
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registro Nuevo Proveedor</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('proveedor.store') }}" method="post">

                                <div class="modal-body">
                                    @csrf
                                    <label for="">Razon Social:</label>
                                    <input type="text" name="razon_social" class="form-control" required placeholder="Ingrese RS">
                                    <label for="">Pais:</label>
                                    <input type="text" name="pais" class="form-control" required placeholder="Ingrese Pais">
                                    <label for="">Telefono:</label>
                                    <input type="text" name="telefono" class="form-control" placeholder="Telefono">
                                    
                                    <label for="">Datos Contacto</label>
                                    <input type="text" name="datos_contacto" class="form-control">
                                    <label for="">Dirección:</label>
                                    <input type="text" name="direccion" class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Proveedor</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>RAZON SOCIAL</th>
                                <th>PAIS</th>
                                <th>TELEFONO</th>
                                <th>DATOS CONTACTO</th>
                                <th>DIRECCION</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proveedores as $prov)
                            <tr>
                                <td>{{ $prov->razon_social }}</td>
                                <td>{{ $prov->pais }}</td>
                                <td>{{ $prov->telefono }}</td>
                                <td>{{ $prov->datos_contacto }}</td>
                                <td>
                                    {{ $prov->direccion }}
                                </td>
                                <td>
                                    <a href="{{ route('producto_ingresos', ['id' => $prov->id]) }}" class="btn btn-warning">Ingreso Productos</a>
                                </td>
                            </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection