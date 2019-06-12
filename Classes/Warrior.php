<?php
    class Warrior extends HeroClass
    {
        public function __construct($health, $maxHealth, $armor, $damage, $name = "Warrior")
        {
            parent::__construct($health, $maxHealth, $armor, $damage, $name);
            if (rand( 1, 2) == 1) {
                $this->picture = "./images/warriorPic1.png";
            } else {
                $this->picture = "./images/warriorPic2.png";
            }
            $this->type = "warrior";
        }

        public function __toString()
        {
            return "<span style='color: brown;'>$this->name</span> has: $this->health health/ $this->armor armor/ $this->damage damage";
        }
    }
?>
