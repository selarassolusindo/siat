<!doctype html>
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
        <h2 style="margin-top:0px">T11_so Read</h2>
        <table class="table">
	    <tr><td>NomorSO</td><td><?php echo $NomorSO; ?></td></tr>
	    <tr><td>Tanggal</td><td><?php echo $Tanggal; ?></td></tr>
	    <tr><td>Idcustomer</td><td><?php echo $idcustomer; ?></td></tr>
	    <tr><td>Idshipper</td><td><?php echo $idshipper; ?></td></tr>
	    <tr><td>Idarmada</td><td><?php echo $idarmada; ?></td></tr>
	    <tr><td>Asal</td><td><?php echo $Asal; ?></td></tr>
	    <tr><td>Tujuan</td><td><?php echo $Tujuan; ?></td></tr>
	    <tr><td>Driver</td><td><?php echo $Driver; ?></td></tr>
	    <tr><td>Created At</td><td><?php echo $created_at; ?></td></tr>
	    <tr><td>Updated At</td><td><?php echo $updated_at; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('salesorder') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>