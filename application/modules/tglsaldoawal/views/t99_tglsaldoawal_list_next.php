<!-- <!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php //echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">T99_tglsaldoawal List</h2> -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo ($total_rows > 0 ? '' : anchor(site_url('tanggal-saldo-awal/create'),'Create', 'class="btn btn-primary"')); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('tglsaldoawal/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <!-- <input type="text" class="form-control" name="q" value="<?php //echo $q; ?>"> -->
                        <span class="input-group-btn">
                            <?php
                                if ($q <> '')
                                {
                                    ?>
                                    <!-- <a href="<?php //echo site_url('tglsaldoawal'); ?>" class="btn btn-default">Reset</a> -->
                                    <?php
                                }
                            ?>
                          <!-- <button class="btn btn-primary" type="submit">Search</button> -->
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table-sm table-bordered" style="margin-bottom: 10px">
            <tr>
        		<th>Tanggal</th>
        		<!-- <th>Created At</th>
        		<th>Updated At</th> -->
        		<th>Action</th>
            </tr>
            <?php
            foreach ($tglsaldoawal_data as $tglsaldoawal)
            {
            ?>
                <tr>
        			<td><?php echo date_format(date_create($tglsaldoawal->Tanggal), 'd/m/Y') ?></td>
        			<!-- <td><?php //echo $tglsaldoawal->created_at ?></td>
        			<td><?php //echo $tglsaldoawal->updated_at ?></td> -->
        			<td style="text-align:center">
        				<?php
        				//echo anchor(site_url('tglsaldoawal/read/'.$tglsaldoawal->idtgl),'Read');
        				//echo ' | ';
        				echo anchor(site_url('tanggal-saldo-awal/update/'.$tglsaldoawal->idtgl),'Update');
        				//echo ' | ';
        				//echo anchor(site_url('tglsaldoawal/delete/'.$tglsaldoawal->idtgl),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
        				?>
        			</td>
                </tr>
            <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="<?php echo site_url('saldo-awal'); ?>" class="btn btn-primary">Next</a>
            </div>
            <div class="col-md-6 text-right">
                <?php //echo $pagination ?>
            </div>
        </div>
    <!-- </body>
</html> -->
