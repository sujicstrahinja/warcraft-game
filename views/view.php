    <div id="heroBanner" class="col-md-11 col-md-offset-1 text-center white-text"><h3>Heroes</h3><span id="levelArea">Level <?= $_SESSION['levelData']['level']+1; ?></span></div>
      <div class="col-md-8 col-md-offset-3">
      <div class="carousel slide">
        <div class="carousel-inner">
            <div class="item active">
                <?php foreach ($heroes as $key => $hero): ?>
                  <div id="heroContainer<?= $key ?>" class="col-md-3">
                      <div class="row">
                          <div class="col-md-12 heroName">
                              <?= $hero->name ?>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-1">
                              <i class="fa fa-gavel" aria-hidden="true"></i><br/>
                              <?= $hero->damage ?>
                          </div>
                          <div class="col-md-7 heroPicture">
                              <img id="<?= $key ?>" src="<?= $hero->picture ?>" width="100%" height="100%" alt="" class="img-responsive">
                          </div>
                          <div class="col-md-1">
                              <i class="fa fa-shield" aria-hidden="true"></i><br/>
                              <span class="heroArmor"><?= $hero->armor ?></span>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-10 col-md-offset-1">
                              <div class="row">
                                  <div class="progress">
                                      <div class="progress-bar progress-bar-success heroHealthBar" role="progressbar" aria-valuenow="<?= $hero->health ?>" aria-valuemin="0" aria-valuemax="<?= $hero->maxHealth ?>" style="width: <?= ($hero->health/$hero->maxHealth)*100 ?>%;">
                                        <span class="show heroHealth whiteish-text"><?= $hero->health."/".$hero->maxHealth ?></span>
                                      </div>
                                  </div>
                              </div>
                              <?php if ($hero instanceof Mage): ?>
                                      <div class="row">
                                          <div class="progress">
                                              <div class="progress-bar heroManaBar" role="progressbar" aria-valuenow="<?= $hero->mana ?>" aria-valuemin="0" aria-valuemax="<?= $hero->maxMana ?>" style="width: <?= ($hero->mana/$hero->maxMana)*100 ?>%;">
                                                <span class="show heroMana whiteish-text"><?= $hero->mana."/".$hero->maxMana ?></span>
                                              </div>
                                          </div>
                                      </div>
                              <?php endif; ?>
                          </div>
                      </div>
                  </div>
                <?php endforeach; ?>
            </div>
        </div>
      </div>
  </div>
  <!-- CREEP DEO -->
  <div id="creepBanner" class="col-md-11 col-md-offset-1 text-center white-text"><h3>Creeps</h3></div>
    <div id="creepContainer" class="col-md-8 col-md-offset-3">
    <div class="carousel slide" id="myCarousel">
      <div class="carousel-inner">
          <?php foreach ($creeps as $key => $creep): ?>
              <div class="item <?php echo ($creep === reset($creeps)) ? "active" : "" ?>">
                <div id="creepContainer<?= $key ?>" class="col-md-3">
                    <div class="row">
                        <div class="col-md-12 heroName">
                            <?= $creep->name ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <i class="fa fa-gavel" aria-hidden="true"></i><br/>
                            <?= $creep->damage ?>
                        </div>
                        <div class="col-md-7 creepPicture">
                            <img src="<?= $creep->picture ?>" width="100%" height="100%" alt="" class="img-responsive">
                        </div>
                        <div class="col-md-1">
                            <i class="fa fa-shield" aria-hidden="true"></i><br/>
                            <?= $creep->armor ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="progress">
                                <div class="progress-bar progress-bar-success creepHealthBar" role="progressbar" aria-valuenow="<?= $creep->health ?>" aria-valuemin="0" aria-valuemax="<?= $creep->maxHealth ?>" style="width: <?= ($creep->health/$creep->maxHealth)*100 ?>%;">
                                  <span class="show creepHealth whiteish-text"><?= $creep->health."/".$creep->maxHealth ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          <?php endforeach; ?>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
    </div>
</div>
<div class="col-md-12 text-center"><input id="statusBar" type="text" style="text-align: center;" value="Welcome! Click on any hero's image or press the number of hero's positions to open commands! You get one health and mana potion at the beginning and one of each after every level." class="form-control" readonly></div>
<div id="heroModal"></div>
<input id="modalOpen" type="hidden" name="" value="" data-toggle="modal" data-target="#exampleModal">
<div id="sound"></div>
<?php sleep(1); ?>
