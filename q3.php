<?php 
include 'db.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = $_POST['name'];
    $job_title = $_POST['job_title'];
    $salary = $_POST['salary'];

    $sql = $conn->prepare(
        "INSERT INTO employee (name, job_title, salary) VALUES (?, ?, ?)"
    );

    $sql->bind_param("ssd", $name, $job_title, $salary);

    if($sql->execute()){
        echo "Data Inserted....";
    }
    
}

$result = $conn->query("SELECT * FROM employee");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Insert Employee</h2>

<form method="POST">

    Name:
    <input type="text" name="name" required>
    <br><br>

    Job Title:
    <input type="text" name="job_title" required>
    <br><br>

    Salary:
    <input type="number" name="salary" step="0.01" required>
    <br><br>

    <button type="submit" name="insert">
        Insert Employee
    </button>

</form>


<?php if($result->num_rows>0){?>
<table border="1" cellpadding=10 >
        <thead>
            <td>Id</td>
            <td>Name</td>
            <td>Age</td>
            <td>Salary</td>
        </thead>
        <?php while($row=$result->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['job_title']; ?></td>
            <td><?php echo $row['salary']; ?></td>
            
        </tr>
        <?php } ?>
    </table>
<?php } else{
    echo "No employees found.";
}
?>
</body>
</html>

