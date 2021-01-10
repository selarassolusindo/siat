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
        <h2 style="margin-top:0px">T04_vendor List</h2> -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('vendor1/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('vendor1/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('vendor1'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kode</th>
		<th>Nama</th>
		<th>Alamat</th>
		<th>Kota</th>
		<!-- <th>Created At</th>
		<th>Updated At</th> -->
		<th>Action</th>
            </tr><?php
            foreach ($vendor1_data as $vendor1)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $vendor1->Kode ?></td>
			<td><?php echo $vendor1->Nama ?></td>
			<td><?php echo $vendor1->Alamat ?></td>
			<td><?php echo $vendor1->Kota ?></td>
			<!-- <td><?php echo $vendor1->created_at ?></td>
			<td><?php echo $vendor1->updated_at ?></td> -->
			<td style="text-align:center" width="200px">
				<?php
				echo anchor(site_url('vendor1/read/'.$vendor1->idvendor),'Read');
				echo ' | ';
				echo anchor(site_url('vendor1/update/'.$vendor1->idvendor),'Update');
				echo ' | ';
				echo anchor(site_url('vendor1/delete/'.$vendor1->idvendor),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('vendor1/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('vendor1/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    <!-- </body>
</html> -->
