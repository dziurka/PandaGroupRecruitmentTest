<?php
require_once 'layouts/header.php';
?>

<div style="margin-top: 20px">

    <h3>Create note</h3>
    <div>
        <form action="/notes/store" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       placeholder="Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Description</label>
                <input name="description" type="text" class="form-control" id="exampleInputPassword1" placeholder="Description">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</div>

<?php
require_once 'layouts/footer.php';
?>
