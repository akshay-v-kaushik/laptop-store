<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="nav2.css">
    <link rel="stylesheet" type="text/css" href="form6.css">
    <link rel="stylesheet" type="text/css" href="table3.css">
    <title>Bill</title>
</head>
<body>

    <center>
	    <div class="head" style="width:100%; margin-right:0px; margin-left:0px">
	    <h2> INVOICE</h2>
        <hr>
	    </div>
	</center>
<br>

    
        <?php 
            include "config.php";
            $qry1="select * from sales ORDER BY sale_id DESC LIMIT 1";
            $result1=$conn->query($qry1); 
            $row1=$result1->fetch_row();
            $sid=$row1[0];
            $cid=$row1[1];
            $stime = $row1[3];
            $sdate = $row1[2];
            $stotal = $row1[4];
            $eid=$row1[5];


            $qry2="SELECT * from customer where c_id=$cid";
            $result2=$conn->query($qry2); 
            $row2=$result2->fetch_row();
            $c_name= $row2[1]." ".$row2[2];
            $c_phno = $row2[5];
            $c_mail = $row2[6];

            
            echo '<br><center>
                    <div class="one row" style="padding:0px; margin:0px;width:100%;margin-top:25px;">
                        <h4>Sale ID:&nbsp;&nbsp;'.$sid.'<h4>
                    </div>
                  </center><br><br>';

            echo '<div class="one row" style="width:100%;padding:0px; margin:0px;">
                    <div class="column" style="padding-left:30px">
                        <h5>Customer ID:&nbsp;&nbsp;'.$cid.'</h5>
                        <h5>Customer Name:&nbsp;&nbsp;'.$c_name.'</h5>
                        <h5>Time:&nbsp;&nbsp;'.$stime.'</h5>
                        <h5>Date:&nbsp;&nbsp;'.$sdate.'</h5>
                    </div>
                    <div class="column" style="float:right; margin-right:0px;">
                        <h5>Employee ID:&nbsp;&nbsp;'.$eid.'</h5>
                    </div>
                  </div>';

            //products

                    echo "<center>
                    <table id='table1'>
                    <tr>
                        <th>Laptop ID</th>
                        <th>Laptop Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                    </tr>";

                    $qry3 = "SELECT lap_id,sale_qty,tot_price FROM sales_items where sale_id=$sid";
                        $result3 = $conn->query($qry3);
                        $sum=0;

                        if ($result3->num_rows > 0) {
                
                        while($row3 = $result3->fetch_assoc()) {
                    
                        $lapid=$row3["lap_id"];
                        $qry4 = "SELECT lap_name,lap_price FROM laptop where lap_id=$lapid";
                        $result4 = $conn->query($qry4);
                        $row4=$result4->fetch_row();
                        
                        echo "<tr>";
                            echo "<td>" . $row3["lap_id"]. "</td>";
                            echo "<td>" . $row4[0] . "</td>";
                            echo "<td>" . $row3["sale_qty"]. "</td>";
                            echo "<td>" . $row4[1] . "</td>";
                            echo "<td>" . $row3["tot_price"]. "</td>";
                        echo "</tr>";
                        }
                        echo "</table>";
                    }

                    echo "<table id='table1'>
					
                    <tr style='background-color: #f2f2f2;'>
                    <td>Total</td>
                    <td>";echo $stotal;
                    echo "</td>
                    </tr>
                    </table></center>";
               
        
        ?>
        <br><br>
        <center>
         <a name='pos1' class='button1 view-btn' href=pos1.php?sid=".$sid.">Go Back to Sales Page</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <button type="submit" class='button1 view-btn' onclick="myFunction()">Print</button> 

        </center>

                <script>
                    function myFunction() {
                        window.print();
                    }
                </script>>
</body>
</html>