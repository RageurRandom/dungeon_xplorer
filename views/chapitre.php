<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="assets/css/styleChapitre.css" rel="stylesheet">


    <title>Chapitre</title>

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
