<!DOCTYPE html>
<html>

<head>

<title>Task Dashboard</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<link rel="stylesheet"
href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

</head>

<body>

<div class="container mt-5">

<div class="d-flex justify-content-between mb-3">

<h3>Task Dashboard</h3>

<a href="/logout" class="btn btn-danger">
Logout
</a>

</div>

<div class="card shadow">

<div class="card-header">

<button class="btn btn-primary"
data-bs-toggle="modal"
data-bs-target="#taskModal">
Add Task
</button>

</div>

<div class="card-body">

<table class="table" id="taskTable">

<thead>
<tr>
<th>Title</th>
<th>Description</th>
<th>Status</th>
<th>Due Date</th>
<th>Action</th>
</tr>
</thead>

</table>

</div>

</div>

</div>

<!-- Modal -->

<div class="modal fade" id="taskModal">

<div class="modal-dialog">

<div class="modal-content">

<form id="taskForm">

<div class="modal-header">
<h5>Add Task</h5>
</div>

<div class="modal-body">

<input type="hidden" id="task_id">

<div class="mb-3">
<label>Title</label>
<input type="text" name="title" id="title"
class="form-control">
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description"
id="description"
class="form-control"></textarea>
</div>

<div class="mb-3">
<label>Status</label>

<select name="status" id="status"
class="form-control">

<option value="Pending">Pending</option>
<option value="Completed">Completed</option>

</select>

</div>

<div class="mb-3">
<label>Due Date</label>
<input type="date" name="due_date"
id="due_date"
class="form-control">
</div>

</div>

<div class="modal-footer">

<button type="submit"
class="btn btn-success">

Save

</button>

</div>

</form>

</div>

</div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>

<script>

var table = $('#taskTable').DataTable({

ajax:'/api/tasks',

dom:'Bfrtip',

buttons:[
'copy','csv','excel','pdf','print'
],

columns:[
{data:'title'},
{data:'description'},
{data:'status'},
{data:'due_date'},
{data:'action'}
]

});

$('#taskForm').submit(function(e){

    e.preventDefault();

    let id = $('#task_id').val();

    let url = id ? '/task/update/' + id : '/task/store';

    $.ajax({
        url: url,
        type: 'POST',
        data: $(this).serialize(),
        success: function(response){

            if(response.status){

                $('#taskModal').modal('hide');
                $('#taskForm')[0].reset();
                $('#task_id').val('');

                table.ajax.reload();

                alert(response.message ?? 'Success');
            }
        }
    });

});

function editTask(id){

    $.get('/task/edit/' + id, function(data){

        $('#task_id').val(data.id);
        $('#title').val(data.title);
        $('#description').val(data.description);
        $('#status').val(data.status);
        $('#due_date').val(data.due_date);

        $('#taskModal').modal('show');
    });

}

function deleteTask(id){

    if(confirm('Are you sure?')){

        $.ajax({
            url: '/task/delete/' + id,
            type: 'POST',
            success: function(res){

                if(res.status){
                    table.ajax.reload();
                    alert('Deleted Successfully');
                }

            }
        });

    }
}
</script>

</body>

</html>