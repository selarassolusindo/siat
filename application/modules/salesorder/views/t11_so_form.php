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
        <h2 style="margin-top:0px">T11_so <?php echo $button ?></h2> -->
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">No. Sales Order <?php echo form_error('NomorSO') ?></label>
            <input type="text" class="form-control" name="NomorSO" id="NomorSO" placeholder="NomorSO" value="<?php echo $NomorSO; ?>" />
        </div>
	    <!-- <div class="form-group">
            <label for="date">Tanggal <?php echo form_error('Tanggal') ?></label>
            <input type="text" class="form-control" name="Tanggal" id="Tanggal" placeholder="Tanggal" value="<?php echo $Tanggal; ?>" />
        </div> -->
        <div class="form-group">
            <!-- <label for="date">Tanggal <?php echo form_error('Tanggal') ?></label> -->
            <!-- <input type="text" class="form-control" name="Tanggal" id="Tanggal" placeholder="Tanggal" value="<?php //echo $Tanggal; ?>" /> -->
            <!-- <label>Date:</label> -->
            <label for="date">Tanggal <?php echo form_error('Tanggal') ?></label>
            <div class="col-sm-2 input-group date" id="reservationdate" data-target-input="nearest">
                <input type="text" name="Tanggal" value="<?php echo $Tanggal; ?>" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
	    <div class="form-group">
            <label for="int">Customer <?php echo form_error('idcustomer') ?></label>
            <!-- <input type="text" class="form-control" name="idcustomer" id="idcustomer" placeholder="Idcustomer" value="<?php echo $idcustomer; ?>" /> -->
            <select name="idcustomer" class="form-control">
				<option value="">Customer</option>
				<?php
				foreach($customer_data as $customer)
				{
					$selected = ($customer->idcustomer == $idcustomer) ? ' selected="selected"' : "";

					echo '<option value="'.$customer->idcustomer.'" '.$selected.'>'.$customer->Nama .'</option>';
				}
				?>
			</select>
        </div>
	    <div class="form-group">
            <label for="int">Shipper <?php echo form_error('idshipper') ?></label>
            <!-- <input type="text" class="form-control" name="idshipper" id="idshipper" placeholder="Idshipper" value="<?php echo $idshipper; ?>" /> -->
            <select name="idshipper" class="form-control">
				<option value="">Shipper</option>
				<?php
				foreach($shipper_data as $shipper)
				{
					$selected = ($shipper->idshipper == $idshipper) ? ' selected="selected"' : "";

					echo '<option value="'.$shipper->idshipper.'" '.$selected.'>'.$shipper->Nama .'</option>';
				}
				?>
			</select>
        </div>
	    <div class="form-group">
            <label for="int">Armada <?php echo form_error('idarmada') ?></label>
            <!-- <input type="text" class="form-control" name="idarmada" id="idarmada" placeholder="Idarmada" value="<?php echo $idarmada; ?>" /> -->
            <select name="idarmada" class="form-control">
				<option value="">Armada</option>
				<?php
				foreach($armada_data as $armada)
				{
					$selected = ($armada->idarmada == $idarmada) ? ' selected="selected"' : "";

					echo '<option value="'.$armada->idarmada.'" '.$selected.'>'.$armada->Merk . ' - ' . $armada->Nopol . '</option>';
				}
				?>
			</select>
        </div>
	    <div class="form-group">
            <label for="Asal">Asal <?php echo form_error('Asal') ?></label>
            <textarea class="form-control" rows="3" name="Asal" id="Asal" placeholder="Asal"><?php echo $Asal; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="Tujuan">Tujuan <?php echo form_error('Tujuan') ?></label>
            <textarea class="form-control" rows="3" name="Tujuan" id="Tujuan" placeholder="Tujuan"><?php echo $Tujuan; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Driver <?php echo form_error('Driver') ?></label>
            <input type="text" class="form-control" name="Driver" id="Driver" placeholder="Driver" value="<?php echo $Driver; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Harga <?php echo form_error('Harga') ?></label>
            <input type="text" class="form-control" name="Harga" id="Harga" placeholder="Harga" value="<?php echo $Harga; ?>" />
        </div>
	    <!-- <div class="form-group">
            <label for="timestamp">Created At <?php echo form_error('created_at') ?></label>
            <input type="text" class="form-control" name="created_at" id="created_at" placeholder="Created At" value="<?php echo $created_at; ?>" />
        </div>
	    <div class="form-group">
            <label for="timestamp">Updated At <?php echo form_error('updated_at') ?></label>
            <input type="text" class="form-control" name="updated_at" id="updated_at" placeholder="Updated At" value="<?php echo $updated_at; ?>" />
        </div> -->
	    <input type="hidden" name="idso" value="<?php echo $idso; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('sales-order') ?>" class="btn btn-default">Cancel</a>
	</form>
    <!-- </body>
</html> -->
