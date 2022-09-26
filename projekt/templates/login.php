<?php
include 'includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $statement = $pdo->prepare("SELECT * FROM user WHERE username = :username");

    $statement->bindParam(':username', $username, PDO::PARAM_STR);

    $result = $statement->execute(array('username' => $username));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['userid'] = $user['id'];
        header("Location: backend.php");
        die();
    } else {
        echo 'Password oder Username falsch';
    }
}
?>

<div class="container col-4 loginposition">
    <div class="row">
        <div class="col">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" aria-describedby="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <button type="submit" class="btn button-color">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
