<div class='container'>
    <div class='row'>
        <div class='col-md-8'>
            <?php foreach ($items as $item): ?>
                <h5>
                    <p class='small'><?php echo date("j.n.Y H:i", (int) $item->date) ?></p>
                    <a href="<?php echo htmlSpecialChars($item->link) ?>">
                        <?php echo htmlSpecialChars($item->title) ?>
                    </a>
                </h5>
                <hr/>
            <?php endforeach; ?>
        </div>
        <div class='col-md-4'>
            <?php foreach ($items as $item): ?>
                <h6>
                    <p class='small'><?php echo date("j.n.Y H:i", (int) $item->date) ?></p>
                    <a href="<?php echo htmlSpecialChars($item->link) ?>">
                        <?php echo htmlSpecialChars($item->title) ?>
                    </a>
                </h6>
                <hr/>
            <?php endforeach; ?>
        </div>
    </div>
</div>    

