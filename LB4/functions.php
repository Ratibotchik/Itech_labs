<?php

function delFile()
{
    $file = (empty($_REQUEST['file'])) ? '' : $_REQUEST['file'];
    unlink($file);
}

function resultOut()
{
    $file = (empty($_REQUEST['file'])) ? '' : $_REQUEST['file'];
    ob_start();
    ?>
    <div>
        <?php
        $result = file($file);
        foreach($result as $row) {
            echo $row;
        }
        ?>
    </div>
    <br>
    <a href="?task=files">Повернутися на головну</a> |
    <a href="?task=del&file=<?php echo $file; ?>">Видалити файл</a> |
    <a href="?task=change&file=<?php echo $file; ?>">Редагувати файл</a>
    <?php
    $content = ob_get_contents();
    ob_end_clean();
    echo $content;
}

function saveFile()
{
    $content = (empty($_REQUEST['content'])) ? '' : $_REQUEST['content'];
    $file = (empty($_REQUEST['file'])) ? '' : $_REQUEST['file'];
    file_put_contents($file . '.txt', $content);
}

function changeFile()
{
    $content = (empty($_REQUEST['content'])) ? '' : $_REQUEST['content'];
    $file = (empty($_REQUEST['file'])) ? '' : $_REQUEST['file'];
    file_put_contents($file, $content);
}

function outputFiles()
{
    ob_start();
    ?>
    <h3>Всі файли:</h3>
    <?php
    $files = glob("*.txt");

    if (count($files) > 0) {
        echo '<ul>';
        foreach ($files as $file) {
            echo '<li><b>' . $file . '(<small></small><a href="?task=del&file=' . $file . '">видалити</a></small>)
            (<small></small><a href="?task=result&file=' . $file . '">переглянути</a></small>)
            (<small></small><a href="?task=change&file=' . $file . '">редагувати</a></small>)
            </li>';
        }
        echo '</ul>';
    } else {
        echo '<p>Файлів немає.</p>';
    }
    ?>
    <a href="?task=">Створити новий файл</a>
    <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}

function getForm()
{
    ob_start();
    ?>
    <h3>Створення файлу</h3>
    <form action="?task=save" method="post">
        <textarea name="content" cols="60" rows="10" placeholder="Sample html tags and text"> </textarea>
        <br><br>
        <input name="file" type="text" value="" placeholder="site">.txt
        <br><br>
        <input name="files" type="submit" value="Повернутися на головну">
        <input name="save" type="submit" value="Зберегти файл">
    </form>
    <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}

function changeForm()
{
    $file = (empty($_REQUEST['file'])) ? '' : $_REQUEST['file'];
    ob_start();
    ?>
    <h3>Редагування файлу</h3>
    <form action="?task=csave" method="post">
        <textarea name="content" cols="60" rows="10"><?php echo file_get_contents($file)?></textarea>
        <input name="file" type="text" value="<?php echo $file?>">
        <br><br>
        <input name="files" type="submit" value="Повернутися на головну">
        <input name="save" type="submit" value="Зберегти файл">
    </form>
    <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
?>