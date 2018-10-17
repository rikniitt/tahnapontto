<div class="jumbotron">
    <h1>Jaa tekstitiedostoja</h1>
    <p class="lead">Tahnapönttö on helppo tapa jakaa tekstitiedostoja väliaikaisesti</p>
    <p><a class="btn btn-lg btn-success" href="<?php echo $this->urlhelp->to('/add'); ?>" role="button">Lisää uusi</a></p>
</div>

<div class="row marketing">
    <h3>Uusimmat</h3>
    <?php foreach ($this->latestTextFiles as $i => $file): ?>
        <div class="row-marketing">
            <div class="col-lg-6">
                <h4>
                    <a href="<?php echo $this->urlhelp->to('/show/' . $file->id); ?>">
                        <?php echo $file->name; ?>
                    </a>
                </h4>
                <p>
                    <span class="text-muted">
                        <?php echo $file->type; ?>,
                        <?php echo $file->contentLengthHuman(); ?>
                    </span>
                    <br />
                    <em><?php echo $file->createdAt; ?></em>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
