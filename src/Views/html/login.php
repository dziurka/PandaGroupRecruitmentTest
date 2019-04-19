<?php
require_once 'layouts/header.php';
?>


<div style="margin-top: 20px">

    <h3>Sign In</h3>
    <div>
        <form action="login" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</div>

<?php
require_once 'layouts/footer.php';
?>
