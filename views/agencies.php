<h2>Agencies</h2>
<div class="agency-grid">
    <?php foreach($agencies as $agency) { ?>
        <div class="agency-card">
            <img src="<?php echo $agency['profile_picture']; ?>" alt="<?php echo $agency['name']; ?>">
            <h3><?php echo $agency['name']; ?></h3>
            <p><?php echo $agency['email']; ?></p>
            <p><?php echo $agency['phone']; ?></p>
            <p><?php echo $agency['address']; ?></p>
        </div>
    <?php } ?>
</div>