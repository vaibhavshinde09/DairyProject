<html>
  <?php 
  require '../Model/AdminModel.php';
//   $db=$dairy->getMilkTypeRecord();
//  print_r($db);
$dairy=new dairy();
  ?>
  
<head>
<?php include 'dash.php';
  ?>
<title>Dairy Farm</title>  
 <link href="favicon.png" rel="shortcut icon"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
<!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js" integrity="sha512-aDa+VOyQu6doCaYbMFcBBZ1z5zro7l/aur7DgYpt7KzNS9bjuQeowEX0JyTTeBTcRd0wwN7dfg5OThSKIWYj3A==" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>



<!-- Bootstrap Date-Picker Plugin -->
<style>
  
</style>
</head>
<body>

<div class="container" id="vsd">
<h1>Dairy Farm</h1>
 <form method="post" name="f1" action="" id="form-data">
 <div class="col-sm-12">
 <div class="row">
	<div class="col-sm-4 form-group">
      <label for="inputState">Milk</label>
	 <select name="milktype" id="milktype" autocomplete="off" class="form-control" value="">
     <option selected="" disabled="">Select Milk Type</option>
    <?php 
                                    $data=$dairy->getMilkTypeRecord();

		                    		foreach ($data as $member) {
		                    			echo "<option id='".$member['id']."' value='".$member['id']."'>".$member['milktype']."</option>";
		                    		}
		                    	 ?>
  
                                   </select>
    </div>
 </div>
 </div>
 </form></div>
 <table  id="employee_data">
  </table>
 </div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Edit Fat Rate.</h4>
      </div>
      <div class="modal-body">
        <form method="post" name="f1" action="" id="form-data-edit"><br/>

        <div class="form-group">
            <label for="name" class="control-label">MilkType:</label>
            <select name="vid" id="vid" autocomplete="off" class="form-control"value="$vid" >
            <option selected="" disabled="">Select Milk Type</option>
            <?php 
                                    $data=$dairy->getMilkTypeRecord();

		                    		foreach ($data as $member) {
		                    			echo "<option id='".$member['id']."' value='".$member['id']."'==$vid ? 'selected' : ''>".$member['milktype']."</option>";
		                    		}
		                    	 ?>
  
								   </select>
	

          </div>
          <div class="form-group">
            <label for="name" class="control-label">Fat:</label>
            <input type="text" class="form-control" id="fat" name="fat" autocomplete="off" value="">
          </div>
          <div class="form-group">
            <label for="name" class="control-label">Rate:</label>
            <input type="text" class="form-control" id="rate" name="rate" autocomplete="off">
          </div>
          <input type="hidden" name="id" id="id" value="">
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" name="update" id="update">Update</button>
      </div>
    </div>
  </div>
</div>
 <script>  
 $(document).ready(function(){  
      // ShowFatRate();
      $('#milktype').change(function(){  
        
           var id = $(this).val();  
           $.ajax({  
               
                url:"action.php",  
                method:"POST",  
                data:{id:id},  
                success:function(data){  
                 // console.log(data);
                     $('#employee_data').html(data);  
                }  
           });  
      });  
      $("body").on("click",".editbtn",function(e)
     {
          e.preventDefault();
          edit_id=$(this).attr('id');
          $.ajax({
            url:"action.php",
            type:"POST",
            data:{edit_id:edit_id},
            success:function(response){
              data=JSON.parse(response);
              console.log(response);
              console.log(data);
              console.log(data[0].vid);
             $("#id").val(data[0].id);
             $("#vid").val(data[0].vid);
             $("#fat").val(data[0].fat);
             $("#rate").val(data[0].rate);

            }
          });
     });
     $("#update").click(function(e){
       if($("#form-data-edit")[0].checkValidity()){
         e.preventDefault();
         $.ajax({ 
                     url:"action.php",  
                     method:"post",  
                     data:$("#form-data-edit").serialize()+"&action=update",
                     
                     success:function(response){
                       console.log(response);
                       Swal.fire({
                         title:'FatRate Added successfully',
                         type:'success'
                       })
                       $('#exampleModal').modal('hide');
                       return false;


                      $("#form-data-edit")[0].reset();
                      // $("#exampleModal").model('hide');
                       //jQuery('#form-content').modal();

                     }    
                 });
       }

     });
     $("body").on("click",".deletebtn",function(e)
     {
          e.preventDefault();
          var tr= $(this).closest('tr');
          del_id=$(this).attr('id');

          Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
          if (result.value) {
            $.ajax({
              url:"action.php",
              type:"POST",
            data:{del_id:del_id},
            success:function(response)
            {
              tr.css('background-color','#ff6666');
              Swal.fire(
                         'Deleted!',
                         'Your file has been deleted.',
                         'success'
                      )
                      
            }
            
            });
         
          }
          });
        

     });
     

 });  
 
  </script>
    </body>
</html>
