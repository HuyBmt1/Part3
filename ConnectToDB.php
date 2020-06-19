<!DOCTYPE html>
<html>
<body>

<h1>DATABASE CONNECTION</h1>

<?php
ini_set('display_errors', 1);
echo "Hello Cloud computing class 0818!";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     echo '<p>The DB exists</p>';
     echo getenv("dbname");
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-34-200-72-77.compute-1.amazonaws.com;port=5432;user=wcqnaqvuudtbmx;password=044dfa0f5b8c47cb6e4d3321184d8881696b4dbad58a7dff9e4fc1a8a1d5bf6a;dbname=d871jro07l5coa",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

$sql = "select * from customer";
$stmt = $pdo->prepare($sql);
//Thiết lập kiểu dữ liệu trả về
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();
echo '<p>Customer information:</p>';

?>
<div id="container">
<table class="table table-bordered table-condensed">
    <thead>
      <tr>
        <th>CustomerID</th>
        <th>CustomerName</th>
        <th>CustomerBirthday</th>
        <th>CustomerAddress</th>
        <th>CustomerPhone</th>
        <th>CustomerEmail</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // tạo vòng lặp 
         //while($r = mysql_fetch_array($result)){
             foreach ($resultSet as $row) {
      ?>
   
      <tr>
        <td scope="row"><?php echo $row['CustomerID'] ?></td>
        <td><?php echo $row['CustomerName'] ?></td>
        <td><?php echo $row['CustomerBirthday'] ?></td>
        <td><?php echo $row['CustomerAddress'] ?></td>
        <td><?php echo $row['CustomerPhone'] ?></td>
        <td><?php echo $row['CustomerEmail'] ?></td>
      </tr>
     
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
