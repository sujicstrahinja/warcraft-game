<?php
    class Wolf extends Creep
    {
        public function __construct($health, $maxHealth, $armor, $damage, $name = "Wolf")
        {
            parent::__construct($health, $maxHealth, $armor, $damage, $name);
            $this->picture = "./images/wolf.png";
            $this->type = "wolf";
        }

        public function __toString()
        {
            return "<span style='color: grey;'>$this->name</span> has: $this->health health/ $this->armor armor/ $this->damage damage";
        }
    }
?>
