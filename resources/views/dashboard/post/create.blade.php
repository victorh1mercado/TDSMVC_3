{{-- llamamos la vista de la cual heredaremos la esrucctura --}}
@extends('dashboard.master')
@section('Titulo', 'AgregarPost')
@section('contenido')
    @include('dashboard.partials.validation-error')
    <h1>Registrar post</h1>

    <form action="{{ route('post.store') }}" method="post">
        @csrf
        {{-- form:post --}}
        {{-- Fila 1 --}}
        <main>
            <div class="row">
                {{-- .row para crear una fila --}}
                <div class="form-group">
                    <label for="name">Articulo</label>
                    <input class="form-control" type="text" name="name" id="name">
                </div>
            </div>
            {{-- Fila 2 --}}
            <div class="row form-group">
                <label for="description">Contenido</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
            </div>
            {{-- Fila 3 --}}
            <div class="row form-group">
                <label for="description">Categoria</label>
                <select name="category" id="category">
                    <option value="">Seleccionar una categoria</option>
                    @foreach ($category as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>                        
                    @endforeach
                </select>
            </div>



            <div class="row center">
                {{-- Las columnas en bootstrap tiene un ancho de 12
                Añadir 2 input en una fila: 12/cantidadinput --}}
                <div class="col s6">
                    <button class="btn btn-success btn-sm" type="submit">Publicar</button>
                    <a href="{{ url('dashboard/post') }}" class="btn btn-secondary btn-sm">Cancelar</a>

                </div>
            </div>
        </main>

    </form>
@endsection
