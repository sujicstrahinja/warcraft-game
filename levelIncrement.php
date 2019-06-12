<?php
    require_once('autoload.php');
    session_start();

    $_SESSION['creeps'] = array();
    $creeps = array();
    $level = $_SESSION['levelData']['level']+1;
    $currCreepLevelHealth = $_SESSION['levelData']['creepLevelHealth']+40*$level;
    (int)$y = $currCreepLevelHealth/40;
    for ($i=0; $i < $y; $i++) {
        switch (rand(1,3)) {
            case '1':
                $wolf = "wolf$i";
                $health = rand(25,35);
                $$wolf = new Wolf($health, $health, rand(2,4), rand(3,5), "Wolf $i");
                array_push($creeps, $$wolf);
                break;
            case '2':
                $bristleback = "bristleback$i";
                $health = rand(30,40);
                $$bristleback = new Bristleback($health, $health, rand(3,5), rand(2,4), "Bristleback $i");
                array_push($creeps, $$bristleback);
                break;
            case '3':
                $iceElemental = "iceElemental$i";
                $health = rand(35,42);
                $$iceElemental = new IceElemental($health, $health, rand(2,4), rand(2,4), "Ice Elemental $i");
                array_push($creeps, $$iceElemental);
                break;
        }
    }

    $_SESSION['creeps'] = $creeps;
    $_SESSION['levelData']['level'] = $level;
    $_SESSION['renewal']['healthPotions']++;
    $_SESSION['renewal']['manaPotions']++;
    $data['levelIncrementView'] = require_once('views/levelIncrementView.php');
    $data['levelArea'] = $level+1;
    echo $data['levelIncrementView']."~".$data['levelArea'];
 ?>
