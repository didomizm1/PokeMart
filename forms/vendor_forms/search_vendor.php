<?php
if(isset($_POST['submit']))
{
	//connect to database
	include_once('../connect_mysql.php');

	$vendor_name=$_POST['vendor_name'];

	//setup query, selects row where vendor name matches input
	$query="SELECT * FROM vendors WHERE vendor_name='$vendor_name'";

	//execute query and display in table
    $result=mysqli_query($dbconn, $query);
		if(mysqli_num_rows($result) > 0)
		{
        echo "<table>";
            echo "<tr>";
                echo "<th>VID</th>";
                echo "<th>Vendor Name</th>";
                echo "<th>Vendor Code</th>";
                echo "<th>Vendor City</th>";
                echo "<th>Vendor Region</th>";
                echo "<th>Vendor Country</th>";
                echo "<th>Vendor Zip Code</th>";
                echo "<th>Vendor Contact Name</th>";
                echo "<th>Vendor Contact Title</th>";
                echo "<th>Vendor Contact Route</th>";
                echo "<th>Vendor Contact Number</th>";
            echo "</tr>";
        while($row = $result->fetch_assoc())
        {
            echo "<tr>";
                echo "<td>" . $row['VID'] . "</td>";
                echo "<td>" . $row['vendor_name'] . "</td>";
                echo "<td>" . $row['vendor_code'] . "</td>";
                echo "<td>" . $row['vendor_city'] . "</td>";
                echo "<td>" . $row['vendor_region'] . "</td>";
                echo "<td>" . $row['vendor_country'] . "</td>";
                echo "<td>" . $row['vendor_zip_code'] . "</td>";
                echo "<td>" . $row['vendor_contact_name'] . "</td>";
                echo "<td>" . $row['vendor_contact_title'] . "</td>";
                echo "<td>" . $row['vendor_contact_route'] . "</td>";
                echo "<td>" . $row['vendor_contact_number'] . "</td>";
            echo "</tr>";
        }
        echo "</table>"
    } 
    else
    {
        echo "No records matching vendor name were found.";//if input doesn't match a vendor in the database
    }
}?>
