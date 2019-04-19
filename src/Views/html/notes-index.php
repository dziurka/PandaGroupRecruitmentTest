<?php
require_once 'layouts/header.php';
?>


<div style="margin-top: 20px">

    <h3>Your notes</h3>

    <div class="row">

    <?php
    foreach ($data['notes'] as $note) {
        ?>

            <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $note->name ?></h5>
                        <p class="card-text">
                            <?php
                            if (strlen($note->description ) > 30)
                                $note->description = substr($note->description, 0, 27) . '...';
                                echo $note->description
                            ?>
                        </p>
                        <a href="<?php echo '/notes/'.$note->id ?>" class="btn btn-primary">Show</a>
                        <a href="<?php echo '/notes/edit/'.$note->id ?>" class="btn btn-success">Edit</a>
                        <a href="<?php echo '/notes/delete/'.$note->id ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>

        <?php
    }
    echo (empty($data['notes'])) ? "<div class='col-12'><h6>You haven't added any notes</h6></div>" : '';
    ?>
    </div>


</div>

<?php
require_once 'layouts/footer.php';
?>
