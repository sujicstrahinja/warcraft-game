<?php
    abstract class HeroClass extends Character
    {
        public $frozen;

        public function attack($target)
        {
            if ($this->frozen) {
                $this->frozen = false;
                return "$this->name is frozen and is unable to attack!";
            } else {
                if (method_exists($target, 'freeze')) {
                    if ($target->freeze($this)) {
                        $this->frozen = true;
                        return "$this->name got frozen while attacking $target->name!";
                    }
                }
                $thornsNotification = "";
                if (method_exists($target, 'thorns')) {
                    $thornsNotification = $target->thorns($this);
                    if ($this->health <= 0) {
                        // unset($this);
                        __unset();
                    }
                }
                $damage;
                if (($this->damage-$target->armor)<0) {
                    $damage = 0;
                } else {
                    $damage = $this->damage-$target->armor;
                }
                $target->health = $target->health - $damage;
                if ($target->health <= 0) {
                    $target->health = 0;
                    $killed = $target->name;
                    unset($target);
                    return "$this->name has attacked $killed for $damage. $killed has been killed.";
                } else {
                    if ($this->armor >= $target->damage) {
                        $this->armor -= $target->damage;
                        return "$this->name has attacked $target->name for $damage. $target->name has retaliated and damaged $this->name's armor for $target->damage. $target->name now has $target->health health. $thornsNotification";
                    } elseif (($this->armor<$target->damage) && $this->armor>0) {
                        $leftoverDamage = $this->armor;
                        $this->armor = 0;
                        $this->health -= ($target->damage - $leftoverDamage);
                        if ($this->health <= 0) {
                            $this->health = 0;
                            $heroName = $this->name;
                            // unset($this);
                            __unset();
                            return "$heroName has attacked $target->name for $damage, and but died in the process. $target->name now has $target->health health. $thornsNotification";
                        } else {
                            return "$this->name has attacked $target->name for $damage. $target->name has retaliated for $leftoverDamage while destroying $this->name's armor. $target->name now has $target->health health. $thornsNotification";
                        }
                    } else {
                        $this->health -= $target->damage;
                        if ($this->health <= 0) {
                            $this->health = 0;
                            $heroName = $this->name;
                            // unset($this);
                            __unset();
                            return "$heroName has attacked $target->name for $damage, and but died in the process. $target->name now has $target->health health.";
                        } else {
                            return "$this->name has attacked $target->name for $damage $target->name has retaliated for $target->damage. $target->name now has $target->health health. $thornsNotification";
                        }
                    }
                }
            }
        }

        public function drinkHealthPotion($potions)
        {
            if ($this->health == $this->maxHealth) {
                return "$this->name already has full health!";
            } elseif (($this->health + (10*$potions))>$this->maxHealth) {
                $this->health = $this->maxHealth;
                if ($potions == 1) {
                    return "$this->name has drank $potions potion and now has full health!";
                } else {
                    return "$this->name has drank $potions potions and now has full health!";
                }
            } else {
                $this->health = $this->health + (10*$potions);
                if ($potions == 1) {
                    return "$this->name has drank $potions potion and restored ".(10*$potions)." health.";
                } else {
                    return "$this->name has drank $potions potions and restored ".(10*$potions)." health.";
                }
            }
        }

        public function __construct($health, $maxHealth, $armor, $damage, $name)
        {
            $this->name = $name;
            $this->health = $health;
            $this->maxHealth = $maxHealth;
            $this->armor = $armor;
            $this->damage = $damage;
            $this->frozen = false;
        }
    }
?>
