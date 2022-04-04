<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Todo List</title>
    <style>
        h1 {
            font-family: sans-serif; 
        }
    </style>
</head>
<body>
    <!-- Todo Create Form  -->
    <div class="container w-50 shadow rounded my-4 mx-auto p-3">
        <form action="{{ route('todos.store') }}" method="POST" class="input-group my-3">
            @csrf

            <input type="text" class="form-control" name="todoItem" placeholder="Todo Item">
            <button class="btn btn-info text-light px-4" type="submit" id="button-add"><i class="fa-solid fa-plus"></i></button>
        </form>
    </div>

    <!-- Todo List -->
    <div class="container w-50 shadow rounded my-3 mx-auto p-3">

        @if(count($todoData) == 0)
            <h1 class="text-center p-2 text-secondary">No Item Found!</h1>
        @else
            <ul class="list-group list-group-flush">
            @foreach($todoData as $todo)
                <li class="list-group-item d-inline">
                    <p class="py-3 h5">{{ $todo->todoItem }} </p>
                    <small class="float-start text-muted">{{ $todo->created_at->diffForHumans() }}</small>

                    <!-- Delete Button -->
                    <form action="{{ '/todos/'.$todo->id }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger float-end mx-1">Delete <i class="fa-solid fa-trash-can"></i></button>
                    </form>

                    <!-- Edit Button with Modal -->
                    <button class="btn btn-warning float-end" data-bs-toggle="modal" data-bs-target="#modal">
                        Edit <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                        
                        
                    <div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content p-2">
                                <form action="{{ '/todos/'.$todo->id }}" method="POST" class="modal-body">
                                    @method('PUT')
                                    @csrf

                                    <input type="text" class="form-control" name="todoItem" value="{{ $todo->todoItem }}">
                                    <button type="submit" class="btn btn-warning w-100 mt-2">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
            </ul>
        @endif
    </div>
</body>
</html>