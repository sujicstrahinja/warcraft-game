<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="position: fixed; left: -75%;">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel"><?= $_SESSION['heroes'][$_POST['hero']]->name ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding: 15px 15px 10px 15px;">
          <?php if ($_SESSION['heroes'][$_POST['hero']]->health<=0): ?>
                  <h2 class="text-center">Dead</h2>
          <?php else: ?>
          <div class="form-group">
              <div class="row">
                  <div class="col-xs-8">
                      <select id="attackCreeps" class="form-control">
                          <?php foreach ($_SESSION['creeps'] as $key => $creep): ?>
                                  <option value="<?= $key; ?>" <?php echo ($creep->health <= 0) ? "disabled" : ""; ?>><?= $creep->name; ?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>
                  <div class="col-xs-4">
                      <button id="btnAttack" class="btn btn-default form-control" type="button" name="button"><strong>A</strong>ttack</button>
                  </div>
              </div>
          </div>
          <div class="form-group">
              <div class="row">
                  <div class="col-xs-4">
                      <input id="healthPotions" type="number" class="form-control text-center" value="0" min="0" onkeypress='validate(event)' />
                  </div>
                  <div class="col-xs-8">
                      <button id="btnDrinkHealthPotion" class="btn btn-default form-control" type="button" name="button">Drink <strong>H</strong>ealth Potions</button>
                  </div>
              </div>
          </div>
          <?php if($_SESSION['heroes'][$_POST['hero']] instanceof Mage): ?>
              <div class="form-group">
                  <div class="row">
                      <div class="col-xs-8">
                          <select id="fireballCreeps" class="form-control">
                              <?php foreach ($_SESSION['creeps'] as $key => $creep): ?>
                                      <option value="<?= $key; ?>" <?php echo ($creep->health <= 0) ? "disabled" : ""; ?>><?= $creep->name; ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                      <div class="col-xs-4">
                          <button id="btnFireball" class="btn btn-default form-control" type="button" name="button"><strong>F</strong>ireball</button>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <div class="row">
                      <div class="col-xs-12">
                          <button id="btnInferno" class="btn btn-default form-control" type="button" name="button"><strong>I</strong>nferno</button>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <div class="row">
                      <div class="col-xs-4">
                          <input id="manaPotions" type="number" class="form-control text-center" value="0" min="0" onkeypress='validate(event)' />
                      </div>
                      <div class="col-xs-8">
                          <button id="btnDrinkManaPotion" class="btn btn-default form-control" type="button" name="button">Drink <strong>M</strong>ana Potions</button>
                      </div>
                  </div>
              </div>
            <?php endif; ?>
            <div class="modal-body text-center" style="padding-bottom: 0px; border-top: 1px solid #e5e5e5;">
                <p>Available health potions: <?= $_SESSION['renewal']['healthPotions'];  ?></p>
                <?php if($_SESSION['heroes'][$_POST['hero']] instanceof Mage): ?>
                    <p>Available mana potions: <?= $_SESSION['renewal']['manaPotions'];  ?></p>
                <?php endif; ?>
            </div>
          <?php endif; ?>
      </div>
      <div class="modal-footer">
        <button id="modalClose" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
