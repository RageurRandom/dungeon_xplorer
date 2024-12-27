<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combat</title>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/5022ecc52d.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"
        defer></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/styleCombat.css">

</head>
<body class="bg-light justify-content-center align-items-center d-flex flex-column">
    
<?php
    if(isset($_POST["action"])){
        echo "<h1 class='text-center my-4'>".$_POST["action"]." effectué</h1>";
    } else {
        echo "<h1 class='text-center my-4'>Un adversaire approche !</h1>";
    }
    
    $heros = $_SESSION["hero"];
    $monster = $_SESSION["monster"];

    //affichage noms CSS REQUIS
    echo "<div class='container my-4'><div class='row'><div class='col-md-6'><div class='card bg-danger text-white mb-3'><div class='card-header'><h2>" . $monster->getName() . "</h2></div>"
    . "<div class='card-body'><p class='card-text'>" . $monster->getCurrentHP() . "/" . $monster->getMaxHP() . " HP</p>"
    . "<p class='card-text'>" . $monster->getCurrentMana() . "/" . $monster->getMaxMana() . " Mana</p></div></div></div>";

    echo "<div class='col-md-6'><div class='card bg-success text-white mb-3'><div class='card-header'><h2>" . $heros->getName() . "</h2></div>"
    . "<div class='card-body'><p class='card-text'>" . $heros->getCurrentHP() . "/" . $heros->getMaxHP() . " HP</p>"
    . "<p class='card-text'>" . $heros->getCurrentMana() . "/" . $heros->getMaxMana() . " Mana</p>"
    . "<p class='card-text'>" . $heros->getInitiative() . " Initiative</p></div></div></div></div></div>";

    if (isset($combatSummary)) {
        echo "<div class='alert alert-info' role='alert'>$combatSummary</div>";
    }

    if (isset($combatEnded) && $combatEnded) {
        if ($battleWon) {
            echo "<div class='alert alert-success' role='alert'>Vous avez gagné le combat ! <a href='/dx_11/chapitreSuivant/". $_SESSION["combatChap"] . "/". $_SESSION["combatTreasure"]."/0/0/0' class='btn btn-success'>Continuer</a></div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Vous avez perdu le combat. <a href='/dx_11/reinitialisationHero' class='btn btn-danger'>Recommencer</a></div>";
        }
    } else {
?>

<!--ACTIONS-->
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card custom-card">
                <div class="card-header text-center">
                    <h3>Votre tour :</h3>
                </div>
                <div class="card-body">
                    <form action="/dx_11/combat" method="post">
                        <div class="row mb-3">
                            <div class="col">
                                <button type="submit" class="btn btn-danger w-100" name="action" value="attack">Attaque</button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="collapse" data-bs-target="#spells">Sorts</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-success w-100" data-bs-toggle="collapse" data-bs-target="#items">Objets</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-warning w-100" data-bs-toggle="collapse" data-bs-target="#equipments">Équipements</button>
                            </div>
                        </div>
                        <div id="spells" class="collapse">
                            <?php
                            // affichage des sorts
                            $spellArr = $heros->getSpellBook();
                            foreach($spellArr as $spell){
                                $name = $spell->getName();
                                $option = "";
                                if($spell->getCost() > $heros->getCurrentMana()){
                                    $option .= "disabled";
                                }
                                echo "<div class='form-check'><input class='form-check-input' type='radio' id='$name' name='action' value='" . $spell->getType() ."_" . $spell->getID() . "' $option><label class='form-check-label' for='$name'>$name (".$spell->getCost()." Mana)</label></div>";
                            }
                            ?>
                        </div>
                        <div id="items" class="collapse">
                            <?php
                            // affichage des objets
                            $itemArr = $heros->getInventory();
                            foreach($itemArr as $item){
                                if($item->getType() === "potion"){
                                    $name = $item->getName();
                                    echo "<div class='form-check'><input class='form-check-input' type='radio' id='$name' name='action' value='potion_" . $item->getID() . "' ><label class='form-check-label' for='$name'>$name x ". $item->getQuantity() . "</label></div>";
                                }
                            }
                            ?>
                        </div>
                        <div id="equipments" class="collapse">
                            <h3>Équipements</h3>
                            <div class="mb-3">
                                <label for="weapon">Arme : </label>
                                <?php
                                echo "<select name='weapon' id='weapon' class='form-select'>";
                                $equippedWeap = $heros->getWeapon();
                                if(isset($equippedWeap)){
                                    echo "<option value='current'>" . $equippedWeap->getName() . "</option>";
                                } else {
                                    echo "<option value='current'>Aucune</option>";
                                }
                                foreach($itemArr as $item){
                                    if($item->getType() === "arme" && (!isset($equippedWeap) || $item->getId() != $equippedWeap->getId())){
                                        echo "<option value='" . $item->getID() . "'>" . $item->getName() . " : " . $item->getAttackValue() . " dégâts</option>";
                                    }
                                }
                                echo "</select>";
                                ?>
                            </div>
                            <div class="mb-3">
                                <label for="armor">Armure : </label>
                                <?php
                                echo "<select name='armor' id='armor' class='form-select'>";
                                $equippedArm = $heros->getArmor();
                                if(isset($equippedArm)){
                                    echo "<option value='current'>" . $equippedArm->getName() . "</option>";
                                } else {
                                    echo "<option value='current'>Aucune</option>";
                                }
                                foreach($itemArr as $item){
                                    if($item->getType() === "amure" && (!isset($equippedArm) || $item->getId() != $equippedArm->getId())){
                                        echo "<option value='" . $item->getID() . "'>" . $item->getName() . " : " . $item->getDefenseValue() . " defense</option>";
                                    }
                                }
                                echo "</select>";
                                ?>
                            </div>
                            <?php if($heros->getClass() === "guerrier"): ?>
                            <div class="mb-3">
                                <label for="shield">Bouclier : </label>
                                <?php
                                echo "<select name='shield' id='shield' class='form-select'>";
                                $equippedSh = $heros->getShield();
                                if(isset($equippedSh)){
                                    echo "<option value='current'>" . $equippedSh->getName() . "</option>";
                                } else {
                                    echo "<option value='current'>Aucune</option>";
                                }
                                foreach($itemArr as $item){
                                    if($item->getType() === "bouclier" && (!isset($equippedSh) || $item->getId() != $equippedSh->getId())){
                                        echo "<option value='" . $item->getID() . "'>" . $item->getName() . " : " . $item->getDefenseValue() . " defense</option>";
                                    }
                                }
                                echo "</select>";
                                ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <button type="submit" class="btn btn-primary w-100 btn-confirm">Confirmer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    }
?>

</body>
</html>