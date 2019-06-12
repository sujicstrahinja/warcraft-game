<?php
    require_once('autoload.php');
    session_start();
    require_once('vendor/fzaninotto/faker/src/autoload.php');

    $faker = Faker\Factory::create();
    $characters = array();
    $creeps = array();
    $heroes = array();
    $x = rand(1,4);
    $level = 0;
    for ($i=0; $i < $x; $i++) {
        switch (rand(1,3)) {
            case '1':
                $warr = "hero$i";
                $health = rand(90,110);
                $$warr = new Warrior($health, $health, rand(9,11), rand(9,11), $faker->firstName);
                array_push($heroes, $$warr);
                break;
            case '2':
                $mage = "hero$i";
                $health = rand(45,55);
                $mana = rand(60,80);
                $$mage = new Mage($health, $health, rand(4,6), rand(5,6), $mana, $mana, $faker->firstName);
                array_push($heroes, $$mage);
                break;
            case '3':
                $rogue = "hero$i";
                $health = rand(60,70);
                $$rogue = new Rogue($health, $health, rand(6,8), rand(12,14), $faker->firstName);
                array_push($heroes, $$rogue);
                break;
        }
    }
    $creepLevelHealth = 0;
    foreach ($heroes as $hero) {
        if ($hero instanceof Mage) {
            $creepLevelHealth += ($hero->damage*2)*4;
        } else {
            $creepLevelHealth += $hero->damage*4;
        }
    }
    $currCreepLevelHealth = $creepLevelHealth+40*$level;
    (int)$y = $currCreepLevelHealth/40;
    for ($i=0; $i < $y; $i++) {
        switch (rand(1,3)) {
            case '1':
                $wolf = "wolf$i";
                $health = rand(25,35);
                $$wolf = new Wolf($health, $health, rand(2,4), rand(4,6), "Wolf $i");
                array_push($creeps, $$wolf);
                break;
            case '2':
                $bristleback = "bristleback$i";
                $health = rand(30,40);
                $$bristleback = new Bristleback($health, $health, rand(3,5), rand(3,5), "Bristleback $i");
                array_push($creeps, $$bristleback);
                break;
            case '3':
                $iceElemental = "iceElemental$i";
                $health = rand(35,42);
                $$iceElemental = new IceElemental($health, $health, rand(2,4), rand(3,5), "Ice Elemental $i");
                array_push($creeps, $$iceElemental);
                break;
        }
    }
    $_SESSION['heroes'] = $heroes;
    $_SESSION['creeps'] = $creeps;
    $_SESSION['levelData']['level'] = $level;
    $_SESSION['levelData']['creepLevelHealth'] = $creepLevelHealth;
    $_SESSION['renewal']['healthPotions'] = 1;
    $_SESSION['renewal']['manaPotions'] = 1;
?>
