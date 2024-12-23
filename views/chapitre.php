<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
<h1> page du chapitre 1 </h1>

<?php

$controller = new ChapitreController();
$chapter_content = $controller->getChapitre(1);
echo "<p>" . $chapter_content . "</p>";

?>

</body>
</html>