<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pdf</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <br><br>
    <div class="container">
        <div class="card">
            <h5 class="card-header">Task</h5>

            <div class="card-body">
                <input type="hidden" name="id" id="id" value="{{ $task->id }}">
                Name <input type="text" name="name" id="name" value="{{ $task->name }}"
                    class="form-control" readonly>
                Email<input type="text" name="email" id="email"
                    value="{{ $task->email }}"class="form-control" readonly>
                Contact <input type="text" name="contact"
                    value="{{ $task->code . ' ' . $task->phone }}"class="form-control">
                Source  <input type="text" name="source" value="{{ $task->getSources->name }}"class="form-control" readonly>
                @if ($task->status == 1)
                    Status  <input type="text" name="status" value="Active"class="form-control" readonly>
                @else
                    Status  <input type="text" name="status" value="Inctive"class="form-control" readonly>
                @endif
                <a href="{{route('pdf',$task->id)}}" class="btn btn-primary" target="_blank" >Download Pdf</a>

            </div>

        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

</html>
