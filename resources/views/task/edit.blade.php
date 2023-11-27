<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body style="background-color:rgb(199, 218, 235)">
    <div class="container">
        <h1 style="text-align:center;color:rgb(25, 63, 2);padding-top:40px;">Update the task</h1>
        <div class="container">
            <form action="{{route('tasks.update',$tasks->id)}}" method="post">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <input type="hidden" class="form-control" name="id" value="{{$tasks->id}}">
                    <label for="nameControl" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="nameControl" value="{{$tasks->name}}"/>
                </div>
                <div class="mb-3">
                    <label for="emailControl" class="form-label">Email</label>
                    <input type="email" id="emailControl"  class="form-control" name="email" value="{{$tasks->email}}" />
                </div>
                <div class="mb-3">
                    <label for="codeControl" class="form-label">Phone code</label>
                    <input type="text" id="codeControl"  class="form-control" name="code" value="{{$tasks->code}}" />
                </div>
                <div class="mb-3">
                    <label for="phoneControl" class="form-label">Phone</label>
                    <input type="text" id="phoneControl"  class="form-control" name="phone" value="{{$tasks->phone}}" />
                </div><br>
                <div class="mb-3">
                    <select name="source_id" id="source" class="form-control">
                     @foreach ($source as $item)
                     <option value="{{$item->id}}">{{$item->name}}</option>
                         
                     @endforeach
                    </select>
                 </div>
                <div class="mb-3">
                    <label for="statusControl" class="form-label">Status</label>
                    <select name="status" id="stats" class="form-control">
                
                        <option value="1">1</option>
                        <option value="0">0</option>
                    </select>
                    {{-- <input type="text" id="statusControl"  class="form-control" name="status" value="{{$tasks->status}}" /> --}}
                </div><br>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary form-control">Save</button>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>