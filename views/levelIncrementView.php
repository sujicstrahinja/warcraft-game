<script src="javascript/javascript.js" charset="utf-8"></script>
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
  <?php sleep(1); ?>
