<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/styleChapitre.css" rel="stylesheet">
    <title>Accueil</title>
</head>
<body>
    <h1> Chapitre <?php echo $hero->getChapter(); ?> </h1>
    
    <div class="content">
        <div class="hero-section">
            <p>
                <?php
                    // On affiche le hero
                    $this->printHero($hero); 
                ?>
            </p>
        </div>

        <div class="chapter-content"> 
            <p>
                <?php echo $chapterInfos[0]["chapter_content"] ?>
            </p> 
            <ul class="buttons">
                <?php
                    $this->printLinks($links); 
                ?>
            </ul>
        </div>

        
    </div>
</body>
</html>
