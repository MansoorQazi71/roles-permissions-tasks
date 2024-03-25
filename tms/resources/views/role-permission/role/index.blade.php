<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

</head>
<body>
    @include('layouts.partials.navbar')
    <div class="container">
        @include('role-permission.nav-links')
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Roles</h4>
                        <a href="{{ url('roles/create') }}" class="btn btn-primary float-end">Add role</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
<tbody>
    @foreach($roles as $role)
    <tr>
        <td
        >
{{$role->id}}
        </td>
        <td
        >
{{$role->name}}
        </td>
        <td
        >
<a href="{{url('roles/'.$role->id.'/give-permissions')}}" class="btn btn-warning">Add / Edit Role Permissions</a>
<a href="{{url('roles/'.$role->id.'/edit')}}" class="btn btn-success">Edit</a>
<a href="{{url('roles/'.$role->id.'/delete')}}" class="btn btn-danger">Delete</a>

        </td>
    </tr>
        
    @endforeach
</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
