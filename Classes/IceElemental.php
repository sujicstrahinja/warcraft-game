<?php
    class IceElemental extends Creep
    {
        public function freeze($target)
        {
            if ((rand(0, 100))<=10) {
                return true;
            }
        }

        public function __construct($health, $maxHealth, $armor, $damage, $name = "IceElemental")
        {
            parent::__construct($health, $maxHealth, $armor, $damage, $name);
            $this->picture = "./images/iceElemental.png";
            $this->type = "iceElemental";
        }

        public function __toString()
        {
            return "<span style='color: grey;'>$this->name</span> has: $this->health health/ $this->armor armor/ $this->damage damage";
        }
    }
?>
