<?php
    class Bristleback extends Creep
    {
        public function thorns($target)
        {
            $thornsDamage = 3;
            if ((rand( 0,100))<=15) {
                $target->health -= $thornsDamage;
                if ($target->health <= 0) {
                    $targetName = $target->name;
                    unset($target);
                    return "$targetName has died from the damage inflicted by $this->name's thorns.";
                } else {
                    return "$this->name's thorns have caused $thornsDamage damage to $target->name.";
                }
            }
        }

        public function __construct($health, $maxHealth, $armor, $damage, $name = "Bristleback")
        {
            parent::__construct($health, $maxHealth, $armor, $damage, $name);
            $this->picture = "./images/bristleback.png";
            $this->type ="bristleback";
        }

        public function __toString()
        {
            return "<span style='color: grey;'>$this->name</span> has: $this->health health/ $this->armor armor/ $this->damage damage";
        }
    }
?>
