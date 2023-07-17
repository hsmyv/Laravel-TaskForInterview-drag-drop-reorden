<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>HTML Table</h2>
<form action="{{route('task.update', $task->id)}}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{$task->name}}">
<button type="submit">
    Edit Task
</button>
</form>


</body>
</html>


