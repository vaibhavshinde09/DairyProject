<?php 
  require '../Model/AdminModel.php';
  $dairy=new dairy();
  ?>	


<!------ Include the above in your HEAD tag ---------->


<html>
<?php include 'dash.php'; ?>
<head>
<title>Add New User</title>  
 <link href="favicon.png" rel="shortcut icon"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<!--<script type="text/javascript" src="main/js/dairymain.js"></script>--->

<!------ Include the above in your HEAD tag ---------->

</head>
<!-- Bootstrap Date-Picker Plugin -->

<?php	

//$customer_no=$dairy->getCustomerId();

//$id=$_GET['id'];
$id = isset($_GET['id']) ? $_GET['id'] : '';
$data=$dairy->getAllCustomData($id);
//print_r($data);
foreach($data as $row)
{
  $customer_no=$row['customer_no'];
  $customer_name=$row['customer_name'];
  $id=$row['id'];
  $phone_no=$row['phone_no'];


}
  ?>
  
   

<!------ Include the above in your HEAD tag ---------->


							
<body>
<div class="container">
<h1>Dairy Farm</h1>

 <form method="post" name="f1" action="action.php" onsubmit="return validate()" id="form-entry-data">
	<div class="col-sm-12">
	<div class="row">
	<div class="col-sm-4 form-group">
    <label for="Lblfat"> Customer No</label>

    <input type="text" id="customerno" name="customerno" autocomplete="off" class="form-control"   value="<?php echo $customer_no;?>">

	</div>
                      
  
	
	<div class="form-group col-sm-4">
    <label for="Lblfat"> Customer Name</label>

    <input type="text" id="customer_name" name="customer_name" autocomplete="off" class="form-control"  value="<?php echo $customer_name;?>">

	</div>
	
	<div class="form-group col-sm-4">
      <label for="lblmb">Mobile No.</label>
	  
      <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Enter your Mobile No."   onBlur="userAvailability()" 
      value="<?php echo $phone_no;?>">
	  <span id="user-availability-status1" style="font-size:12px;"></span>
    </div>
  </div>
 <?php
  $timezone = "Asia/Colombo";
  date_default_timezone_set($timezone);
  $ondate = date("d-m-Y");
?>
 <div class="row">
    <div class="form-group col-sm-4">
     <label class="control-label" for="date">Date</label>
        <input class="form-control" id="ondate" name="ondate" autocomplete="off" placeholder="YY/MM/DD" type="text" value="<?php echo $ondate;?>"  />  
    </div>
	<div class="form-group col-sm-4">
      <label for="inputState">Shift</label>
      <select id="shift" name="shift" class="form-control" value="<?php echo $shift;?>">
        <option value="">Select Shift</option>
        <option value="Morning">Morning</option>
		<option value="Evening">Evening</option>
      </select>
    </div>
	
		<div class="form-group col-sm-4">
      <label for="inputState">Milk</label>
	 <select name="milktype" id="milktype" autocomplete="off" class="form-control" onChange="getfat(this.value);"value="<?php echo $milktype;?>" >
																		 <option value="" >Select Milk Type</option>
                                        <?php
                                        $data=$dairy->getMilkTypeRecord();
                                        foreach($data as $member)
                                        {
                                            echo "<option id='".$member['id']."' value='".$member['id']."'==$vid ? 'selected' : ''>".$member['milktype']."</option>";

                                        }?>
                                        
															  
						  </select>
	
	</div>
	
	</div>
   <div class="row">
    
	<div class="form-group col-sm-4">
	  <label for="Lblfat">Fat</label>
	<select name="fat" class="form-control" id="fat"  autocomplete="off"  onChange="getrate(this.value);"  value="<?php echo $fat;?>" >
																		
													</select>
	
</div>

	

<div class="form-group col-sm-4">
	  <label for="Lblfat">Rate/LTR</label>
	<select name="rate" class="form-control" id="rate"  autocomplete="off" onkeyup="return num();"  value="<?php echo $rate;?>" >
																
															
															
													</select>
	
</div>

