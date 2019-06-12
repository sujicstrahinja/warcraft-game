<?php
    class Rogue extends HeroClass
    {
        public function __construct($health, $maxHealth, $armor, $damage, $name = "Rogue")
        {
            parent::__construct($health, $maxHealth, $armor, $damage, $name);
            if (rand(1, 2) == 1) {
                $this->picture = "./images/roguePic1.png";
            } else {
                $this->picture = "./images/roguePic2.png";
            }
            $this->type = "rogue";
        }

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
                }
                $damage = $this->damage-$target->armor;
                $criticalFlag = false;
                if (rand(0, 100)<=20) {
                    $criticalFlag = true;
                    $damage = (int)($this->damage*1.5)-$target->armor;
                    if ($damage<=0) {
                        $damage = 0;
                    }
                } else {
                    if (($this->damage-$target->armor)<0) {
                        $damage = 0;
                    }
                }
                $target->health = $target->health - $damage;
                if ($target->health <= 0) {
                    $target->health = 0;
                    $killed = $target->name;
                    unset($target);
                    if ($criticalFlag) {
                        return "$this->name has landed a critical strike on $killed for $damage! $killed has been killed.";
                    }
                    return "$this->name has attacked $killed for $damage. $killed has been killed.";
                } else {
                    if ($criticalFlag) {
                        if ($this->armor >= $target->damage) {
                            $this->armor -= $target->damage;
                            return "$this->name has landed a critical strike on $target->name for $damage! $target->name has retaliated and damaged $this->name's armor for $target->damage. $target->name now has $target->health health.";
                        } elseif (($this->armor<$target->damage) && $this->armor>0) {
                            $leftoverDamage = $this->armor;
                            $this->armor = 0;
                            $this->health -= ($target->damage - $leftoverDamage);
                            if ($this->health <= 0) {
                                $this->health = 0;
                                $heroName = $this->name;
                                // unset($this);
                                __unset();
                                return "$heroName has landed a critical strike on $target->name for $damage! But died in the process. $target->name now has $target->health health.";
                            } else {
                                return "$this->name has landed a critical strike on $target->name for $damage! $target->name retaliated for $leftoverDamage while destroying $this->name's armor. $target->name now has $target->health health.";
                            }
                        } else {
                            $this->health -= $target->damage;
                            if ($this->health <= 0) {
                                $this->health = 0;
                                $heroName = $this->name;
                                // unset($this);
                                __unset();
                                return "$heroName has landed a critical strike on $target->name for $damage, but died in the process. $target->name now has $target->health health.";
                            } else {
                                return "$this->name has landed a critical strike on $target->name for $damage! $target->name has retaliated for $target->damage. $target->name now has $target->health health.";
                            }
                        }
                    }
                    if ($this->armor >= $target->damage) {
                        $this->armor -= $target->damage;
                        return "$this->name has attacked $target->name for $damage. $target->name has retaliated and damaged $this->name's armor for $target->damage. $target->name now has $target->health health.";
                    } elseif (($this->armor<$target->damage) && $this->armor>0) {
                        $leftoverDamage = $this->armor;
                        $this->armor = 0;
                        $this->health -= ($target->damage - $leftoverDamage);
                        if ($this->health <= 0) {
                            $this->health = 0;
                            $heroName = $this->name;
                            // unset($this);
                            __unset();
                            return "$heroName has attacked $target->name for $damage, but died in the process. $target->name now has $target->health health.";
                        } else {
                            return "$this->name has attacked $target->name for $damage. $target->name has retaliated for $leftoverDamage while destroying $this->name's armor. $target->name now has $target->health health.";
                        }
                    } else {
                        $this->health -= $target->damage;
                        if ($this->health <= 0) {
                            $this->health = 0;
                            $heroName = $this->name;
                            // unset($this);
                            __unset();
                            return "$heroName has attacked $target->name for $damage, but died in the process. $target->name now has $target->health health.";
                        } else {
                            return "$this->name has attacked $target->name for $damage. $target->name has retaliated for $target->damage. $target->name now has $target->health health.";
                        }
                    }
                }
            }
        }

        public function __toString()
        {
            return "<span style='color: green;'>$this->name</span> has:
            $this->health health/ $this->armor armor/ $this->damage damage";
        }
    }
?>
