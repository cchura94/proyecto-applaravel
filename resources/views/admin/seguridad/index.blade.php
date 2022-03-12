@extends("layouts.base")

@section("titulo", "Gestión Roles y Permisos")

@section("contenido")

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Roles</h5>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Crear Nuevo Rol
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nuevo Rol</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('crear_rol') }}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <label for="">Ingrese Nombre Rol</label>
                                    <input type="text" name="name" class="form-control">
                                    <hr>
                                    <h5>Lista Permisos</h5>
                                    @foreach ($permisos as $per)
                                    <input type="checkbox" name="permisos[]" value="{{ $per->id }}"> {{$per->name}} |
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar Rol</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ROL</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $rol)
                        <tr>
                            <td>{{ $rol->id }}</td>
                            <td>{{ $rol->name }}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#editarRol{{ $rol->id }}">
                                    <i class="fa fa-edit"></i> editar
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="editarRol{{ $rol->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Editar Rol</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('editar_rol_permisos', $rol->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                            <div class="modal-body">
                                                <h1>ROL: {{ $rol->name }}</h1>
                                                <h5>Lista Permisos</h5>
                                                
                                                @foreach ($permisos as $per)
                                                    @if ($rol->hasPermissionTo($per->name))
                                                    <input type="checkbox" name="permisos[]" value="{{ $per->id }}" checked> {{$per->name}} |
                                                    @else
                                                    <input type="checkbox" name="permisos[]" value="{{ $per->id }}"> {{$per->name}} |
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Modificar</button>
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
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Permisos</h5>
                <form action="{{ route('crear_permiso') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" name="name" placeholder="Ingrese nuevo Permiso" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <input type="submit" value="Guardar Permiso" class="btn btn-info btn-block">
                        </div>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>PERMISO</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permisos as $per)
                        <tr>
                            <td>{{ $per->id }}</td>
                            <td>{{ $per->name }}</td>
                            <td></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection