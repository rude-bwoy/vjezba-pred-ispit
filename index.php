<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'database.php';

$db = new Database('remotemysql.com', 'rKJoSBuvYr', 'BRaG9Lx50I', 'rKJoSBuvYr');
$message = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(empty($_POST['imePrezime'])) {

        $message = 'Molimo popunite sva polja';

    } else {

        $db->insert_imena($_POST);

    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikacija</title>
    <style>
        table {
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 9px;
        }
    </style>
</head>
<body>
        
    <h1>Ispit - Ivan Vidović</h1>
    <br><br>



    <?php if(!empty($message)) {echo $message; } ?>
        <form action="" method="post">
            <input type="text" name="imePrezime" value="Unesite svoje ime i prezime"><br>
            <input type="submit" value="Spremi">
        </form>

    <br>
    <br><br>

    <h1>Popis osoba</h1>

    <?php
        $imena = $db->get_imena();
    ?>

        <table>
            <tr>
                <th>#</th>
                <th>Ime i prezime</th>
                <th>Akcije</th>
            </tr>
            <?php if(!empty($imena)): ?>
                <?php foreach($imena as $ime): ?>    
                <tr>
                    <td><?php echo $ime['id']; ?></td>
                    <td><?php echo $ime['imePrezime']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $ime['id']; ?>">Ažuriraj</a>
                        <a href="delete.php?id=<?php echo $ime['id']; ?>">Izbriši</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>


</body>
</html>
