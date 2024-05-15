<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"><?= $title; ?></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('atmin'); ?>">Data Atmin</a></li>
						<li class="breadcrumb-item active">Edit Atmin</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="card card-secondary">
						<div class="card-header">
							<h3 class="card-title">Form Edit Atmin</h3>
						</div>
						<div class="card-body">
							<form action="<?= base_url('atmin/update'); ?>" method="post">
								<input type="hidden" name="id" value="<?php echo $atmin->id; ?>">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" class="form-control" value="<?php echo $atmin->username; ?>">
									<span class="text-danger"><?php echo form_error('username'); ?></span>
								</div>
								<div class="form-group">
									<label>Nama</label>
									<input type="text" name="nama" class="form-control" value="<?php echo $atmin->nama; ?>">
									<span class="text-danger"><?php echo form_error('nama'); ?></span>
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" name="email" class="form-control" value="<?php echo $atmin->email; ?>">
									<span class="text-danger"><?php echo form_error('email'); ?></span>
								</div>
								<div class="form-group">
									<label>NoHP</label>
									<input type="text" name="nohp" class="form-control" value="<?php echo $atmin->nohp; ?>">
									<span class="text-danger"><?php echo form_error('nohp'); ?></span>
								</div>
								<button type="submit" class="btn btn-success">Simpan</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>