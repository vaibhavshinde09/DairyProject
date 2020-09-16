
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
	   
	function getfat(val) {
			
					 $.ajax({
							 type: "POST",
							 url: "getfat.php",
							 data:'milktype='+val,
							 success: function(data)
							 {
							 $("#fat").html(data);
							 }
						 });
					 }
					
					
		            function getrate(val) {
						
			
					 $.ajax({
						 
							 type: "POST",
							 url: "getrate.php",
							     data:'fat='+val+"&milktype="+$("#milktype").val(),
							 success: function(data)
							 {
								
                                $("#rate").html(data);
							 }
						 });
					 }
		
                function userAvailability() {
                    $("#loaderIcon").show();
                    jQuery.ajax({
                        url: "mobile_check.php",
                        data: 'phone_no=' + $("#phone_no").val(),
                        type: "POST",
                        success: function(data) {
                            $("#user-availability-status1").html(data);
                            $("#loaderIcon").hide();
                        },
                        error: function() {}
                    });
                }