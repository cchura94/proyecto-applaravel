@extends("layouts.base")

@section("titulo", "Gestión Producto")

@section("contenido")

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary card-outline">
            <div class="card-body">
                <h5 class="card-title">Lista de Productos</h5>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                    Nuevo Producto
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Registro Nuevo Producto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('producto.store') }}" method="post" enctype="multipart/form-data">

                                <div class="modal-body">
                                    @csrf
                                    <label for="">Nombre:</label>
                                    <input type="text" name="nombre" class="form-control" required placeholder="Ingrese Nombre">
                                    <label for="">Precio:</label>
                                    <input type="number" step="0.01" name="precio" class="form-control" required placeholder="Ingrese Precio">
                                    <label for="">umedida:</label>
                                    <input type="text" name="umedida" class="form-control" placeholder="Ingrese U Medida">
                                    <label for="">categoria:</label>
                                    <select name="categoria_id" id="" class="form-control">
                                        @foreach ($categorias as $cat)
                                        <option value="{{ $cat->id }}">{{$cat->nombre}}</option>
                                        @endforeach
                                    </select>
                                    <label for="">Descripción</label>
                                    <textarea name="descripcion" class="form-control"></textarea>
                                    <label for="">imagen:</label>
                                    <input type="file" name="imagen" class="form-control">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

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
                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ModalStock{{$prod->id}}">
                                        Ver Stock
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="ModalStock{{$prod->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">STOCK</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" value="{{ $prod->nombre }}" disabled class="form-control">
                                                    <table class="table">
                                                        <tr>
                                                            <td>DATOS PROVEEDOR</td>
                                                            <td>CANTIDAD</td>
                                                        </tr>
                                                        @php
                                                        $total = 0;
                                                        @endphp

                                                        @foreach ($prod->proveedores as $prov)
                                                            @php
                                                            $total += $prov->pivot->cantidad;
                                                            @endphp
                                                        <tr>
                                                            <td>{{ $prov->razon_social }}</td>
                                                            <td>{{ $prov->pivot->cantidad }}</td>
                                                        </tr>
                                                        @endforeach
                                                        <tr class="table-info">
                                                            <td>TOTAL: </td>
                                                            <td>{{ $total }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                 </div>
                                            </div>
                                        </div>
                                    </div>
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