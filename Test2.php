<?php
require_once 'Credentials.php';
    $conn=new mysqli($DBhostname,$DBusername,$DBpassword,$DBname);
    if($conn->connect_error)
        die("Fatal error");
    $query="Select MAX(ID) from Restaurants;
        Select * from Reviews;
        Select * from Restaurants;";
    $conn->multi_query($query);
    $result=$conn->store_result();
    $row = mysqli_fetch_array($result);
    $Max=$row['MAX(ID)'];
    $conn -> next_result();
    $result2=$conn -> store_result();
    $rows=$result2->num_rows;
    $RatAve=array();
    for($i=1;$i<$Max+1;$i++){
        $total=0;
        $num=0;
        $result2->data_seek(0);
        for($i2=0;$i2<$rows;$i2++){
            $row3=$result2->fetch_array(MYSQLI_ASSOC);
            $ID=$row3["ID"];
            if($ID==$i){
                $total=$total+$row3["Star Rating"];
                $num++;
            }
        }
        if($total>0){
            $average=$total/$num;
        } else{
            $average="";
        }
        $string=strval($i);
        $RatAve += [$string => $average];
        print "$i -- $average";
        print "<br>";
    }
?>