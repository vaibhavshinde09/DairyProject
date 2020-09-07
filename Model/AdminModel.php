<?php 
require 'dbconfig.php';

class dairy{
    private $db;
    private $con;

    public function __construct()
    {
        $this->db = new DbConnect;
		$this->con =$this->db->connect();

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
    public function addFatRate($milktype,$fat,$rate)
    {
     $sql="INSERT INTO tbl_addfat_rate(milktype,fat,rate,date)VALUES(:milktype,:fat,:rate,now())";
     $stmt = $this->con->prepare($sql);
     $stmt->execute(['milktype'=>$milktype,'fat'=>$fat,'rate'=>$rate]);
     return true;
   }
   public function rowCount()
   {
       $sql="SELECT * FROM `tbl_user`";
       $stmt = $this->con->prepare($sql);
       $stmt->execute();
       $r_rows=$stmt->rowCount();
       return $r_rows;
   }
   public function updateFatRate($milktype,$fat,$rate)
   {
       $sql="";
       $stmt = $this->con->prepare($sql);
       $stmt->execute(['milktype'=>$milktype,'fat'=>$fat,'rate'=>$rate]);
       return true;
       
   }
}

$ob=new dairy();
print_r($ob->rowCount());
?>