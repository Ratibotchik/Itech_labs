<?php

$task = (empty($_REQUEST['task'])) ? '' : $_REQUEST['task'];

include 'functions.php';

switch ($task) {
    case 'del': 
        delFile();
        $str = outputFiles();
        break;
    case 'files':
        $str = outputFiles();
        break;
    case 'result':
        $str = resultOut();
        break;
    case 'change': 
        $str = changeForm();
        break;
    case 'save': 
        saveFile();
        $str = outputFiles();
        break;
    case 'csave': 
        changeFile();
        $str = outputFiles();
        break;
    default:
        $str = getForm();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LB4</title>
</head>
<body>
    <?= $str;?>
</body>
</html>