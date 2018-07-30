<h2><?php echo $title ?></h2>

<?php foreach ($events as $events_item): ?>

        <h3><?php echo $events_item['title'] ?></h3>
        <div class="main">
                <?php echo $events_item['details'] ?>
        </div>
        <p><a href="index.php/event/<?php echo $events_item['slug'] ?>">View event</a></p>

<?php endforeach ?>