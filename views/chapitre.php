<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
<h1> Chapitre <?php echo $hero->getChapter(); ?> </h1>
    
    <div>
        <p>
            <?php
                //On affiche le hero
                $this->printHero($hero); 
            ?>
        </p>
    </div>

    <div> 
        <p>
            <?php echo $chapterInfos[0]["chapter_content"] ?>
        </p> 
    </div>

    <ul>
        <?php
            $this->printLinks($links); 
        ?>
    </ul>

</body>
</html>