<?php
require_once 'layouts/header.php';
?>


<div style="margin-top: 20px">

    <h3>Upload file</h3>
    <div>

        <form action="/parse" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="csv-input">File</label>
                <input name="csv" type="file" id="csv-input">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>

</div>

<?php
require_once 'layouts/footer.php';
?>
