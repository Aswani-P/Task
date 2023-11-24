<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Role management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://cdn.datatables.net/v/dt/dt-1.13.7/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>
<body>
    <h2>Permission update</h2><br><br>
    <div class="container">
        <div class="mb-3">
            <form action="{{route('store_role')}}" method="post">
                @csrf
                <div class="mb-3">
                    <input type="hidden" name="id" value="{{$roles->id}}">
                    <label for="name">Role Name</label>
                    <input type="text" name="role" class="form-control" value="{{$roles->name}}"/>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        @foreach($permissions as $permission)
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ $roles->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                        {{ $permission->name }}
                        <input type="hidden" name="permission_ids[]" value="{{ $permission->id }}">
                         @endforeach
                      </div>
                      <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>