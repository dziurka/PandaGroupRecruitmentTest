<?php
require_once 'layouts/header.php';
?>


<div style="margin-top: 20px">

    <h3>Your notes</h3>

    <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php
                            echo $data['note']->name;
                            ?>
                        </h5>
                        <p class="card-text">
                            <?php
                            echo $data['note']->description;
                            ?>
                        </p>
                        <a href="<?php echo '/notes/'.$data['note']->id ?>" class="btn btn-primary">Show</a>
                        <a href="<?php echo '/notes/edit/'.$data['note']->id ?>" class="btn btn-success">Edit</a>
                        <a href="<?php echo '/notes/delete/'.$data['note']->id ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
    </div>


</div>

<?php
require_once 'layouts/footer.php';
?>
