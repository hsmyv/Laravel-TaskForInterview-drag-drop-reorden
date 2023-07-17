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

<table id="adTable">
    <thead>
  <tr>
    <th></th>
    <th>Name</th>
    <th>Email</th>
    <th>Position</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($users as $index => $user)
   <tr class="alert" draggable="true" ondragstart="drag(event)" ondragover="allowDrop(event)" ondrop="drop(event)">
    <td data-ad-id="<?php echo $user->id;?>">
      <label class="checkbox-wrap checkbox-primary">
        <input type="checkbox" checked>
        <span class="checkmark"></span>
      </label>
    </td>
    <td>{{$user->name}}</td>
    <td>{{$user->email}}</td>
    <td>{{$user->position}}</td>
  </tr>
  @endforeach
  </tbody>

</table>

</body>
</html>


<script>
    var dragItem;

    function drag(event){
        dragItem = event.target;
        event.dataTransfer.effectAllowed = "move";
        event.dataTransfer.setData("text/html", dragItem.outerHTML);
    }

    function allowDrop(event){
        event.preventDefault();
    }

    function drop(event){
        event.preventDefault();
        var targetTr = event.target.closest("tr");
        var tableBody = document.querySelector("#adTable tbody");
        var tableRows = Array.from(tableBody.querySelectorAll("tr"));
        var dragIndex = tableRows.indexOf(dragItem);
        var targetIndex = tableRows.indexOf(targetTr);

        if(dragIndex !== -1 && targetIndex !== -1)
        {
            var start = Math.min(dragIndex, targetIndex);
            var end  = Math.max(dragIndex, targetIndex);
            var droppedRow = tableRows.splice(dragIndex, 1)[0];
            tableRows.splice(targetIndex,0, droppedRow);
            var positions = [];
            tableRows.forEach(function(row, index){
                var id = row.querySelector("td").getAttribute("data-ad-id");
                var adPosition = index + 1;
                positions.push({
                    id: id,
                    position: adPosition
                });
            });

            tableBody.innerHTML = "";
            tableRows.forEach(function(row){
                tableBody.appendChild(row);
            });

            var formData  = new FormData();
            formData.append("positions", JSON.stringify(positions));
            $.ajax({
                url: '{{route("drag.drop")}}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType:false,
                headers:{
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                },
                success: function(response){

                },
                error: function(error)
                {

                }
            });
        }
    }
</script>
