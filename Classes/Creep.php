<?php
    abstract class Creep extends Character
    {
        public function __construct($health, $maxHealth, $armor, $damage, $name)
        {
            $this->name = $name;
            $this->health = $health;
            $this->maxHealth = $maxHealth;
            $this->armor = $armor;
            $this->damage = $damage;
        }
    }
?>
