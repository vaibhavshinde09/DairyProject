<?php
  require '../Model/AdminModel.php';
  $dairy=new dairy();

?>
<html>
<?php include 'dash.php'; ?>
       <head>  
           
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
 
   	<div class="" style="padding-top:20px;padding-left:40%;">
	  
         		</div><br/>

                <div class="table-responsive" >  
		
				
                 <table id="employee_data" class="table table-striped table-bordered" width="100%">  
                   <thead>
							<tr>
							<th>Sr No</th>
							<th>On Date</th>
							<th>Milk Type.</th>
                            <th>Shift</th>
                            <th>Quantity(LTR).</th>
                            <th>Fat</th>
                             <th>Rate</th>
							<th>Total</th>
							<th>Action</th>
							</tr>
					</thead>
							<tbody>
                         <?php
						  
						  
						       $id=$_GET['showcustedit'];
                               $data=$dairy->ShowallCustomer($id);
                               $counter=1;
                               foreach($data as $row)
                               {
                               
                                   ?>
                                   <tr>

                           
                                             <td><?php echo $counter++; ?></td>	
                                              											 
                                             <td>
                                                 <?php
                                             $timestamp         =   strtotime($row['ondate']);
                                              $new_date = date("d-m-Y", $timestamp);?>

                                                 <?php echo $new_date; ?>
                                                </td>	
                                             <td><?php echo $row['milktype']; ?></td>	
                                             <td><?php echo $row['shift']; ?></td>
                                             <td><?php echo $row['quantity']; ?></td>	
                                             <td><?php echo $row['fat']; ?></td>
                                            
                                             <td><?php echo $row['rate']; ?></td>	
                                             <td><?php echo $row['total']; ?></td>
                                            
                                              <td>											 

													 <a href="action.php?deleteshowcust=<?php echo $row['id'];?>" class="btn btn-danger btn-sm">
                                                  <span class="glyphicon glyphicon-cancel"></span>Delete
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

