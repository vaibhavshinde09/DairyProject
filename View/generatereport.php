<?php
require '../Model/AdminModel.php';
$dairy=new dairy();

?>
<html>
<?php include 'dash.php'; ?>
<head>
<title>Dairy Farm</title>  
 <link href="favicon.png" rel="shortcut icon"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


<!------ Include the above in your HEAD tag ---------->

</head>
<body>
 <div class="container">
    <h2>Dairy Farm</h2>
	



 <form method="post" action="action.php">

<div class="col-sm-12">
<div class="row">
<div class="form-group col-sm-4">
      <label for="inputState">Customer Name</label>
     <select name="customer_name" id="customer_name" autocomplete="off" class="form-control"  >
     <option value="" >All Customer Data</option>					

                                            <?php
                                          $id		=	$_GET['gen'];
                                        $data=$dairy->getAllCustomData($id);
                                        
                                        foreach($data as $member)
                                        {
                                            echo "<option id='".$member['id']."' value='".$member['id']."'==$id ? 'selected' : ''>".$member['customer_name']."</option>";

                                        }?>
                                     		
													   </select>
							
										  
	
    </div>
    
	
	

    <div class="form-group col-sm-4">
     <label class="control-label" for="date"> From Date</label>
        <input class="form-control" id="formdate" name="formdate" autocomplete="off" placeholder="MM/DD/YYY" type="text" />  
    </div>

  
    <div class="form-group col-sm-4">
     <label class="control-label" for="date">To Date</label>
        <input class="form-control" id="todate" name="todate" autocomplete="off" placeholder="MM/DD/YYY" type="text" />  
    </div>
	<div class="form-group col-sm-4">
      <label for="inputState">File Type</label>
      <select id="file_type" name="file_type" class="form-control">
       <option value="Xlsx">Xlsx</option>
       <option value="Xls">Xls</option>
       <option value="Csv">Csv</option>
      </select>
    </div>
	</div>
   	<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
    <button type="submit" name="generateReport" class="btn btn-info" id="generateReport">Generate</button>
	<a href="index" button type="back" name="back" class="btn btn-info" id="save">Back</a>
</div>
 </form>
</div>

 
 <script>
	$(document).ready(function(){
		var date_input=$('input[name="formdate"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			
			format: 'dd-mm-yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			
		
		})
	})
</script>
<script>
	$(document).ready(function(){
		var date_input=$('input[name="todate"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			
			format: 'dd-mm-yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			
		
		})
	})
</script>
</body>
</html>
    