

<!-- 1. create a form to get the inventory information such as product code,name of the product,price,year of purchase,expiry date and the department using the product,
// 2. Insert a sample 5 into the MYSQL database , Update the price of the particular product into the database
// 3. retrieve and display all the records in a tabular format .
// 4. Display by product id
// 5. sort data by product id.
// 6. Retrive and display the records of the particular product from database in a table form by inputting either product code or name of the product
// 7. sort the records based on product name
// 8. count number of products in each department (give same department name for 2 products while insert)
// 9. Fetch and display the first 2 products
// 10. fetch and display all the products with the products name starts with 'a'
// 11. fetch and display all the products with the products ends with 'r'
// 12. fetch and display all the products with the product name which does not starts with 'a'
// 13. Remove the expired date product from the database and display
// 14. Add filter options -->

<html>
<head>

</head>

<body>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

<!-- Create database -->

Database name:<input type="text" name="dbname"><br><br>
 <input type="submit" name="createDatabase" value="create Database"><br><br>


 <!-- Create table -->

 Table name:<input type="text" name="tablename"><br><br>
 <input type="submit" name="createTable" value="create Table"><br><br><br>



<!-- Add  product -->

Product code: <input type="text"  name="code">
<br><br>
Name of Product: <input type="text" name="pname">
<br><br>
Price of Product: <input type="number" name="price">
<br><br>
Year of Purchase: <input type="date" name="year">
<br><br>
Expiry Date: <input type="date" name="expDate">
<br><br>
Department: <input type="text" name="dept">
<br><br>

<!-- Insert record -->
<input type="submit" name="insertRecord" value="Insert Record" ><br><br>


<!-- Show all values -->

See Records in Table: <input type='submit' name='showValue' value="Show Records"><br><br>

<!--Display by Product Id -->
Enter Product Id: <input type="number" name="pid"><br><br>
Fetch Record By Id: <input type="submit" name="fetchId" value="Fetch Product"><br><br>


<!-- Sort the data by product Id -->
<input type="submit" name="SortProduct" value="Sort Products"><br><br>

<!-- // 6. Retrive and display the records of the particular product from database in a table form by inputting either product code or name of the product -->

<input type="text" name="searchCodeP"><br><br>
<input type="submit" name="scp" value="Search By Code or Name">


<!-- // 7. sort the records based on product name -->
<br><br>
<input type="submit" name="sortName" value="Sort Product by Name">

<br><br>
<input type="submit" name="countDept" value="Count Product in each dept">

<br><br>
<input type="submit" name="firstTwo" value="Fetch first 2 Details">

<br><br>
<input type="submit" name="startA" value="Fetch Product starts with a">

<br><br>
<input type="submit" name="endR" value="Fetch Product end with r">

<br><br>
<input type="submit" name="endR" value="Fetch Product end with r">

<br><br>
<input type="submit" name="dEndA" value="Fetch Product which does not start with A">

<br><br>
<input type="submit" name="rm" value="Remove Expired Products">

</form>

<?php


// create database
if(isset($_POST["createDatabase"]))
{
  $dbname=$_POST["dbname"];

$server = "localhost:3306";
$username = "root";
$password = "";

 $conn = mysqli_connect($server, $username, $password);
   
   if(! $conn ) {
      die('Could not connect');
   }
   
   echo 'Connected successfully';
   
   $sql = 'CREATE Database '.$dbname;
   $retval = mysqli_query($conn,$sql);
   
   if(! $retval ) {
      die('Could not create database: ');
   }
   
   echo "\nDatabase  created successfully\n";
 
}

// create Table

if(isset($_POST["createTable"]))
{
   $tableName=$_POST["tablename"];
   


   $server="localhost:3306";
   $username="root";
   $password="";

   $conn=mysqli_connect($server,$username,$password,"productdb");

   if(!$conn)
   {
      die("Could not connect");
   }

   echo "\nConnected successfully\n";

   $sql="CREATE TABLE ".$tableName."
   (
   ProductId INT AUTO_INCREMENT PRIMARY KEY,
   ProductCode  VARCHAR(100),
   ProductName VARCHAR(100),
   ProductPrice INT,
   YearOfPurchase INT,
   ExpiryDate  DATE,
   Department VARCHAR(100)
   )";

   $createDatabase=mysqli_query($conn,$sql);

   if(!$createDatabase)
   {
      die("\nCould not create the database\n");
   }
   else{
      echo "\nTable ".$tableName."created successfully\n";
   }
}

