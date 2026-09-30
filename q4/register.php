<?php 

include 'db.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];
    $job_title = trim($_POST['job_title']);

    if (
        empty($name) ||
        empty($email) ||
        empty($password) ||
        empty($confirm_password) ||
        empty($job_title)
    ) {
        header("Location: error.php?message=All fields are required");
        exit();
    }

    if ($password !== $confirm_password) {
        header("Location: error.php?message=Passwords do not match");
        exit();
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: error.php?message=Invalid email format");
        exit();
    }


    $check = $conn->prepare("select * from employees where email=?");
    $check->bind_param('s',$email);
    $check->execute();
    $result = $check->get_result();
    if($result->num_rows>0){
        header("Location:error.php?message=Email already exists");
        exit();
    }
    $hashed_password =  password_hash($password,PASSWORD_BCRYPT);
    $sql=$conn->prepare('insert into employees (name, email, password, job_title)
        VALUES (?, ?, ?, ?)');
    $sql->bind_param("ssss",
        $name,
        $email,
        $hashed_password,
        $job_title
    );
    if ($sql->execute()) {
        header("Location: success.php");
        exit();
    } else {
        header(
            "Location: error.php?message=Registration failed"
        );
        exit();

    }
}

?>


<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Title</title>
        <!--  meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>

        <div
            class="container mt-5"
        >
           <div class="row justify-content-center">
                <div class="col-md-6">
                   <div class="card shadow">
                    
                    <div class="card-body">
                       <h2 class="text-center mb-4">
                        Employee Registration
                    </h2>
                        <form action="" method="post">
                            <div class="form-floating mb-3">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="formId1"
                                    placeholder=""
                                    
                                />
                                <label for="formId1">Name</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    id="formId1"
                                    placeholder=""
                                    
                                />
                                <label for="formId1">Email</label>
                            </div>
                            
                            
                            
                            <div class="form-floating mb-3">
                                <input
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    id="formId1"
                                    placeholder=""
                                    
                                />
                                <label for="formId1">Password</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input
                                    type="password"
                                    class="form-control"
                                    name="confirmPassword"
                                    id="formId1"
                                    placeholder=""
                                    
                                />
                                <label for="formId1">Confirm Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input
                                    type="text  "
                                    class="form-control"
                                    name="job_title"
                                    id="formId1"
                                    placeholder=""
                                    
                                />
                                <label for="formId1">Job Title </label>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100"
                            >
                                Register
                            </button>
                            
                            
                        </form>
                    </div>
                   </div>
                   
                </div>
           </div>
        </div>
        

        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
