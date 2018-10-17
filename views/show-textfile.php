<div class="row">
    <div class="col-md-12">
        <h1>
            <?php echo $this->escape($this->textFile->name); ?>
        </h1>
        <div class="row">
            <div class="col-sm-12">
                <pre><code><?php echo $this->escape($this->textFile->content); ?></code></pre>
            </div>
        </div>
        <div class="row text-muted">
            <div class="col-sm-4">
                <small >
                    <?php echo $this->textFile->type; ?>,
                    <?php echo $this->textFile->contentLengthHuman(); ?>
                    <br />
                    vanhenee <?php echo $this->textFile->validUntil; ?>
                    <br />
                    <?php echo ($this->textFile->visibleOnlyWithLink) ? 'vain linkillä' : 'julkinen'; ?>
                </small>
            </div>
            <div class="col-sm-4">
                <small>
                    Luotu<br />
                    <?php echo $this->textFile->createdAt; ?>
                </small>
            </div>
            <div class="col-sm-2">
                <a href="<?php echo $this->urlhelp->to('/download/' . $this->textFile->id); ?>" class="btn btn-xs btn-default">
                    <span class="glyphicon glyphicon-download" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </div>
</div>