// Insert record

if(isset($_POST["insertRecord"]))
{


   $Pcode=$_POST["code"];
   $Pname=$_POST["pname"];
   $Price=$_POST["price"];
   $year=$_POST["year"];
   $expDate=$_POST["expDate"];
   $dept=$_POST["dept"];
   
   $server="localhost:3306";
   $username="root";
   $password="";

   $conn=mysqli_connect($server,$username,$password,"productdb");

   if(!$conn)
   {
      die("\nCould not connect\n");
   }
   else{
      echo "\nConnected successfully\n";
   }

  $cmd="INSERT INTO producttable (ProductCode,ProductName,ProductPrice,YearOfPurchase,ExpiryDate,Department)
    VALUES ('$Pcode','$Pname','$Price','$year','$expDate','$dept') ";



   $inst=mysqli_query($conn,$cmd);

   if(!$inst)
   {
      die("\nCould not enter record into table\n");
   }
   else{
      echo "\nSuccessfully inserted record into table\n";
   }

}


// Display records


if(isset($_POST['showValue']))
{

  $server="localhost:3306";
  $username="root";
  $password="";

  $conn=mysqli_connect($server,$username,$password,"productdb");

  if(!$conn)
  {
     
    die("Could not connect to database");

  }
   else{
      echo "<br> Connected to database successfully <br>";
   }

 $cmd="SELECT ProductCode,ProductName,ProductPrice,YearOfPurchase,ExpiryDate,Department from producttable";


 $inst=mysqli_query($conn,$cmd);

 if($result = mysqli_query($conn, $cmd)){
   if(mysqli_num_rows($result) > 0){
       echo "<table>";
           echo "<tr>";
               echo "<th>Product Code</th>";
               echo "<th>Product Name</th>";
               echo "<th>Product Price</th>";
               echo "<th>Year of Purchase</th>";
               echo "<th>Expiry Date</th>";
               echo "<th>Department</th>";
           echo "</tr>";
       while($row = mysqli_fetch_array($result)){
           echo "<tr>";
               echo "<td>" . $row['ProductCode'] . "</td>";
               echo "<td>" . $row['ProductName'] . "</td>";
               echo "<td>" . $row['ProductPrice'] . "</td>";
               echo "<td>" . $row['YearOfPurchase'] . "</td>";
               echo "<td>" . $row['ExpiryDate'] . "</td>";
               echo "<td>" . $row['Department'] . "</td>";
           echo "</tr>";
       }
       echo "</table>";
       // Close result set
       mysqli_free_result($result);
   } else{
       echo "No records matching your query were found.";
   }
}

    
}

// Fetch product by Id

