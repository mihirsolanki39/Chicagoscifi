<h2>Add/Delete Categories</h2>

<div class="form">

<?php echo form_open('categories/add_category');?>
Name:

<?
$data = array(
'name'        => 'name',
'id'          => 'name',
'value'       => '',
'maxlength'   => '20',
'size'        => '20'
);
?>

<?php echo form_input($data);?>

    &nbsp; &nbsp; &nbsp; &nbsp; 
    Type: <?php echo form_dropdown('category_type',$category_types);?>
&nbsp; &nbsp; &nbsp; &nbsp;
<?php echo form_submit('Go','Go');?>
<?php echo form_close();?>

</div>

<?$this->load->view('categories/list')?>
