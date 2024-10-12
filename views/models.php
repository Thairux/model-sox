<h2>Models</h2>
<div class="model-grid">
    <?php foreach($models as $model) { ?>
        <div class="model-card">
            <img src="<?php echo $model['profile_picture']; ?>" alt="<?php echo $model['name']; ?>">
            <h3><?php echo $model['name']; ?></h3>
            <p><?php echo $model['email']; ?></p>
            <p><?php echo $model['phone']; ?></p>
            <p><?php echo $model['address']; ?></p>
        </div>
    <?php } ?>
</div>