if(isset($_POST['fetchId']))
{
    $server="localhost:3306";
    $username="root";
    $password="";

    $conn=mysqli_connect($server,$username,$password,"productdb");

    $pid=$_POST['pid'];

    if(!$conn)
    {
      die("Could not connect");
    }
    else{
      echo "Connection successful <br>";
    }

    $cmd="SELECT * from producttable where productCode='$pid'";

   $inst=mysqli_query($conn,$cmd);

   if($result = mysqli_query($conn, $cmd)){
      if(mysqli_num_rows($result) > 0){
          echo "<table>";
              echo "<tr>";
                  echo "<th>Product Code</th>";
                  echo "<th>Product Name</th>";
                  echo "<th>Product Price</th>";
                  echo "<th>Year of Purchase</th>";
                  echo "<th>Expiry Date</th>";
                  echo "<th>Department</th>";
              echo "</tr>";
          while($row = mysqli_fetch_array($result)){
              echo "<tr>";
                  echo "<td>" . $row['ProductCode'] . "</td>";
                  echo "<td>" . $row['ProductName'] . "</td>";
                  echo "<td>" . $row['ProductPrice'] . "</td>";
                  echo "<td>" . $row['YearOfPurchase'] . "</td>";
                  echo "<td>" . $row['ExpiryDate'] . "</td>";
                  echo "<td>" . $row['Department'] . "</td>";
              echo "</tr>";
          }
          echo "</table>";
          // Close result set
          mysqli_free_result($result);
      } else{
          echo "No records matching your query were found.";
      }
  }
}

  // sort product by Id

  if(isset($_POST["SortProduct"]))
  {
      $server="localhost:3306";
      $username="root";
      $password="";

      $conn=mysqli_connect($server,$username,$password,"productdb");

      if(!$conn)
      {
         die("Could not connect to database");
      }
      else{
         echo "Connected successfully";
      }

      $query="SELECT * FROM  producttable ORDER BY ProductCode";

      if($result = mysqli_query($conn, $query)){
         if(mysqli_num_rows($result) > 0){
             echo "<table>";
                 echo "<tr>";
                     echo "<th>Product Code</th>";
                     echo "<th>Product Name</th>";
                     echo "<th>Product Price</th>";
                     echo "<th>Year of Purchase</th>";
                     echo "<th>Expiry Date</th>";
                     echo "<th>Department</th>";
                 echo "</tr>";
             while($row = mysqli_fetch_array($result)){
                 echo "<tr>";
                     echo "<td>" . $row['ProductCode'] . "</td>";
                     echo "<td>" . $row['ProductName'] . "</td>";
                     echo "<td>" . $row['ProductPrice'] . "</td>";
                     echo "<td>" . $row['YearOfPurchase'] . "</td>";
                     echo "<td>" . $row['ExpiryDate'] . "</td>";
                     echo "<td>" . $row['Department'] . "</td>";
                 echo "</tr>";
             }
             echo "</table>";
             // Close result set
             mysqli_free_result($result);
         } else{
             echo "No records matching your query were found.";
         }
     }
    }


     // search a product by id or name

     if(isset($_POST["scp"]))
     {
        $val=$_POST["searchCodeP"];

        $server="localhost:3306";
        $username="root";
        $password="";

        $conn=mysqli_connect($server,$username,$password,"productdb");

        if(!$conn)
        {
            die("Could not connect to server");
        }
        else{
            echo "<br> Connection to db successful <br>";
        }

        $cmd="SELECT * from producttable where ProductCode='$val' or ProductName='$val'";


        if($result = mysqli_query($conn, $cmd)){
            if(mysqli_num_rows($result) > 0){
                echo "<table>";
                    echo "<tr>";
                        echo "<th>Product Code</th>";
                        echo "<th>Product Name</th>";
                        echo "<th>Product Price</th>";
                        echo "<th>Year of Purchase</th>";
                        echo "<th>Expiry Date</th>";
                        echo "<th>Department</th>";
                    echo "</tr>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                        echo "<td>" . $row['ProductCode'] . "</td>";
                        echo "<td>" . $row['ProductName'] . "</td>";
                        echo "<td>" . $row['ProductPrice'] . "</td>";
                        echo "<td>" . $row['YearOfPurchase'] . "</td>";
                        echo "<td>" . $row['ExpiryDate'] . "</td>";
                        echo "<td>" . $row['Department'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Close result set
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }


     }
    }
  
    // 7. sort the records based on product name

    if(isset($_POST["sortName"]))
    {
        $server="localhost:3306";
        $username="root";
        $password="";

        $conn=mysqli_connect($server,$username,$password,"productdb");

        if(!$conn)
        {
            die("Could not connect to server");
        }
        else{
            echo "<br> Connection to db successful <br>";
        }
      
        $cmd="SELECT * FROM producttable order by ProductName";

       
        if($result = mysqli_query($conn, $cmd)){
            if(mysqli_num_rows($result) > 0){
                echo "<table>";
                    echo "<tr>";
                        echo "<th>Product Code</th>";
                        echo "<th>Product Name</th>";
                        echo "<th>Product Price</th>";
                        echo "<th>Year of Purchase</th>";
                        echo "<th>Expiry Date</th>";
                        echo "<th>Department</th>";
                    echo "</tr>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                        echo "<td>" . $row['ProductCode'] . "</td>";
                        echo "<td>" . $row['ProductName'] . "</td>";
                        echo "<td>" . $row['ProductPrice'] . "</td>";
                        echo "<td>" . $row['YearOfPurchase'] . "</td>";
                        echo "<td>" . $row['ExpiryDate'] . "</td>";
                        echo "<td>" . $row['Department'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Close result set
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }

        }
    }

    // 8. count number of products in each department (give same department name for 2 products while insert)
    // check


    if(isset($_POST["countDept"]))
    {
        $server="localhost:3306";
        $username="root";
        $password="";

        $conn=mysqli_connect($server,$username,$password,"productdb");

        if(!$conn)
        {
            die("Could not connect to server");
        }
        else{
            echo "<br> Connection to db successful <br>";
        }

        $cmd = "SELECT Department,COUNT(ProductId) as NumberOfProducts from producttable GROUP BY Department";

        $result=mysqli_query($conn,$cmd);


        while($row = mysqli_fetch_array($result))
        {
             echo "<br>".$row['Department']." ---".$row['NumberOfProducts']."<br>";
        }
    }

    // 9. Fetch and display the first 2 products

    if(isset($_POST["firstTwo"]))
    {
        $server="localhost:3306";
        $username="root";
        $password="";

        $conn=mysqli_connect($server,$username,$password,"productdb");


        if(!$conn)
        {
            die("Could not connect to server");
        }
        else{
            echo "<br> Connection to db successful <br>";
        }

        $cmd="SELECT * FROM producttable LIMIT 2";

        
        if($result = mysqli_query($conn, $cmd)){
            if(mysqli_num_rows($result) > 0){
                echo "<table>";
                    echo "<tr>";
                        echo "<th>Product Code</th>";
                        echo "<th>Product Name</th>";
                        echo "<th>Product Price</th>";
                        echo "<th>Year of Purchase</th>";
                        echo "<th>Expiry Date</th>";
                        echo "<th>Department</th>";
                    echo "</tr>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                        echo "<td>" . $row['ProductCode'] . "</td>";
                        echo "<td>" . $row['ProductName'] . "</td>";
                        echo "<td>" . $row['ProductPrice'] . "</td>";
                        echo "<td>" . $row['YearOfPurchase'] . "</td>";
                        echo "<td>" . $row['ExpiryDate'] . "</td>";
                        echo "<td>" . $row['Department'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Close result set
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }

    }

    }

    // 10. fetch and display all the products with the products name starts with 'a'

    if(isset($_POST["startA"]))
    {
        $server="localhost:3306";
        $username="root";
        $password="";

        $conn=mysqli_connect($server,$username,$password,"productdb");


        if(!$conn)
        {
            die("Could not connect to server");
        }
        else{
            echo "<br> Connection to db successful <br>";
        }

        $cmd="SELECT * from producttable where ProductName LIKE 'A%'";

          
        if($result = mysqli_query($conn, $cmd)){
            if(mysqli_num_rows($result) > 0){
                echo "<table>";
                    echo "<tr>";
                        echo "<th>Product Code</th>";
                        echo "<th>Product Name</th>";
                        echo "<th>Product Price</th>";
                        echo "<th>Year of Purchase</th>";
                        echo "<th>Expiry Date</th>";
                        echo "<th>Department</th>";
                    echo "</tr>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                        echo "<td>" . $row['ProductCode'] . "</td>";
                        echo "<td>" . $row['ProductName'] . "</td>";
                        echo "<td>" . $row['ProductPrice'] . "</td>";
                        echo "<td>" . $row['YearOfPurchase'] . "</td>";
                        echo "<td>" . $row['ExpiryDate'] . "</td>";
                        echo "<td>" . $row['Department'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Close result set
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }

    }
    }

// // 11. fetch and display all the products with the products ends with 'r'

if(isset($_POST["endR"]))
    {
        $server="localhost:3306";
        $username="root";
        $password="";

        $conn=mysqli_connect($server,$username,$password,"productdb");


        if(!$conn)
        {
            die("Could not connect to server");
        }
        else{
            echo "<br> Connection to db successful <br>";
        }

        $cmd="SELECT * from producttable where ProductName LIKE '%r'";

          
        if($result = mysqli_query($conn, $cmd)){
            if(mysqli_num_rows($result) > 0){
                echo "<table>";
                    echo "<tr>";
                        echo "<th>Product Code</th>";
                        echo "<th>Product Name</th>";
                        echo "<th>Product Price</th>";
                        echo "<th>Year of Purchase</th>";
                        echo "<th>Expiry Date</th>";
                        echo "<th>Department</th>";
                    echo "</tr>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                        echo "<td>" . $row['ProductCode'] . "</td>";
                        echo "<td>" . $row['ProductName'] . "</td>";
                        echo "<td>" . $row['ProductPrice'] . "</td>";
                        echo "<td>" . $row['YearOfPurchase'] . "</td>";
                        echo "<td>" . $row['ExpiryDate'] . "</td>";
                        echo "<td>" . $row['Department'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Close result set
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }

    }
    }

    // 12. fetch and display all the products with the product name which does not starts with 'a'
    if(isset($_POST["dEndA"]))
    {
        $server="localhost:3306";
        $username="root";
        $password="";

        $conn=mysqli_connect($server,$username,$password,"productdb");


        if(!$conn)
        {
            die("Could not connect to server");
        }
        else{
            echo "<br> Connection to db successful <br>";
        }

        $cmd="SELECT * from producttable where ProductName NOT LIKE 'A%'";

          
        if($result = mysqli_query($conn, $cmd)){
            if(mysqli_num_rows($result) > 0){
                echo "<table>";
                    echo "<tr>";
                        echo "<th>Product Code</th>";
                        echo "<th>Product Name</th>";
                        echo "<th>Product Price</th>";
                        echo "<th>Year of Purchase</th>";
                        echo "<th>Expiry Date</th>";
                        echo "<th>Department</th>";
                    echo "</tr>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                        echo "<td>" . $row['ProductCode'] . "</td>";
                        echo "<td>" . $row['ProductName'] . "</td>";
                        echo "<td>" . $row['ProductPrice'] . "</td>";
                        echo "<td>" . $row['YearOfPurchase'] . "</td>";
                        echo "<td>" . $row['ExpiryDate'] . "</td>";
                        echo "<td>" . $row['Department'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                // Close result set
                mysqli_free_result($result);
            } else{
                echo "No records matching your query were found.";
            }

    }
    }

    
// // 13. Remove the expired date product from the database and display
   if(isset($_POST["dEndA"]))
    {
        $server="localhost:3306";
        $username="root";
        $password="";

        $date = date_parse(date('d-m-y h:i:s'));

        $conn=mysqli_connect($server,$username,$password,"productdb");


        if(!$conn)
        {
            die("Could not connect to server");
        }
        else{
            echo "<br> Connection to db successful <br>";
        }

        $cmd="DELETE FROM producttable where ExpiryDate<'$date'";

        $res=mysqli_query($conn,$cmd);

        if($res)
        {
            echo "<br>Expired products deleted successfully<br>";
        }
        else{
            echo "<br>Error deleting record<br>";
        }

     echo "<br>After deleing records<br>";

     $cmd="SELECT * from producttable";

          
     if($result = mysqli_query($conn, $cmd)){
         if(mysqli_num_rows($result) > 0){
             echo "<table>";
                 echo "<tr>";
                     echo "<th>Product Code</th>";
                     echo "<th>Product Name</th>";
                     echo "<th>Product Price</th>";
                     echo "<th>Year of Purchase</th>";
                     echo "<th>Expiry Date</th>";
                     echo "<th>Department</th>";
                 echo "</tr>";
             while($row = mysqli_fetch_array($result)){
                 echo "<tr>";
                     echo "<td>" . $row['ProductCode'] . "</td>";
                     echo "<td>" . $row['ProductName'] . "</td>";
                     echo "<td>" . $row['ProductPrice'] . "</td>";
                     echo "<td>" . $row['YearOfPurchase'] . "</td>";
                     echo "<td>" . $row['ExpiryDate'] . "</td>";
                     echo "<td>" . $row['Department'] . "</td>";
                 echo "</tr>";
             }
             echo "</table>";
             // Close result set
             mysqli_free_result($result);
         } else{
             echo "No records matching your query were found.";
         }


        
    }
}





?>


</body>


</html>