<!DOCTYPE html>
<html lang="en">
<head>
  <title>ChatBox-Admin</title>
  <meta charset="utf-8">
  <meta name="csrf_token" content="{{csrf_token()}}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
  <script src="{{asset('/js/jquery.min.js')}}"></script>
  <script src="{{asset('/js/bootstrap.min.js')}}"></script>
</head>
<body onload="load()">

<div class="container">
<br><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" onclick="addCus()">Add Customer</button><br><br>
@include("modal")
  <h2>Customer Information Table</h2>
  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Country</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="tbody">
    </tbody>
  </table>
</div>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $("meta[name='csrf_token']").attr("content")
    }
  });

  addCus= function(){
    $('#h4').text('Add Customer');
    $("b").text("");
    $("b + br").hide();
    $("b + br + br").hide();
    $("#name").val("").removeAttr("disabled");
    $("#email").val("").removeAttr("disabled");
    $("#pass").show().val("").removeAttr("disabled").attr({type:'password',required:''});
    $("#lpass").show();
    $("#lg").text("Gender: ");
    $(".lbl").show();
    $("#country").val("").removeAttr("disabled");
    $(":submit").show();
    id="";
  }

  id="";

  $("form").submit(function(){
       var name=$("#name").val();
       var email=$("#email").val();
       var pass=$("#pass").val();
       var gender=$(":checked").val();
       var country=$("#country").val();
        $.ajax({
          url: 'inorup',
          type: 'POST',
          data: {
              id: id,
              name: name,
              email: email,
              pass: pass,
              gender: gender,
              country: country
          },
          success: function(response){
            load();
          }
        });
  });

  load= function(){
      $.ajax({
        url: 'read',
        type: 'POST',
        success: function(response){
          data= response.data;
          len= data.length;
          $(".tr").remove();
          for(var i=0; i<len; i++)
          {
              $("#tbody").append("<tr class='tr'><td>"+data[i].id+"</td><td>"+data[i].name+"</td><td>"+data[i].gender+"</td><td>"+data[i].email+"</td><td>"+data[i].country+"</td><td><button type='button' class='btn btn-success' data-toggle='modal' data-target='#myModal' onclick='edit("+i+")'>Edit</button><button type='button' class='btn btn-info' data-toggle='modal' data-target='#myModal' onclick='show("+i+")'>Show</button><button type='button' class='btn btn-danger' onclick='del("+data[i].id+")'>Delete</button></td></tr>");
          }
        }
      });
  }

  edit= function(i){

      id=data[i].id;
      $('#h4').text('Edit Customer');
      $("b").text("");
      $("b + br").hide();
      $("b + br + br").hide();
      $("#name").val(data[i].name).removeAttr("disabled");
      $("#email").val(data[i].email).removeAttr("disabled");
      $("#pass").removeAttr("required").hide();
      $("#lpass").hide();
      $("#lg").text("Gender: ");
      $(".lbl").show();
      $("#country").val(data[i].country).removeAttr("disabled");
      $(":submit").show();
  }

  show= function(i){

      $('#h4').text('Customer Details');
      $("b").text("ID: "+data[i].id);
      $("b + br").show();
      $("b + br + br").show();
      $("#name").val(data[i].name).attr({disabled:''});
      $("#email").val(data[i].email).attr({disabled:''});
      $("#lpass").show();
      $("#pass").show();
      $("#pass").val(data[i].pass).attr({disabled:'',type:'text'});
      $("#lg").text("Gender: "+data[i].gender);
      $(".lbl").hide();
      $("#country").val(data[i].country).attr({disabled:''});
      $(":submit").hide();
  }

  del= function(id){
      if(confirm("Are you sure?"))
      $.ajax({
         url: 'delete',
         type: 'POST',
         data: {id: id},
         success: function(){
          load();
         }
      });
      else
        return;
  }

</script>

</body>
</html>
