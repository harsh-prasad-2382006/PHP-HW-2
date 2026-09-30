<?php

include 'db.php';



if (isset($_POST['insert'])) {

    $name = $_POST['name'];
    $job_title = $_POST['job_title'];
    $salary = $_POST['salary'];

    $sql = $conn->prepare(
        "INSERT INTO employee (name, job_title, salary) VALUES (?, ?, ?)"
    );

    $sql->bind_param("ssd", $name, $job_title, $salary);

    if ($sql->execute()) {
        echo "Employee inserted successfully.<br>";
    } else {
        echo "Error inserting employee.<br>";
    }
}



if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $salary = $_POST['salary'];

    $sql = $conn->prepare(
        "UPDATE employee SET salary = ? WHERE id = ?"
    );

    $sql->bind_param("di", $salary, $id);

    if ($sql->execute()) {
        echo "Employee salary updated successfully.<br>";
    } else {
        echo "Error updating employee.<br>";
    }
}



if (isset($_POST['delete'])) {

    $id = $_POST['id'];

    $sql = $conn->prepare(
        "DELETE FROM employee WHERE id = ?"
    );

    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        echo "Employee deleted successfully.<br>";
    } else {
        echo "Error deleting employee.<br>";
    }
}

$result = $conn->query("SELECT * FROM employee");

?>


<!DOCTYPE html>
<html>
<head>
    <title>Employee CRUD</title>
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


<hr>


<h2>Update Employee Salary</h2>

<form method="POST">

    Employee ID:
    <input type="number" name="id" required>
    <br><br>

    New Salary:
    <input type="number" name="salary" step="0.01" required>
    <br><br>

    <button type="submit" name="update">
        Update Salary
    </button>

</form>


<hr>


<h2>Delete Employee</h2>

<form method="POST">

    Employee ID:
    <input type="number" name="id" required>
    <br><br>

    <button type="submit" name="delete">
        Delete Employee
    </button>

</form>


<hr>


<h2>All Employees</h2>

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