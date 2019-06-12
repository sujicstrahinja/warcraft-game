<?php require_once('autoload.php'); ?>
<?php session_start(); ?>
<?php if (isset($_POST['function']) && ($_POST['function'] == "popup")): ?>
    <script src="javascript/ajaxUtilities.js" charset="utf-8"></script>
    <?php
        require_once('views/modalView.php');
    ?>
<?php endif;?>
<?php if(isset($_POST['function']) && ($_POST['function'][0] == "modalAction")) {

        function creepCheck() {
            $creepCheckCount = 0;
            for ($i=0, $len = count($_SESSION['creeps']); $i < $len; $i++) {
                if ($_SESSION['creeps'][$i]->health == '0') {
                        $creepCheckCount++;
                    }
            }
            if ($creepCheckCount == count($_SESSION['creeps'])) {
                return true;
            } else {
                return false;
            }
        }

        function deadHeroesCheck() {
            $heroCheckCount = 0;
            for ($i=0, $len = count($_SESSION['heroes']); $i < $len; $i++) {
                if ($_SESSION['heroes'][$i]->health == '0') {
                        $heroCheckCount++;
                    }
            }
            if ($heroCheckCount == count($_SESSION['heroes'])) {
                return true;
            } else {
                return false;
            }
        }

        switch ($_POST['function'][1]) {
            case 'attack':
                $data['output'] = $_SESSION['heroes'][$_POST['hero']]->attack($_SESSION['creeps'][$_POST['target']]);
                if ($_SESSION['heroes'][$_POST['hero']]->health == 0) {
                    if (deadHeroesCheck()) {
                        $data['flag'] = 'gameOver';
                        $data['hero'] = json_encode($_SESSION['heroes'][$_POST['hero']]);
                        $data['output'] = "All heroes are dead! Game over! You have completed ".($_SESSION['levelData']['level'])." levels.";
                        echo $data['output']."~".$data['hero']."~".$data['flag'];
                    } else {
                        if (creepCheck()) {
                            $data['flag'] = true;
                            $data['hero'] = json_encode($_SESSION['heroes'][$_POST['hero']]);
                            echo $data['output']."~".$data['hero']."~".$data['flag'];
                        } else {
                            $data['flag'] = false;
                            $data['hero'] = json_encode($_SESSION['heroes'][$_POST['hero']]);
                            $data['targetCreep'] = json_encode($_SESSION['creeps'][$_POST['target']]);
                            echo $data['output']."~".$data['hero']."~".$data['targetCreep']."~".$data['flag'];
                        }
                    };
                } else {
                        if (creepCheck()) {
                            $data['flag'] = true;
                            $data['hero'] = json_encode($_SESSION['heroes'][$_POST['hero']]);
                            echo $data['output']."~".$data['hero']."~".$data['flag'];
                        } else {
                            $data['flag'] = false;
                            $data['hero'] = json_encode($_SESSION['heroes'][$_POST['hero']]);
                            $data['targetCreep'] = json_encode($_SESSION['creeps'][$_POST['target']]);
                            echo $data['output']."~".$data['hero']."~".$data['targetCreep']."~".$data['flag'];
                    }
                };
                break;
            case 'drinkHealthPotion':
                if ($_SESSION['renewal']['healthPotions'] >= $_POST['healthPotions']) {
                    $_SESSION['renewal']['healthPotions'] -= $_POST['healthPotions'];
                    $data['output'] = $_SESSION['heroes'][$_POST['hero']]->drinkHealthPotion($_POST['healthPotions']);
                    $data['hero'] = json_encode($_SESSION['heroes'][$_POST['hero']]);
                    echo $data['output']."~".$data['hero'];
                } else {
                    $data['output'] = "You don't have that many health potions!";
                    $data['hero'] = json_encode($_SESSION['heroes'][$_POST['hero']]);
                    echo $data['output']."~".$data['hero'];
                }
                break;
            case 'fireball':
                $data['output'] = $_SESSION['heroes'][$_POST['hero']]->fireball($_SESSION['creeps'][$_POST['target']]);
                if (creepCheck()) {
                    $data['flag'] = true;
                    $data['hero'] = json_encode($_SESSION['heroes'][$_POST['hero']]);
                    echo $data['output']."~".$data['hero']."~".$data['flag'];
                } else {
                    $data['flag'] = false;
                    $data['hero'] = json_encode($_SESSION['heroes'][$_POST['hero']]);
                    $data['targetCreep'] = json_encode($_SESSION['creeps'][$_POST['target']]);
                    echo $data['output']."~".$data['hero']."~".$data['targetCreep']."~".$data['flag'];
                }
                break;
            case 'drinkManaPotions':
                if ($_SESSION['renewal']['manaPotions'] >= $_POST['manaPotions']) {
                    $_SESSION['renewal']['manaPotions'] -= $_POST['manaPotions'];
                    $data['output'] = $_SESSION['heroes'][$_POST['hero']]->drinkManaPotion($_POST['manaPotions']);
                    $data['hero'] = json_encode($_SESSION['heroes'][$_POST['hero']]);
                    echo $data['output']."~".$data['hero'];
                } else {
                    $data['output'] = "You don't have that many mana potions!";
                    $data['hero'] = json_encode($_SESSION['heroes'][$_POST['hero']]);
                    echo $data['output']."~".$data['hero'];
                }
                break;
            case 'inferno':
                $data['output'] = $_SESSION['heroes'][$_POST['hero']]->inferno($_SESSION['creeps']);
                if (creepCheck()) {
                    $data['flag'] = true;
                    $data['hero'] = json_encode($_SESSION['heroes'][$_POST['hero']]);
                    echo $data['output']."~".$data['hero']."~".$data['flag'];
                } else {
                    $data['flag'] = false;
                    $data['hero'] = json_encode($_SESSION['heroes'][$_POST['hero']]);
                    $data['creeps'] = json_encode($_SESSION['creeps']);
                    echo $data['output']."~".$data['hero']."~".$data['creeps'];
                }
                break;
        }
    }
 ?>
