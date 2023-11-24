<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://cdn.datatables.net/v/dt/dt-1.13.7/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">




</head>

<body>
    <div>
        @role('admin')
        <h5 style="color:rgb(0, 23, 128);text-align:center;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;padding-top:20px;">Hi admin</h5>
        
        <h1 style="color:green;text-align:center;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;padding-top:30px;">Tasks</h1>
    </div>
    <br>
        @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif


    <div class="container">
        {{-- @if(auth()->user()->hasRole('admin')) --}}
       <?php  $user= auth()->user();?>
        <div>
            @if($user->can('create post') || $user->can('upload post') )
            <a href="{{ route('tasks.create') }}" class="btn btn-primary" role="button">Add Task</a>
         
        
            <a href="{{route('export')}}" class="btn btn-dark" role="button">Export</a>
            <a href="{{route('view')}}"style="margin-left:10px;" ><i class="bi bi-gear" style="font-size:35px"></i></a>
            @endif
            <a href="{{route('show_role')}}" class="btn btn-dark" role="button" style="margin-left:1000px">Assign Role</a>
            @if($user->can('create post') || $user->can('upload post') )
            <div class="container" style="padding-top:20px;">
                <form action="{{route('import')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file_upload" id="file">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
            @endif  
           
        </div><br>
        
        {{-- @endif --}}
        <br>
        <table class="table display" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Code</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Source</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>

                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($tasks as $task)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->email }}</td>
                        <td>{{ $task->code }}</td>
                        <td>{{ $task->phone ?? '' }}</td>
                        <td>{{$task->getSources ? $task->getSources->name: ''}}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                            </div>
                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning"
                                role="button">Update
                            </a>
                            <form action="delete_data" method="post" style="display:inline">
                                @csrf
                           
                                <input type="hidden" name="id" id="id" value="{{$task->id}}">
                                <button type="submit"class="delete_btn btn btn-danger" onclick="alert_msg()" >Delete</button>
                            </form>
                        
                            <a href="{{route('view',$task->id)}}"class="btn btn-primary" role="button">View</a></td>

                    </tr>
                @endforeach --}}
            </tbody>
        </table>
        @endrole
        {{-- @endif --}}
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.7/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            processing:true,
            serverSide: true,
            ajax:"{{route('list')}}",
            columns: [
                {data: 'id' ,  name: 'id'},
                {data:'name', name:'name'},
                {data:'email', name:'email'},
                {data:'code',name:'code'},
                {data:'phone',name:'phone'},
                {data:'source_id',name:'source_id'},
                {data:'status',name:'status'},
                {data:'Action',name:'Action'}
            ]
        })


        $('.delete_btn').click(function() {
            alert_msg(this);
        });

        function alert_msg(btn) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var confirmation = confirm("are you sure you want to remove the item?");
            if (confirmation) {
                var id=$('#id').val();
                // alert(id);
                
                // var userURL = $(btn).data('url');
                console.log(userURL);
                

                $.ajax({
                    type: 'post',
                    url: "{{ route('delete') }}",
                    data:{
                        'id':id
                    },

                    success: function(response) {
                        window.location.reload();
                    },

                });

            }


        }

    });
</script>


</html>
