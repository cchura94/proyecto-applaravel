@extends("layouts.base")
@section("titulo", "Gestion Usuarios")

@section("contenido")

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Nuevo Usuario
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('usuario.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <label for="">Ingrese Nombre</label>
                    <input type="text" name="name" class="form-control">
                    <label for="">Ingrese Correo</label>
                    <input type="email" name="email" class="form-control">
                    <label for="">Ingrese Contraseña</label>
                    <input type="password" name="password" class="form-control">
                    <label for="">Seleccione rol</label>
                    <select name="role" id="" class="form-control">
                        @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<a href="{{ route('reporte_lista_pdf') }}" class="btn btn-info" target="_black">generar reporte</a>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>CORREO</th>
            <th>ROL</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @foreach ($user->roles as $rol)
                <span class="badge badge-success">{{ $rol->name }}</span>
                @endforeach
            </td>
            <td>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#asignarRole{{$user->id}}">
                    actualizar rol
                </button>

                <!-- Modal -->
                <div class="modal fade" id="asignarRole{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Asignar Rol</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('actualizar_rol', $user->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <label for="">Seleccionar Roles</label>
                                    <select name="roles[]" id="" class="form-control" multiple>
                                        @foreach ($roles as $rol)
                                        <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Actualizar Rol</button>
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
@endsection