<div class="form-group col-sm-4">
      <label for="lblltr">Quantity(LTR)</label>
      <input type="text" class="form-control" id="quantity" name="quantity" onkeyup="num();"  >
    </div>
	
  </div>
   <div class="row">
    <div class="form-group col-sm-4">
      <label for="lblltr">Total</label>
      <input type="text" class="form-control" id="total" name="total" readonly="readonly" >
    </div>
	
	</div>
	
	<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id;?>">
	
   <button type="submit" class="btn btn-info" name="dailyupdate" id="dailyupdate">Add</button>
	   <a href="index" button type="back" name="back" class="btn btn-info" id="back">Back</a>
   </div>

</form>
</div>
<script>

function validate()
{
if (document.f1.customer_name.value == "") {
alert("Please Enter customer_name..");
document.f1.customer_name.focus();
return false;
}
if (document.f1.phone_no.value == "") {
alert("Please Enter Your Mobile No..");
document.f1.phone_no.focus();
return false;
}
if (document.f1.shift.value == "") {
alert("Please select Shift type..");
document.f1.shift.focus();
return false;
}
if (document.f1.milktype.value == "") {
alert("Please Select Milk Type..");
document.f1.milktype.focus();
return false;
}
if (document.f1.fat.value == "") {
alert("Please Select Your Flat Type..");
document.f1.fat.focus();
return false;
}
if (document.f1.quantity.value == "") {
alert("Please Enter Milk IN Ltr..");
document.f1.quantity.focus();
return false;
}
}
	
function num()
       {
            var numVal1 = Number(document.getElementById("quantity").value);
            var numVal2 = Number(document.getElementById("rate").value);
            var totalValue = numVal1 * numVal2;
            document.getElementById("total").value = totalValue.toFixed(2);
       }

// function num() {
	
	
//        var txtFirstNumberValue = document.getElementById('quantity').value;
//       // var txtSecondNumberValue = document.getElementById('tt').value;
// 	   var e = document.getElementById("rate");
//        var txtSecondNumberValue = e.options[e.selectedIndex].value;
//        if (txtFirstNumberValue == "")
//            txtFirstNumberValue = 0;
//        if (txtSecondNumberValue == "")
//            txtSecondNumberValue = 0;

//        var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
//        if (!isNaN(result)) {
//            document.getElementById('total').value = result;
//        }
//    }
	function getfat(val) {

    var milktype_Id_fat = $('#milktype').val();  

			
					 $.ajax({
							 type: "POST",
							 url: "action.php",
							 data:{milktype_Id_fat:milktype_Id_fat},
							 success: function(fat)
							 {
                                console.log(fat);
                                fat=JSON.parse(fat);
                                console.log(fat);
                                $('#fat').empty();
                                fat.forEach(function(fat)
                                {
                                    $('#fat').append('<option>' + fat.fat +'</option>')
                                })
							 }
						 });
					 }
					
                     
		            
                function userAvailability() {
                    $("#loaderIcon").show();
                    jQuery.ajax({
                        url: "action.php",
                        data: 'phone_no=' + $("#phone_no").val(),
                        type: "POST",
                        success: function(data) {
                            $("#user-availability-status1").html(data);
                            $("#loaderIcon").hide();
                        },
                        error: function() {}
                    });
                }
</script>
<script>
function getrate(val) {
						
            var fatt = $('#fat').val();  
            var milktype_id = $('#milktype').val();  

              $.ajax({
                  
                      type: "POST",
                      url: "action.php",
                          data:{fatt:fatt,milktype_id:milktype_id},
                        
                      success: function(response)
                      {
                                response=JSON.parse(response);
                                $('#rate').empty();

                               // console.log(response);
                                response.forEach(function(response)
                                {
                                    $('#rate').append('<option>' + response.rate +'</option>')
                                })

                      }
                  });
              }
 
</script>
 
	<script>
	
	$(document).ready(function(){
		var date_input=$('input[name="ondate"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			
			format: 'dd-mm-yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
			
		
		})
	})
</script>	
	 
<!--<script>
function test() {
	
  var min = 001;
  var max = 100;
  var num = Math.floor(Math.random() * (max - min + 1)) + min;
  //var timeNow = new Date().getTime();
  var ckt=1
  document.getElementById('customer_no').value = num + '_' + ckt;
}
window.onload = test;
(function () {
  console.log(document.getElementById('customer_no').value);
});
</script>---->
					 
</body>
</html>