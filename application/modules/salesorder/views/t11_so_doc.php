<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>T11_so List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>NomorSO</th>
		<th>Tanggal</th>
		<th>Idcustomer</th>
		<th>Idshipper</th>
		<th>Idarmada</th>
		<th>Asal</th>
		<th>Tujuan</th>
		<th>Driver</th>
		<th>Harga</th>
		<th>Created At</th>
		<th>Updated At</th>
		
            </tr><?php
            foreach ($salesorder_data as $salesorder)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $salesorder->NomorSO ?></td>
		      <td><?php echo $salesorder->Tanggal ?></td>
		      <td><?php echo $salesorder->idcustomer ?></td>
		      <td><?php echo $salesorder->idshipper ?></td>
		      <td><?php echo $salesorder->idarmada ?></td>
		      <td><?php echo $salesorder->Asal ?></td>
		      <td><?php echo $salesorder->Tujuan ?></td>
		      <td><?php echo $salesorder->Driver ?></td>
		      <td><?php echo $salesorder->Harga ?></td>
		      <td><?php echo $salesorder->created_at ?></td>
		      <td><?php echo $salesorder->updated_at ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>