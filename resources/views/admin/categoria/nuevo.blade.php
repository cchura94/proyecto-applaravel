@extends("layouts.base")


@section("titulo", "Nueva Categoria")

@section("contenido")

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-body">

                <h5 class="card-title">Nueva Categoria</h5>
    <hr>
                @if ($errors->any())
                <!--div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div-->
                @endif
    
                <form action="{{ route('categoria.store') }}" method="post">
                    @csrf
                    <label for="">Nombre: </label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror">
                    @error('nombre')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
                    <label for="">Detalle Categoria</label>
                    <textarea name="detalle" class="form-control"></textarea>
    
                    <input type="submit" value="Guardar Categoria" class="btn btn-primary">
                </form>
            </div>


        </div>
    </div>
</div>




@endsection