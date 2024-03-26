<div class="d-flex">
    <div class="btn-group" role="group" aria-label="Basic example">
    <a href="{{route('personals.show',$value)}}" class="btn text-success btn-sm "><i class="far fa-eye"></i></a>
    <a href="{{route('personals.edit',$value)}}" class="btn text-warning btn-sm"><i class="far fa-edit"></i></a>
    <form action="{{route('personals.destroy',$value)}}" method="post">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn text-danger btn-sm"><i class="far fa-trash-alt"></i></button>
    </form>
    </div>
</div>

