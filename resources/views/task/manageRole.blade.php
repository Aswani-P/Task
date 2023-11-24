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
<body>
    <div>
        <h2>Manage role</h2>
    </div>
    <div class="container">
        <form action="{{route('store')}}" method="post">
            @csrf
            <div class="mb-3" class="form-control">
                <label for="roles" class="form-label">Roles</label>
                
                <select name="roles" id="role" class="form-control">
                    @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
                <label for="permission" class="form-label">Permission</label>
                <select name="permission" id="permission" class="form-control">
                    @foreach($permissions as $permission)
                    <option value="{{$permission->id}}">{{$permission->name}}</option>
                    @endforeach
                </select><br>
                <button type="submit" class="btn btn-primary">Assign</button>
               
            </div>
        </form>
    </div>
</body>
</html>