<?php
include 'includes/header.php';
?>

<div class="container col-4 loginposition">
    <div class="row">
        <div class="col">
            <form method="post" action="../controller/loginController.php">
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
