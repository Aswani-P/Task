<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body style="background-color:rgb(209, 209, 209);">
    <div>
        <h1 style="text-align:center;color:rgb(26, 88, 14);padding-top:50px;"> Add Task</h1>
    </div>
    <div class="container">
       
        <form action="{{route('tasks.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="nameControl" class="form-label" style="font-size:20px;">Name</label>
                <input type="text" class="form-control" name="name" id="nameControl" value="{{old('name')}}" />
                @error('name')
                <span class="alert " style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="emailControl" class="form-label" style="font-size:20px;">Email</label>
                <input type="email" id="emailControl"  class="form-control" name="email" value="{{old('email')}}"/>
                @error('email')
                <span class="alert " style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="codeControl" class="form-label" style="font-size:20px;">Phone code</label>
                <input type="text" id="codeControl"  class="form-control" name="code" value="{{old('code')}}" />
                @error('code')
                <span class="alert " style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="phoneControl" class="form-label" style="font-size:20px;">Phone</label>
                <input type="text" id="phoneControl"  class="form-control" name="phone" value="{{old('phone')}}" />
                @error('phone')
                <span class="alert " style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="mb-3" >
                <button type="submit" class="btn btn-success form-control" >Save</button>
            </div>
        </form>
    </div>
    
</body>
</html>