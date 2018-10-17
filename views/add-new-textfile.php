<div class="row">
    <div class="col-md-12">
        <h1>Lisää uusi tekstitiedosto</h1>
        <?php foreach ($this->validationErrors as $err): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $err; ?>
            </div>
        <?php endforeach; ?>
        <form action="<?php echo $this->urlhelp->to('/textfile/save'); ?>" method="post">
            <div class="form-group">
                <label for="name">tiedoston nimi</label>
                <input type="text" class="form-control" name="name" placeholder="tiedosto.txt">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="content" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="type">tiedostotyyppi</label>
                <select class="form-control" name="type">
                    <?php foreach ($this->fileTypes as $fType): ?>
                        <option value="<?php echo $fType; ?>">
                            <?php echo $fType; ?>
                        </option>tion>
                    <?php endforeach; ?>
                </select>
                <p class="help-block"></p>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="visibleOnlyWithLink" value="1"> Pääsy vain linkillä
                </label>
            </div>
            <div class="form-group">
                <label for="validUntil">vanhenee</label>
                <select class="form-control" name="validUntil">
                    <option value="+2000 years">ei koskaan</option>
                    <option value="+15 mins">15min</option>
                    <option value="+30 mins">30min</option>
                    <option value="+1 hour">1h</option>
                    <option value="+2 hours">2h</option>
                    <option value="+6 hours">6h</option>
                    <option value="+12 hours">12h</option>
                    <option value="+1 day">24h</option>
                    <option value="+2 days">2pv</option>
                    <option value="+7 days">1vko</option>
                    <option value="+1 month">1kk</option>
                </select>
            </div>
            <button type="submit" class="btn btn-default">Tallenna</button>
        </form>
    </div>
</div>