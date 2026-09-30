<?php

$message = $_GET['message'] ?? 'Something went wrong';

?>

<!DOCTYPE html>
<html>

<head>

    <title>Registration Error</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<div class="container mt-5">

    <div class="alert alert-danger">

        <h4>Registration Failed</h4>

        <p>
            <?php echo htmlspecialchars($message); ?>
        </p>

        <a href="register.php"
           class="btn btn-danger">
            Go Back
        </a>

    </div>

</div>

</body>

</html>