<div class="btn-group" role="group" aria-label="Basic example">
<a href="{{route('coordinador.show',$value)}}" class="btn text-success"><i class="far fa-eye"></i></a>
<a href="{{route('coordinador.edit',$value)}}" class="btn text-success"><i class="fas fa-file-word"></i></a>
@can('administrador')
<form action="{{route('coordinador.destroy',$value)}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn text-success"><i class="fas fa-trash"></i></button>
    </form>
@endcan
</div>
