<?php
require_once 'Credentials.php';
$number=0;
echo $number;
/*function getstarLevel($ID){
    $conn2=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
    if($conn->connect_error)
    die("Fatal error");
    $query="Select * from Reviews";
    $results=$conn->query($query);
    $rows2=$result->num_rows;
    $total=0;
    $nums=0;
    for($i=0;$i<$rows;$i++){
        $row2=$results->fetch_array(MYSQLI_ASSOC);
        if($row["ID"]==$ID){
            $total=$total+$row2["Star Rating"];
            $nums=$nums+1;
        }
    }
    return $total/$nums;*/
}
?>