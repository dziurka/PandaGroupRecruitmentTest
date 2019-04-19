<?php
require_once 'layouts/header.php';
?>


<div style="margin-top: 20px">

    <h3>Sign In</h3>
    <div>
        <form action="/create-account" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">First name</label>
                <input name="first_name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       placeholder="First name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Last name</label>
                <input name="last_name" type="text" class="form-control" id="exampleInputPassword1" placeholder="Last name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Gender</label>
                <div class="form-check">
                    <input name="gender" type="radio" class="form-check-input" id="exampleCheck1" value="male">
                    <label class="form-check-label" for="exampleCheck1">Male</label>
                </div>
                <div class="form-group form-check">
                    <input name="gender" type="radio" class="form-check-input" id="exampleCheck1" value="female">
                    <label class="form-check-label" for="exampleCheck1">Female</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</div>

<?php
require_once 'layouts/footer.php';
?>
