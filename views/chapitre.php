<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/5022ecc52d.js" crossorigin="anonymous"></script>

    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"
        defer></script>


    <link rel="stylesheet" href="assets/css/style.css">
    <link href="assets/css/styleChapitre.css" rel="stylesheet">


    <title>Chapitre</title>

</head>
<body class="content justify-content-center align-items-center d-flex flex-column">
   <h1> Chapitre <?php echo $hero->getChapter(); ?> </h1>
    
    <div class="">    
        <a href="connexion" class="home-btn"><i class="fas fa-home"></i></a>

        <div class="hero-section justify-content-center align-items-center d-flex">
            <p>
                <?php
                    // On affiche le hero
                    $this->printHero($hero); 
                ?>
            </p>
        </div>

        <div class="chapter-content justify-content-center align-items-center d-flex"> 
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

    <script>
        var heroInfoModal = document.getElementById("heroInfoModal");
        var inventoryModal = document.getElementById("inventoryModal");
        var spellsModal = document.getElementById("spellsModal");
        var heroInfoBtn = document.getElementById("heroInfoButton");
        var inventoryBtn = document.getElementById("inventoryButton");
        var spellsBtn = document.getElementById("spellsButton");
        var closeBtns = document.getElementsByClassName("close");

        heroInfoBtn.onclick = function() {
            heroInfoModal.style.display = "block";
        }

        inventoryBtn.onclick = function() {
            inventoryModal.style.display = "block";
        }

        spellsBtn.onclick = function() {
            spellsModal.style.display = "block";
        }

        for (var i = 0; i < closeBtns.length; i++) {
            closeBtns[i].onclick = function() {
                this.parentElement.parentElement.style.display = "none";
            }
        }

        window.onclick = function(event) {
            if (event.target == heroInfoModal) {
                heroInfoModal.style.display = "none";
            }
            if (event.target == inventoryModal) {
                inventoryModal.style.display = "none";
            }
            if (event.target == spellsModal) {
                spellsModal.style.display = "none";
            }
        }
    </script>
</body>
</html>
