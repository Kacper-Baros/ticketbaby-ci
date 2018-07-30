<?php include('includes/header.php'); ?>

<div class="page-container">

    <?php include('includes/sidebar.php'); ?>

    <div class="page-content">

    <?php include('includes/breadcums.php'); ?>    

    <?php 
            if(isset($main)){
                $this->load->view('admin/'.$main);
            }else{
                $this->load->view('admin/dashboard');
            }
    ?>        


 <?php include('includes/footer.php'); ?>