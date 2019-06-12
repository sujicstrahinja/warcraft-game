<?php
    require_once('autoload.php');

    $warr = new Warrior(100, 100, 10, 10);
    $mage = new Mage(50, 50, 5, 5, 80, 80);
    $rogue = new Rogue(70, 70, 7, 13);
    $creep1 = new Wolf(30, 30, 3, 4);
    $creep2 = new Bristleback(35, 35, 4, 3);
    $creep3 = new IceElemental(40, 40, 3, 3);
    $characters = array($warr, $mage, $rogue, $creep1, $creep2, $creep3);
    foreach ($characters as $character) {
        echo $character;
        echo "</br>";
    }
    echo $warr->drinkHealthPotion(2);
    echo "</br>";
    echo $rogue->attack($creep3);
    echo "</br>";
    echo $mage->fireball($creep2);
    echo "</br>";
    echo $warr->attack($creep1);
    echo "</br>";
    echo $mage->inferno($characters);
    echo "</br>";
    echo $mage->drinkManaPotion(5);
    echo "</br>";
    echo $mage->drinkManaPotion(5);
    echo "</br>";
    echo $warr->attack($creep1);
    echo "</br>";
    echo $warr->attack($creep3);
    echo "</br>";
    echo $warr->attack($creep2);
    echo "</br>";
    echo $warr->attack($creep3);
    echo "</br>";
    echo $warr->attack($creep3);
    echo "</br>";
    echo $warr->attack($creep3);
    echo "</br>";
    echo $warr->attack($creep3);
    echo "</br>";
    echo $warr->attack($creep3);
    echo "</br>";
?>
