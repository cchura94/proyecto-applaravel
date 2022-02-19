@extends("layouts.base")

@section("titulo", "Editar Categoria")

@section("contenido")

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-body">

                <h5 class="card-title">Editar Categoria</h5>
    <hr>
<form action="{{ route('categoria.update', $categoria->id) }}" method="post">
    @csrf
    @method("PUT")
    <label for="">Nombre Categoria</label>
    <input type="text" name="nombre" value="{{$categoria->nombre}}" class="form-control @error('nombre') is-invalid @enderror">

    <label for="">Detalle Categoria</label>
    <textarea name="detalle" class="form-control">{{$categoria->detalle}}</textarea>

    <input type="submit" value="Modificar Categoria" class="btn btn-warning">
</form>
            </div>
        </div>
    </div>
</div>

@endsection