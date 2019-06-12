    var selectedCreep;

    function playSound(filename){
        document.getElementById("sound").innerHTML='<audio autoplay="autoplay"><source src="' + filename + '.mp3" type="audio/mpeg" /><source src="' + filename + '.ogg" type="audio/ogg" /><embed hidden="true" autostart="true" loop="false" src="' + filename +'.mp3" /></audio>';
    }

    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function prepareAttackSound(heroType) {
        switch (heroType) {
            case 'warrior':
                switch (getRandomInt(1, 3)) {
                    case 1:
                        file = "sounds/warriorAttack1";
                        break;
                    case 2:
                        file = "sounds/warriorAttack2";
                        break;
                    case 3:
                        file = "sounds/warriorAttack3";
                        break;
                }
                break;
            case 'rogue':
                switch (getRandomInt(1, 3)) {
                    case 1:
                        file = "sounds/rogueAttack1";
                        break;
                    case 2:
                        file = "sounds/rogueAttack2";
                        break;
                    case 3:
                        file = "sounds/rogueAttack3";
                        break;
                }
                break;
            case 'mage':
                switch (getRandomInt(1, 3)) {
                    case 1:
                        file = "sounds/mageAttack1";
                        break;
                    case 2:
                        file = "sounds/mageAttack2";
                        break;
                    case 3:
                        file = "sounds/mageAttack3";
                        break;
                }
                break;
        }
        playSound(file);
    }

    function heroKilledCreeps() {
        $("#heroContainer"+selectedHero+" .heroHealth").html(currHero['health']+"/"+currHero['maxHealth']);
        $("#heroContainer"+selectedHero+" .heroArmor").html(currHero['armor']);
        $("#heroContainer"+selectedHero+" .heroHealthBar").css("width", (currHero['health']/currHero['maxHealth'])*100+"%");
        if (currHero['type'] == 'mage') {
            $("#heroContainer"+selectedHero+" .heroMana").html(currHero['mana']+"/"+currHero['maxMana']);
            $("#heroContainer"+selectedHero+" .heroManaBar").css("width", (currHero['mana']/currHero['maxMana'])*100+"%");
        }
        $("#modalClose").trigger('click');
        $.ajax({
            url: 'levelIncrement.php',
            success: function(data) {
                var data = data.split("~");
                $('#myCarousel').html(data[0]);
                $('#levelArea').html("Level "+data[1]);
            }
        })
    }

    $("#btnAttack").click(function(event) {
        selectedCreep = $("#attackCreeps option:selected").val();
        $.ajax({
            url: 'ajaxUtilities.php',
            type: 'POST',
            data:
            {
                hero : selectedHero,
                target : selectedCreep,
                function : ["modalAction", "attack"]
            },
            success: function(data) {
                var data = data.split("~");
                $("#statusBar").val(data[0]);
                currHero = JSON.parse(data[1]);
                if (data[data.length-1] == 'gameOver') {
                    $("#heroContainer"+selectedHero+" .heroHealth").html(currHero['health']+"/"+currHero['maxHealth']);
                    $("#heroContainer"+selectedHero+" .heroArmor").html(currHero['armor']);
                    $("#heroContainer"+selectedHero+" .heroHealthBar").css("width", (currHero['health']/currHero['maxHealth'])*100+"%");
                    $("#modalClose").trigger('click');
                } else {
                    if (data[data.length-1] == true) {
                        heroKilledCreeps();

                    } else {
                        currCreep = JSON.parse(data[2]);
                        $("#heroContainer"+selectedHero+" .heroHealth").html(currHero['health']+"/"+currHero['maxHealth']);
                        $("#heroContainer"+selectedHero+" .heroArmor").html(currHero['armor']);
                        $("#heroContainer"+selectedHero+" .heroHealthBar").css("width", (currHero['health']/currHero['maxHealth'])*100+"%");
                        $("#creepContainer"+selectedCreep+" .creepHealth").html(currCreep['health']+"/"+currCreep['maxHealth']);
                        $("#creepContainer"+selectedCreep+" .creepHealthBar").css("width",  (currCreep['health']/currCreep['maxHealth'])*100+"%");
                        $("#modalClose").trigger('click');
                        $("#creepContainer"+selectedCreep).shake({
                            direction: "left",
                            distance: 4,
                            times: 1
                        });
                    }
                }
                $("#heroContainer"+selectedHero).shake({
                    direction: "top",
                    distance: 1,
                    times: 1
                });
                prepareAttackSound(currHero['type']);
            }
        })
    });

    $("#btnDrinkHealthPotion").click(function(event) {
        var healthPotions = $("#healthPotions").val();
        $.ajax({
            url: 'ajaxUtilities.php',
            type: 'POST',
            data:
            {
                hero : selectedHero,
                healthPotions : healthPotions,
                function : ["modalAction", "drinkHealthPotion"]
            },
            success: function(data) {
                var data = data.split("~");
                $("#statusBar").val(data[0]);
                currHero = JSON.parse(data[1]);
                $("#heroContainer"+selectedHero+" .heroHealth").html(currHero['health']+"/"+currHero['maxHealth']);
                $("#heroContainer"+selectedHero+" .heroHealthBar").css("width", (currHero['health']/currHero['maxHealth'])*100+"%");
                $("#modalClose").trigger('click');
            }
        })
    });

    $("#btnFireball").click(function(event) {
        selectedCreep = $("#fireballCreeps option:selected").val();
        $.ajax({
            url: 'ajaxUtilities.php',
            type: 'POST',
            data:
            {
                hero : selectedHero,
                target : selectedCreep,
                function : ["modalAction", "fireball"]
            },
            success: function(data) {
                var data = data.split("~");
                $("#statusBar").val(data[0]);
                currHero = JSON.parse(data[1]);
                if (data[0] != (currHero['name']+" has no mana to cast fireball! Try drinking a potion of mana.")) {
                    if (data[data.length-1] == true) {
                        heroKilledCreeps();
                    } else {
                        currCreep = JSON.parse(data[2]);
                        $("#heroContainer"+selectedHero+" .heroMana").html(currHero['mana']+"/"+currHero['maxMana']);
                        $("#heroContainer"+selectedHero+" .heroManaBar").css("width", (currHero['mana']/currHero['maxMana'])*100+"%");
                        $("#creepContainer"+selectedCreep+" .creepHealth").html(currCreep['health']+"/"+currCreep['maxHealth']);
                        $("#creepContainer"+selectedCreep+" .creepHealthBar").css("width",  (currCreep['health']/currCreep['maxHealth'])*100+"%");
                        $("#modalClose").trigger('click');
                        $("#creepContainer"+selectedCreep).shake({
                            direction: "left",
                            distance: 10,
                            times: 1
                        });
                    }
                }
                playSound('sounds/fireball');
            }
        })
    });

    $("#btnDrinkManaPotion").click(function(event) {
        var manaPotions = $("#manaPotions").val();
        $.ajax({
            url: 'ajaxUtilities.php',
            type: 'POST',
            data:
            {
                hero : selectedHero,
                manaPotions : manaPotions,
                function : ["modalAction", "drinkManaPotions"]
            },
            success: function(data) {
                var data = data.split("~");
                $("#statusBar").val(data[0]);
                currHero = JSON.parse(data[1]);
                $("#heroContainer"+selectedHero+" .heroMana").html(currHero['mana']+"/"+currHero['maxMana']);
                $("#heroContainer"+selectedHero+" .heroManaBar").css("width", (currHero['mana']/currHero['maxMana'])*100+"%");
                $("#modalClose").trigger('click');
            }
        })
    });

    $("#btnInferno").click(function(event) {
        $.ajax({
            url: 'ajaxUtilities.php',
            type: 'POST',
            data:
            {
                hero : selectedHero,
                function : ["modalAction", "inferno"]
            },
            success : function(data) {
                var data = data.split("~");
                $("#statusBar").val(data[0]);
                currHero = JSON.parse(data[1]);
                if (data[0] != (currHero['name']+" has no mana to cast inferno! Try drinking a potion of mana.")) {
                    if (data[data.length-1] == true) {
                        heroKilledCreeps();
                    } else {
                        infernoedCreeps = JSON.parse(data[2]);
                        for (var i = 0, len = infernoedCreeps.length; i < len; i++) {
                            $("#creepContainer"+i+" .creepHealth").html(infernoedCreeps[i]['health']+"/"+infernoedCreeps[i]['maxHealth']);
                            $("#creepContainer"+i+" .creepHealthBar").css("width",  (infernoedCreeps[i]['health']/infernoedCreeps[i]['maxHealth'])*100+"%");
                        }
                        $("#heroContainer"+selectedHero+" .heroMana").html(currHero['mana']+"/"+currHero['maxMana']);
                        $("#heroContainer"+selectedHero+" .heroManaBar").css("width", (currHero['mana']/currHero['maxMana'])*100+"%");
                        $("#modalClose").trigger('click');
                        $("#myCarousel").shake({
                            direction: "right",
                            distance: 10,
                            times: 1
                        });
                    }
                    playSound('sounds/inferno');
                }
            }
        })
    });
