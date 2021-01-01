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
        <h2>T01_company List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama</th>
		<th>Alamat</th>
		<th>Kota</th>
		<th>Group Kode</th>
		<th>Created At</th>
		<th>Updated At</th>
		
            </tr><?php
            foreach ($company_data as $company)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $company->Nama ?></td>
		      <td><?php echo $company->Alamat ?></td>
		      <td><?php echo $company->Kota ?></td>
		      <td><?php echo $company->Group_Kode ?></td>
		      <td><?php echo $company->created_at ?></td>
		      <td><?php echo $company->updated_at ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>