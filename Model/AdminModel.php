<?php 
require 'dbconfig.php';
include '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;


class dairy{
    private $db;
    private $con;

    public function __construct()
    {
        $this->db = new DbConnect;
		$this->con =$this->db->connect();

    }
    public function login($username,$password)
    {
        $sql="SELECT * FROM `tbl_user` WHERE `username`='$username' AND `password`='$password'";
        $stmt = $this->con->prepare($sql);
        $stmt->execute(array(":username" => $username,":password"=>$password));
        if ($stmt->execute()) {
            $number_of_rows = $stmt->rowCount();
            if ($number_of_rows > 0)
            {
                    session_start();

                    $row=$stmt->fetch(PDO::FETCH_ASSOC);
                  //  $user_id=$row['user_id'];
                    $username=$row['username'];
                    $password=$row['password'];

                    echo '<script language="javascript">';	
                    echo 'alert(" login Successfully"); location.href="index"';	
                    echo '</script>';
    

            }
            else
            {
                header("Location:login?err=1");
            }
        }
        else
        {
            echo "Error";
        }
        return true;
    }
    
    // public function Insert()
    // {
    //     $sql="INSERT INTO tbl_member(`name`,`parentId`,`createdate`)VALUES('$name','$parentId',NOW())");

    // }
    public function getUserById($id){
        $sql="select * from tbl_user where id= :id";
        $stmt = $this->con->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function editFatApplication($id){

        $sql="SELECT ft.`id`,tbl.`id`as vid,ft.`fat`,ft.`rate` FROM `tbl_addfat_rate` ft
        INNER JOIN `tbl_milktype` tbl ON tbl.`id`=ft.`milktype` WHERE ft.`id`='$id'";
        $stmt = $this->con->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function ShowallCustomer($id)
    {
        $sql="SELECT 
        tbl.id,
        tbl.`ondate`,
        tbl.`shift`,
        ml.`milktype`,
        tbl.`quantity`,
        tbl.`fat`,
        tbl.`rate`,
        tbl.`total` 
      FROM
        `tbl_daily_entry` tbl 
        LEFT JOIN `tbl_milktype` ml 
          ON ml.`id` = tbl.`milktype` 
      WHERE  `customer_id`='$id' ORDER BY tbl.`ondate` ASC";
      $stmt = $this->con->prepare($sql);
      $stmt->execute();
      $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;

    }
    public function DeleteShowCustomer($id)
    {
        $sql="DELETE FROM `tbl_daily_entry` WHERE id='$id'";
        $stmt = $this->con->prepare($sql);
        if($stmt->execute())
        {
            echo '<script language="javascript">';
            echo 'alert("Deleted Successfully"); location.href="index"';
            echo '</script>';
    
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Plz Check Data Not Deleted)';
            echo '</script>';
    
        }

      
    }
    public function DeleteFatRate($id)
    {
        $sql="DELETE  FROM `tbl_addfat_rate` WHERE id='$id'";
        $stmt = $this->con->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }

    public function getDailyEntryRecords()
    {
        $data=array();
        $sql="select * from tbl_customer";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $data[] =$row;
            }
            return $data;
    }
    public function getMilkTypeRecord()
    {
        $data=array();
        $sql="select * from tbl_milktype";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $data[] =$row;
            }
            return $data;
    }
    public function ShowCustomer()
    {
        $data=array();
        $sql="select * from tbl_customer";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $data[] =$row;
            }
            return $data;
 
    }
    public function getCustomerId()
    {
        $data=array();
        $sql="select max(id+1) as customer_no from tbl_customer";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $data[]=$result;
        foreach($result as $row)
        {
           $customer_no=$row['customer_no'];
        }
        return $customer_no;

    }
    public function getFatdata($milktype_Id_fat)
    {
        $sql="SELECT `fat` FROM `tbl_addfat_rate` WHERE `milktype`=$milktype_Id_fat";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);

    }
    public function getRatedata($milktype_id,$fatt)
    {
        $sql="SELECT `rate` FROM `tbl_addfat_rate` WHERE `milktype`=$milktype_id AND fat=$fatt";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result1=$stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result1);
      //echo $result;

    }
    public function AvibilityPhoneNo($phone_no)
    {
        $sql="select * from tbl_customer where phone_no='$phone_no'";
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute()) {
            $number_of_rows = $stmt->rowCount();
            if ($number_of_rows > 0)
            {
                echo "<span style='color:red'> Mobile No already exists .</span>";
                echo "<script>$('#save').prop('disabled',true);</script>";
         
            }
            else
            {
                echo "<span style='color:green'> Mobile available for Registration .</span>";
                echo "<script>$('#save').prop('disabled',false);</script>";
        
            }
        }
        else
        {
            echo "Something Wrong Plz Check Query";
        } 
        return true;
        
    }

    

    // function loadMember() {
      
	// 	$stmt =$this->con->prepare("SELECT * FROM `tbl_milktype`");
	// 	$stmt->execute();
	// 	$member = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return $member;
    // }
    public function ShowFatRate($id=0)
    {
        $data=array();
        $sql="SELECT cd.`date`,cd.`id`,tbl.`milktype`,cd.`fat`,cd.`rate`,tbl.`id` AS vid FROM `tbl_addfat_rate`
         cd INNER JOIN `tbl_milktype` tbl ON tbl.`id`=cd.`milktype` WHERE tbl.id='$id'";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $data[]=$result;
        return $data;     
            
    }
    public function InsertDailyEntry($shift,$milktype,$customerno,$customer_name,$phone_no,$quantity,$fat,$rate,$total,$vad)
    {
        $sql="call usp_insert_daily_entry('0','$customerno','$customer_name','$phone_no',STR_TO_DATE('$vad', '%Y-%m-%d'),'$shift','$milktype','$quantity','$fat','$rate','$total')";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        if($stmt->execute())
        {
            echo '<script language="javascript">';
            echo 'alert(" Applied Successfully"); location.href="index"';
            echo '</script>';
    
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Data Not Inserted");';
            echo '</script>';
    
        }
        return true;


    }
    public function UpdateDailyEntry($id,$shift,$milktype,$customerno,$customer_name,$phone_no,$quantity,$fat,$rate,$total,$vad)
    {
        $sql="update tbl_customer set customer_name='$customer_name',customer_no='$customerno',phone_no='$phone_no',status=0 where id='$id'";
        $sql1="INSERT INTO tbl_daily_entry(ondate,shift,milktype,quantity,fat,rate,total,customer_id)VALUES(STR_TO_DATE('$vad', '%Y-%m-%d'),'$shift','$milktype','$quantity','$fat','$rate','$total',$id)";
        $stmt = $this->con->prepare($sql1);
         $stmt->execute();
        if($stmt->execute())
        {
            echo '<script language="javascript">';
            echo 'alert("Update Successfully"); location.href="index"';
            echo '</script>';
    
        }
        else
        {
            echo '<script language="javascript">';
            echo 'alert("Not Update Plz Check")';
            echo '</script>';
    
        }
        return true;


    }

    public function getAllCustomData($id)
    {
        $data=array();
        $sql="select * from tbl_customer where id='$id'";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row)
        {
            $data[]=$row;
        }
       // $data[]=$result;
        return $data;    
      

    }
    public function generateReportApp($customer_name,$fdate,$tdate,$file_type)
    {
        if($customer_name!='')
        {
             $sql="select tb.customer_name,t.ondate,t.shift,mkl.milktype,t.quantity,t.fat,t.rate,t.total,
             coalesce((select sum(quantity) from tbl_daily_entry de where ondate>=$fdate and
              ondate<=$tdate and de.id<=t.id and de.customer_id=t.customer_id ),0)as qtysum,
             coalesce((select sum(total) from tbl_daily_entry de where ondate>=$fdate and ondate<=$tdate 
             and de.id<=t.id and de.customer_id=t.customer_id),0)as totalsum  
                     from tbl_daily_entry t
                     inner join tbl_milktype mkl on mkl.id=t.milktype 
                     inner join tbl_customer tb on tb.id=t.customer_id 
                     where t.ondate>=$fdate and t.ondate<=$tdate and  t.customer_id=$customer_name ORDER BY t.`ondate` ASC";
        }
        else
        {
            $sql="select tb.customer_name,t.ondate,t.shift,mkl.milktype,t.quantity,t.fat,t.rate,t.total,
                         coalesce((select sum(quantity) from tbl_daily_entry de where ondate>=$fdate and ondate<=$tdate and de.id<=t.id ),0)as qtysum,
                         coalesce((select sum(total) from tbl_daily_entry de where ondate>=$fdate and ondate<=$tdate and de.id<=t.id ),0)as totalsum  
                         from tbl_daily_entry t
                         inner join tbl_milktype mkl on mkl.id=t.milktype 
                         inner join tbl_customer tb on tb.id=t.customer_id 
                         where t.ondate>=$fdate and t.ondate<=$tdate ORDER BY t.`ondate` ASC";
        }
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $file = new Spreadsheet();

        $active_sheet = $file->getActiveSheet();
      
        $active_sheet->setCellValue('A1', 'Customer Name');
        $active_sheet->setCellValue('B1', 'Date');
        $active_sheet->setCellValue('C1', 'Shift');
        $active_sheet->setCellValue('D1', 'Milk');
        $active_sheet->setCellValue('E1', 'Quantity(LTR)');
        $active_sheet->setCellValue('F1', 'Fat');
        $active_sheet->setCellValue('G1', 'Rate');
        $active_sheet->setCellValue('H1', 'Total');
        $active_sheet->setCellValue('I1', 'LTR Total');
        $active_sheet->setCellValue('J1', 'All Total(RS)');
      
      
        $count = 2;
      
        foreach($result as $row)
        {
          $active_sheet->setCellValue('A' . $count, $row["customer_name"]);
          $active_sheet->setCellValue('B' . $count, $row["ondate"]);
          $active_sheet->setCellValue('C' . $count, $row["shift"]);
          $active_sheet->setCellValue('D' . $count, $row["milktype"]);
          $active_sheet->setCellValue('E' . $count, $row["quantity"]);
          $active_sheet->setCellValue('F' . $count, $row["fat"]);
          $active_sheet->setCellValue('G' . $count, $row["rate"]);
          $active_sheet->setCellValue('H' . $count, $row["total"]);
          $active_sheet->setCellValue('I' . $count, $row["qtysum"]);
          $active_sheet->setCellValue('J' . $count, $row["totalsum"]);
          
          $count = $count + 1;
        }
      
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, $_POST["file_type"]);
      
        $file_name = time() . '.' . strtolower($_POST["file_type"]);
      
        $writer->save($file_name);
      
        header('Content-Type: application/x-www-form-urlencoded');
      
        header('Content-Transfer-Encoding: Binary');
      
        header("Content-disposition: attachment; filename=\"".$file_name."\"");
      
        readfile($file_name);
      
        unlink($file_name);
      
        exit;
       
      

    }

    public function addFatRate($milktype,$fat,$rate)
    {
     $flag=0;
     $sql="SELECT * FROM `tbl_addfat_rate` WHERE `milktype`='$milktype' AND `fat`='$fat'";
     $stmt = $this->con->prepare($sql);
     if ($stmt->execute()) {
        $number_of_rows = $stmt->rowCount();
        if ($number_of_rows > 0)
         {
            //   echo "<div class='alert alert-warning alert-dismissible' role='alert'>
            //   <button type='button'class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            //   Milktype and Fat Allready Exit.</div> ";
            echo "not inserted";

         }
     else
        {
            $sql="INSERT INTO tbl_addfat_rate(milktype,fat,rate,date)VALUES(:milktype,:fat,:rate,now())";
            $stmt = $this->con->prepare($sql);
            $stmt->execute(['milktype'=>$milktype,'fat'=>$fat,'rate'=>$rate]);
            $flag=2;
            // echo "<div class='alert alert-success alert-dismissible' role='alert'>
            //   <button type='button'class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
            //   Data Inserted</div> ";
              echo "inserted";

  

       }

    }
    return true;
    
   } 
   public function UserData()
   {
       $sql="SELECT * FROM `tbl_user`";
       $stmt = $this->con->prepare($sql);
       $stmt->execute();
       $r_rows=$stmt->rowCount();
       return $r_rows;
   }
   public function updateFatRate($id,$vid,$fat,$rate)
   {
        
       $sql="UPDATE `tbl_addfat_rate` SET `milktype`='$vid',
       `fat`='$fat',`rate`='$rate',`date`=NOW() WHERE `id`=$id";
       $stmt = $this->con->prepare($sql);
       $stmt->execute(['vid'=>$vid,'fat'=>$fat,'rate'=>$rate]);
       return true;
       
   }
  
}

$ob=new dairy();

//print_r($ob->getCustomerId());
?>