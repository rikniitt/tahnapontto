<div class="row">
    <div class="col-md-12">
        <h1>Tekstitiedostot</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>nimi</th>
                    <th>pituus</th>
                    <th>tyyppi</th>
                    <th>julkinen</th>
                    <th>luontiaika</th>
                    <th>vanhenee</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->textFiles as $file): ?>
                    <tr>
                        <th scope="row">
                            <a href="<?php echo $this->urlhelp->to('/show/' . $file->id); ?>">
                                <?php echo $file->id; ?>
                            </a>
                        </th>
                        <td><?php echo $file->name; ?></td>
                        <td><?php echo $file->contentLength(); ?>B</td>
                        <td><?php echo $file->type; ?></td>
                        <td><?php echo ($file->visibleOnlyWithLink) ? 'vain linkillä' : 'julkinen'; ?></td>
                        <td><?php echo $file->createdAt; ?></td>
                        <td><?php echo $file->validUntil; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>