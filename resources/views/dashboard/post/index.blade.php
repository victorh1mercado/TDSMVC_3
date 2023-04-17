<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <main>
                <div class="container py-4">
                    <h2>Post Publicados</h2>
                    @can('crear-post')
                    <a href="{{ url('dashboard/post/create') }}" class="btn btn-primary btn-sm">Nuevo Post</a>
                    @endcan
                    
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Categoria</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                                <th>Fecha de creacion</th>
                                <th>Fecha de modificacion</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($post as $post )
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->name }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>{{ $post->description}}</td>
                                <td>{{ $post->state}}</td>
                                <td>{{ $post->created_at}}</td>
                                <td>{{ $post->updated_at}}</td>
                                <td>
                                    @can('editar-post')
                                        
                                    <a href="{{ url('dashboard/post/'.$post->id.'/edit') }}" class="bi bi-pencil"></a></td>
                                    @endcan
                                <td>
                                    @can('borrar-post')
                                    <form action="{{ url('dashboard/post/'.$post->id) }}" method="post">
                                        @method("DELETE")
                                        @csrf
                                        <button class="bi bi-eraser-fill" type="submit" ></button>                                
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
        
                        </tbody>
                    </table>
        
                </div>
            </main>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

   
