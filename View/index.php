
<?php
  require '../Model/AdminModel.php';
  $dairy=new dairy();
  $data=$dairy->ShowCustomer();
//print_r($data);
  ?>
<html>
<?php include 'dash.php'; ?>
       <head>  
           <title>Dairy Farm</title>  
		   <link href="favicon.png" rel="shortcut icon"/>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
		   <style>
		    body { margin:0;padding:0; }
			
		   </style>
		     
      </head>  
<body>
   <div class="container">  
 
  
                <div class="table-responsive">  
		
				
                 <table id="employee_data" class="table table-striped table-bordered" width="100%">  
                   <thead>
							<tr>
							<th>Sr No</th>
							<th>Customer No.</th>
							<th>Customer Name.</th>
							<th>Mobile No</th>
							<th>Action</th>
							
							
							</tr>
							</thead>
							<tbody>
                            <?php 
                            $count=0;
                            foreach($data as $row)
                            {
                                $count=$count+1;

                             ?>
                              <tr>
                                  <td>
                                  <?php echo $count;?>

                                  </td>
                                  <td>
                                      <?php echo $row['customer_no'];?>
                                  </td>
                                  <td>
                                  <?php echo $row['customer_name'];?>
                                  </td>
                                  <td>
                                  <?php echo $row['phone_no'];?>

                                  </td>
                              
                                              <td>											 
											   <a href="dailyentry.php?id=<?php echo $row['id'];?>" class="btn btn-info btn-sm">
                                                  <span class="glyphicon glyphicon-edit"></span>Add
                                                  </a>
												  <a href="generatereport.php?gen=<?php echo $row['id'];?>"class="btn btn-info btn-sm">
                                                  <span class="glyphicon glyphicon-download-alt"></span>Report
                                                    </a>
													 <a href="showcustomer.php?showcustedit=<?php echo $row['id'];?>" class="btn btn-info btn-sm">
                                                  <span class="glyphicon glyphicon-edit"></span>Show
                                                  </a>
											 
											   </td>
											   
                                    </tr>	
									
                            <?php } ?>
                       </tbody>
                       </table>	
			</div>
		

</div>
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
	

<script>
$(document).ready( function () {
    $('#employee_data').DataTable();
} );
</script>	
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e609ed0c32b5c191739abab/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->	
				
</body>						
</html>

