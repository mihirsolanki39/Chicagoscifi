<h2>Add/Delete Sources</h2>

<div class="form">

<?php echo form_open('sources/add');?>
    Name: 
    <?
$data = array(
'name'        => 'name',
'id'          => 'name',
'value'       => '',
'maxlength'   => '50',
'size'        => '50'
);
?>

<?php echo form_input($data);?>
&nbsp; &nbsp; &nbsp; &nbsp;
<?php echo form_submit('Go','Go');?>
<?php echo form_close();?>

</div>

<?$this->load->view('sources/list')?>
