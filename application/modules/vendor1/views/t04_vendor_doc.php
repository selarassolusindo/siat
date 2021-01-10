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
        <h2>T04_vendor List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kode</th>
		<th>Nama</th>
		<th>Alamat</th>
		<th>Kota</th>
		<th>Created At</th>
		<th>Updated At</th>
		
            </tr><?php
            foreach ($vendor1_data as $vendor1)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $vendor1->Kode ?></td>
		      <td><?php echo $vendor1->Nama ?></td>
		      <td><?php echo $vendor1->Alamat ?></td>
		      <td><?php echo $vendor1->Kota ?></td>
		      <td><?php echo $vendor1->created_at ?></td>
		      <td><?php echo $vendor1->updated_at ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>