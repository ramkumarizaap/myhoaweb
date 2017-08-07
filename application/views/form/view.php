<style type="text/css" src="<?=base_url();?>assets/css/bootstrap.min.css" ></style>
<div class="container">
	<?php
	if($this->session->flashdata('form_succ')==TRUE)
	{
		?>
		<div class="msg">
			<strong>Form Submitted Successfully!!!</strong>
		</div>
		<?php 
	}
	?>
	<form class="form-horizontal" method="post" action="<?=base_url();?>form/form_action" enctype="multipart/form-data">
	<input type="hidden" name="form_id" value="<?=$form_id;?>">
		<ul class="view-form">
			<?=showform($form_id);?>
		</ul>
	</form>
</div>
<style type="text/css">
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
	.container
	{
		width: 75%;
		margin: 0 auto;
		display: table;
		margin-bottom: 50px;
	}
	h3
	{
		text-align: center;
		font-size: 24px;
	}
	h4
	{
		font-size: 20px;
		color: #555;
	}
	ul.view-form
	{
		list-style: none;
	}
    ul.view-form li
    {
        width: 100%;
        display: inline-block;
    }
	.form-horizontal .form-group {
    margin-right: -15px;
    margin-left: -15px;
    margin-bottom: 15px;
    width: 100%;
    display: table;
}
.form-horizontal .control-label {
    padding-top: 7px;
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
    margin-bottom: 0;
    text-align: left;
}

.form-control 
{
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
textarea
{
	height: 100px !important;
}
.col-md-10 
{
  width: 83.33333333%;
  float: left;
  position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}
.col-md-12
{
	width: 100%;
	float: left;
	position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}
.col-md-3 {
    width: 25%;
     float: left;
  position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}
.col-md-9 {
    width: 75%;
     float: left;
  position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}
.col-md-2 
{
  width: 16.66666667%;
  float: left;
  position: relative;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}
.btn-group-vertical>.btn-group:after, .btn-group-vertical>.btn-group:before, .btn-toolbar:after, .btn-toolbar:before, .clearfix:after, .clearfix:before, .container-fluid:after, .container-fluid:before, .container:after, .container:before, .dl-horizontal dd:after, .dl-horizontal dd:before, .form-horizontal .form-group:after, .form-horizontal .form-group:before, .modal-footer:after, .modal-footer:before, .modal-header:after, .modal-header:before, .nav:after, .nav:before, .navbar-collapse:after, .navbar-collapse:before, .navbar-header:after, .navbar-header:before, .navbar:after, .navbar:before, .pager:after, .pager:before, .panel-body:after, .panel-body:before, .row:after, .row:before {
    display: table;
    content: " ";
}
:after, :before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.btn-group-vertical>.btn-group:after, .btn-toolbar:after, .clearfix:after, .container-fluid:after, .container:after, .dl-horizontal dd:after, .form-horizontal .form-group:after, .modal-footer:after, .modal-header:after, .nav:after, .navbar-collapse:after, .navbar-header:after, .navbar:after, .pager:after, .panel-body:after, .row:after
 {
    display: table;
    content: " ";
}
.theme-blue
{
	background: #193670;
	color: white;
	width: auto;
	border-radius:0;

}
.col-md-offset-4 {
    margin-left: 41.66666667%;
}
.msg
{
	text-align: center;
	border:3px solid #25bd25;
	color: #25bd25;
	padding: 10px;
}
</style>