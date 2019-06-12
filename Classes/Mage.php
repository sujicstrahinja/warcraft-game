<?php
    class Mage extends HeroClass implements Spells
    {
        public $mana;
        public $maxMana;

        public function __construct($health, $maxHealth, $armor, $damage, $mana, $maxMana, $name = "Mage")
        {
            parent::__construct($health, $maxHealth, $armor, $damage, $name);
            $this->mana = $mana;
            $this->maxMana = $maxMana;
            if (rand( 1, 2) == 1) {
                $this->picture = "./images/magePic1.png";
            } else {
                $this->picture = "./images/magePic2.png";
            }
            $this->type = "mage";
        }

        public function spellbook()
        {
            $spellbook = "";
            foreach (get_class_methods(Spells::class) as $spell) {
                $spellbook .= "$spell, ";
            }
            return "$this->name has these spells: ".rtrim(trim($spellbook), ',').".";
        }

        function fireball($target)
        {
            if ($this->mana >= 15) {
                $this->mana -= 15;
                $target->health = $target->health - ((int) ($this->damage * 2.5));
                if ($target->health <= 0) {
                    $target->health = 0;
                    $killed = $target->name;
                    unset($target);
                    return "$this->name has blasted $killed for ".((int) ($this->damage * 2.5)).". $killed has been killed.";
                } else {
                    return "$this->name has blasted $target->name with a fireball for "
                    .((int) ($this->damage * 2.5))." damage. $target->name now has $target->health health.";
                }
            } else {
                return "$this->name has no mana to cast fireball! Try drinking a potion of mana.";
            }
        }

        function inferno($creeps)
        {
            if ($this->mana >=25) {
                $damagedCharacters = array();
                $killedCharacters = array();
                $this->mana -= 25;
                foreach ($creeps as $creep) {
                    $creep->health = $creep->health - ((int) ($this->damage * 1.8));
                    if ($creep->health <= 0) {
                        $creep->health = 0;
                        array_push($killedCharacters, $creep->name);
                        unset($creep);
                    } else {
                        array_push($damagedCharacters, $creep->name);
                    }
                }
                if (count($killedCharacters) == 0) {
                    if (count($killedCharacters) == 1) {
                        return "$this->name casted the mighty inferno! "
                        .implode(", ", $damagedCharacters)." has been hit for ".((int) ($this->damage * 1.8)).".";
                    } else {
                        return "$this->name casted the mighty inferno! "
                        .implode(", ", $damagedCharacters)." have been hit for ".((int) ($this->damage * 1.8)).".";
                    }
                } elseif (count($damagedCharacters) == 0) {
                    if (count($killedCharacters) == 1) {
                        return "$this->name casted the mighty inferno! "
                        .implode(", ", $killedCharacters)." has been killed.";
                    } else {
                        return "$this->name casted the mighty inferno! "
                        .implode(", ", $killedCharacters)." have been killed.";
                    }
                } else {
                    return "$this->name casted the mighty inferno! "
                    .implode(", ", $damagedCharacters)." have been hit for "
                    .((int) ($this->damage * 1.8)).", and ".implode(", ", $killedCharacters)." have been killed.";
                }
            } else {
                return "$this->name has no mana to cast inferno! Try drinking a potion of mana.";
            }
        }

        public function drinkManaPotion($potions)
        {
            if ($this->mana == $this->maxMana) {
                return "$this->name already has full mana!";
            } elseif (($this->mana + (10*$potions))>$this->maxMana) {
                $this->mana = $this->maxMana;
                if ($potions == 1) {
                    return "$this->name has drank $potions potion and has refilled his mana fully!";
                } else {
                    return "$this->name has drank $potions potions and has refilled his mana fully!";
                }
            } else {
                $this->mana = $this->mana + (10*$potions);
                if ($potions == 1) {
                    return "$this->name has drank $potions potion, and has restored ".(10*$potions)." mana.";
                } else {
                    return "$this->name has drank $potions potions, and has restored ".(10*$potions)." mana.";
                }
            }
        }

        public function __toString()
        {
            return "<span style='color: blue;'>$this->name</span> has:
            $this->health health/ $this->mana mana/ $this->armor armor/ $this->damage damage";
        }
    }
?>
