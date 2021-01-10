<!-- <!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">T05_armada <?php echo $button ?></h2> -->
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Kode <?php echo form_error('Kode') ?></label>
            <input type="text" class="form-control" name="Kode" id="Kode" placeholder="Kode" value="<?php echo $Kode; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Merk <?php echo form_error('Merk') ?></label>
            <input type="text" class="form-control" name="Merk" id="Merk" placeholder="Merk" value="<?php echo $Merk; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nopol <?php echo form_error('Nopol') ?></label>
            <input type="text" class="form-control" name="Nopol" id="Nopol" placeholder="Nopol" value="<?php echo $Nopol; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Norangka <?php echo form_error('Norangka') ?></label>
            <input type="text" class="form-control" name="Norangka" id="Norangka" placeholder="Norangka" value="<?php echo $Norangka; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nomesin <?php echo form_error('Nomesin') ?></label>
            <input type="text" class="form-control" name="Nomesin" id="Nomesin" placeholder="Nomesin" value="<?php echo $Nomesin; ?>" />
        </div>
	    <!-- <div class="form-group">
            <label for="timestamp">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Updated At <?php echo form_error('updated_at') ?></label>
            <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" />
        </div> -->
	    <input type="hidden" name="idarmada" value="<?php echo $idarmada; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('armada') ?>" class="btn btn-default">Cancel</a>
	</form>
    <!-- </body>
</html> -->
