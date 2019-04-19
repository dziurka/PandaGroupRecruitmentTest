<?php
/** @var array $data */
?>
<html lang="pl">
<head>
    <title>Simple Note App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">NotesApp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php if (false === $data['isLogin']) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Sign up</a>
                </li>
            <?php } ?>
            <?php if (true === $data['isLogin']) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/notes">Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/notes/create">Create</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/upload">Upload</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/chart">Statistics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
            <?php } ?>

        </ul>
        <span class="navbar-text">
             <?php echo ($data['isLogin']) ? 'Hi ' . $data['user']->first_name : '' ?>
        </span>
    </div>
</nav>


<div class="container">

    <?php if (\NotesApp\App\Helpers\Validation::isSessionMessage()) { ?>
        <div class="alert alert-primary mt-5" role="alert">
            <?php echo \NotesApp\App\Helpers\Validation::getSessionMessage(); ?>
        </div>
    <?php } ?>
