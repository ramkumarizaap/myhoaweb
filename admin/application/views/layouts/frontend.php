<!DOCTYPE HTML>
<html>
	<head>
		
	    <!-- <link rel="icon" href="/favicon.ico" type="image/x-icon"> -->
		<?php include_title(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <?php include_metas(); ?>
        <?php include_links(); ?>
        <?php include_stylesheets(); ?>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
         <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <?php include_raws() ?>
        
       <script>
			//declare global JS variables here
			var base_url = '<?php echo base_url();?>';
			var current_controller = '<?php echo $this->uri->segment(1, 'index');?>';
			var current_method = '<?php echo $this->uri->segment(2, 'index');?>';
            var folder_path = '<?php echo include_img_path(); ?>';			
		</script>
       
        
	</head>


	<body class="page-body login-page login-form-fall" >
	<?php 
	$url = $this->uri->segment(1);
	if($url!="")
	{
		?>
		<div class="page-container">
			<?php $this->load->view('includes/side_menu', $this->data); ?>
				<div class="main-content">
				<?php $this->load->view('includes/header', $this->data); ?>
		<?php
	}
	?>
		
		<?php /*echo $this->load->view('frontend/_partials/menu', $this->data); */ ?>

		<div class="wrapper-iframe">
			<?php echo $content; ?>
		</div>
		
		<?php /*
			$this->data['settings'] = $this->settings;
			$this->data['interests'] = $this->interests;
			$this->data['options'] = $this->options;
            if($this->settings['general']['enabled'])
			$this->data['contact_form'] = $this->load->view('frontend/_partials/contact_form', $this->data, TRUE);
            else
            $this->data['contact_form'] ="";
		*/?>

		<?php 
			if($url!="")
			{
				$this->load->view('includes/footer', $this->data);
			}
		?>
	</div>
		

		<?php include_javascripts(); ?>
		
		<?php 
		
			if(is_array($this->init_scripts))
			{
				foreach ($this->init_scripts as $file)
					$this->load->view($file, $this->data);
			}
			
		?>
		
		<script type="text/javascript" src="http://www.google.com/coop/cse/brand?form=cse-search-box&lang=en"></script>
	</body>
</html>
