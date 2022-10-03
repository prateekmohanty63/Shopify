

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
<input type="submit" name="SortProduct" value="Sort Products">




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

 $cmd="SELECT ProductCode,ProductName,ProductPrice from producttable";


 $inst=mysqli_query($conn,$cmd);

 

 if(!$inst)
 {
   echo "Could not fetch the records: ".mysqli_error($conn);
 }
 else{
   while($row=mysqli_fetch_array($inst,MYSQLI_ASSOC))
   {
      echo "PRODUCT CODE :{$row['ProductCode']}  <br> ".
      "PRODUCT NAME : {$row['ProductName']} <br> ".
      "PRODUCT PRICE : {$row['ProductPrice']} <br> ".
      "YEAR OF PURCHASE : {$row['YearOfPurchase']} <br> ".
      "EXPIRY DATE: {$row['ExpiryDate']} <br> ".
      "DEPARTMENT : {$row['Department']} <br> ".
      "--------------------------------<br>";
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

   if(!$inst)
   {
      die("Could not fetch the Product");
   }
  else{
   while($row=mysqli_fetch_array($inst,MYSQLI_ASSOC))
   {
      echo "PRODUCT CODE :{$row['ProductCode']}  <br> ".
      "PRODUCT NAME : {$row['ProductName']} <br> ".
      "PRODUCT PRICE : {$row['ProductPrice']} <br> ".
      "YEAR OF PURCHASE : {$row['YearOfPurchase']} <br> ".
      "EXPIRY DATE: {$row['ExpiryDate']} <br> ".
      "DEPARTMENT : {$row['Department']} <br> ".
      "--------------------------------<br>";
   }
  }

  // sort product by Id

  if(isset($_POST["SortProduct"]))
  {
      $server="localhost:3306";
      $username="root";
      $password="";

      $conn=mysqli_connect($server,$username,$password);

      if(!$conn)
      {
         die("Could not connect to database");
      }
      else{
         echo "Connected successfully";
      }

      $query="SELECT * FROM "


  }


  
}

?>


</body>


</html>