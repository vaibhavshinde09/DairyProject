<?php
require '../Model/AdminModel.php';

$dairy=new dairy();
if(isset($_POST['action']) && $_POST['action']=="save"){

    $milktype=$_POST['milktype'];
    $fat=$_POST['fat'];
    $rate=$_POST['rate'];

    $dairy->addFatRate($milktype,$fat,$rate,$flag=1);
    
}
if(isset($_POST['dairyfrmsave']))
{
              $ondate            =      $_POST['ondate'];
			  $shift             =      $_POST['shift'];
			  $milktype          =      $_POST['milktype'];
			  $customerno       =      $_POST['customerno'];
			  $customer_name     =      $_POST['customer_name'];
			  $phone_no          =      $_POST['phone_no'];
			  $quantity          =      $_POST['quantity'];
			  $fat               =      $_POST['fat'];
			  $rate              =      $_POST['rate'];
			  $total             =      $_POST['total'];
              $vad=date('Y-m-d', strtotime($ondate));
              
              $dairy->InsertDailyEntry($shift,$milktype,$customerno,$customer_name,$phone_no,$quantity,$fat,$rate,$total,$vad);


}
if(isset($_POST['dailyupdate']))
{
                $id                =      $_POST['id'];
                $ondate            =      $_POST['ondate'];
                $shift             =      $_POST['shift'];
                $milktype          =      $_POST['milktype'];
                $customerno        =      $_POST['customerno'];
                $customer_name     =      $_POST['customer_name'];
                $phone_no          =      $_POST['phone_no'];
                $quantity          =      $_POST['quantity'];
                $fat               =      $_POST['fat'];
                $rate              =      $_POST['rate'];
                $total             =      $_POST['total'];
                $vad=date('Y-m-d', strtotime($ondate));

                $dairy->UpdateDailyEntry($id,$shift,$milktype,$customerno,$customer_name,$phone_no,$quantity,$fat,$rate,$total,$vad);


}

if(isset($_POST['action']) && $_POST['action']=="update"){
    $id=$_POST['id'];
    $vid=$_POST['vid'];
    $fat=$_POST['fat'];
    $rate=$_POST['rate'];

    $dairy->updateFatRate($id,$vid,$fat,$rate);
    
}
if(isset($_POST['login']))
{
    $username=$_POST['username'];
	$password=$_POST['password'];
	if(isset($_POST["remember"])){
			setcookie("username",$username,time()+(60*60*24*30));
			setcookie("password",$password,time()+(60*60*24*30));
		}
		else{
			if(isset($_COOKIE["username"])){
				unset($_COOKIE["username"]);
				setcookie("username", "", time()-3600);
			}
			if(isset($_COOKIE["password"])){
				unset($_COOKIE["password"]);
				setcookie("password", "", time()-3600);
			}
        }
        $dairy->login($username,$password);
	
}
if(isset($_POST['generateReport']))
{
    $customer_name=$_POST['customer_name'];
    $formdate=$_POST['formdate'];
    $todate=$_POST['todate'];
    $fmdate=date('Y-m-d', strtotime($formdate));
    $fdate="STR_TO_DATE('".$fmdate."', '%Y-%m-%d')";
    $toddate=date('Y-m-d', strtotime($todate));
    $tdate="STR_TO_DATE('".$toddate."', '%Y-%m-%d')";
    $file_type=$_POST['file_type'];
  
    $dairy->generateReportApp($customer_name,$fdate,$tdate,$file_type);
}
if(isset($_GET['deleteshowcust']))
{
    $id=$_GET['deleteshowcust'];
    $dairy->DeleteShowCustomer($id);
}
if(isset($_GET['id']))
{
$data=$dairy->ShowallCustomer($id);
}
if(isset($_GET['editdEntry']))
{
    $id=$_GET['id'];
}
if(isset($_POST['id']))
{
    $id=$_POST['id'];
    $dairy->ShowFatRate($id);
    
}
if(isset($_POST['phone_no']))
{
    $phone_no=$_POST['phone_no'];
    $dairy->AvibilityPhoneNo($phone_no);
}
if(isset($_POST['milktype_Id_fat']))
{
    $milktype_Id_fat=$_POST['milktype_Id_fat'];
    $dairy->getFatdata($milktype_Id_fat);
}
if(!empty($_POST["fatt"]) && !empty($_POST["milktype_id"]) )
{
    $milktype_id=$_POST['milktype_id'];
    $fatt=$_POST['fatt'];

    $dairy->getRatedata($milktype_id,$fatt);
}
if(isset($_POST['del_id']))
{
    $id=$_POST['del_id'];
    $dairy->DeleteFatRate($id);
    
}
if(isset($_POST['edit_id']))
{
    $id=$_POST['edit_id'];
    $row=$dairy->editFatApplication($id);
    echo json_encode($row);
}
$dairy->ShowCustomer();
$obj=new dairy();
//print_r($obj->ShowFatRate($id));

?>