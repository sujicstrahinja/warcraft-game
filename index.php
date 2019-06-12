<?php require_once('initialization.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Warcraft is a franchise of video games, novels, and other media created by Blizzard Entertainment. The series is made up of five core games: Warcraft: Orcs & Humans, Warcraft II: Tides of Darkness, Warcraft III: Reign of Chaos, World of Warcraft, and Hearthstone.">
    <link rel="shortcut icon" href="images/wcIcon.png">
    <title>Online Warcraft Game</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  </head>
  <body>
    <?php require_once('views/view.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="javascript/javascript.js" charset="utf-8"></script>
    <script src="javascript/jquery.ui.shake.min.js" charset="utf-8"></script>
    <script src="javascript/jquery.hotkeys.js" charset="utf-8"></script>
    <script type="text/javascript">
        var selectedHero;

        $("div[id^=heroContainer] img").click(function(event) {
            selectedHero = $(this).attr('id');
            popUpAjax();
        });

        var heroes = <?= json_encode($_SESSION['heroes']); ?>;
        var keyz = [];
        for (var i = 0; i < heroes.length; i++) {
            keyz[i] = i+1;
        }

        $(document).bind('keydown', keyz, function(event) {
            if (!$(".modal-backdrop").length) {
                if (keyz.includes(Number(event.key))) {
                    $("#modalClose").trigger('click');
                    $(".modal-backdrop").remove();

                    selectedHero = event.key-1;
                    popUpAjax();
                }
            }
        });
        $(document).bind('keydown', 'a', function(event) {
            if ($(".modal-backdrop").length) {
                $("#btnAttack").trigger('click');
            }
        });

        $(document).bind('keydown', 'i', function(event) {
            if ($(".modal-backdrop").length) {
                $("#btnInferno").trigger('click');
            }
        });

        $(document).bind('keydown', 'f', function(event) {
            if ($(".modal-backdrop").length) {
                $("#btnFireball").trigger('click');
            }
        });

        $(document).bind('keydown', 'h', function(event) {
            if ($(".modal-backdrop").length) {
                $("#btnDrinkHealthPotion").trigger('click');
            }
        });

        $(document).bind('keydown', 'm', function(event) {
            if ($(".modal-backdrop").length) {
                $("#btnDrinkManaPotion").trigger('click');
            }
        });
    </script>
  </body>
</html>
