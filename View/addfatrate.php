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
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 

<!-- Bootstrap Date-Picker Plugin -->
<!-- <script type="text/javascript" src="config/js/dairymain.js"></script> -->
</head>
<body>

<div class="container">
<h1>Dairy Farm</h1>
 <form method="post" name="f1" action="" id="form-data"><br/>
 <div id="result"></div>
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
	<div class="form-group col-sm-4">
      <label for="namelbl">Fat </label>
      <input type="text" class="form-control" id="fat" name="fat" placeholder="Enter Your Fat" value="">
    </div>
	
	<div class="form-group col-sm-4">
      <label for="lblmb">Rate</label>
      <input type="text" class="form-control" id="rate" name="rate" placeholder="Enter your Fat Rate." value="">
    </div>
	
  </div>
  <input type="hidden" name="id" id="id" class="form-control" value="">
  <button type="submit" name="save" id="save" class="btn btn-info">submit</button>
   <button type="reset" name="reset" class="btn btn-info">Reset</button>
   <a href="index" button type="back" name="back" value="Validate" class="btn btn-info" id="save">Back</a>
   <br><br/>
  

</body>
<script>
  $(document).ready(function(){
      $('#save').click(function(){ 
       // e.preventDefault();
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                   //  data:(name:name, parentId:parentId).serialize()+"&action=submit",
                    data:$("#form-data").serialize()+"&action=save",
                     success:function(d){

                       console.log(d);
                       alert(d);
                       $("#form-data") [0].reset();       
               
                      }     				
                                 
                }); 
              });      
    
 });
  </script>
</html>