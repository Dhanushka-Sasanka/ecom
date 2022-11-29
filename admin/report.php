<?php require_once('header.php'); ?>

<?php

if(isset($_POST['form_about'])) {
    
    $valid = 1;

    if(empty($_POST['about_title'])) {
        $valid = 0;
        $error_message .= 'Title can not be empty<br>';
    }

    if(empty($_POST['about_content'])) {
        $valid = 0;
        $error_message .= 'Content can not be empty<br>';
    }

    $path = $_FILES['about_banner']['name'];
    $path_tmp = $_FILES['about_banner']['tmp_name'];

    if($path != '') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {

        if($path != '') {
            // removing the existing photo
            $statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
            foreach ($result as $row) {
                $about_banner = $row['about_banner'];
                unlink('../assets/uploads/'.$about_banner);
            }

            // updating the data
            $final_name = 'about-banner'.'.'.$ext;
            move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_page SET about_title=?,about_content=?,about_banner=?,about_meta_title=?,about_meta_keyword=?,about_meta_description=? WHERE id=1");
            $statement->execute(array($_POST['about_title'],$_POST['about_content'],$final_name,$_POST['about_meta_title'],$_POST['about_meta_keyword'],$_POST['about_meta_description']));
        } else {
            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_page SET about_title=?,about_content=?,about_meta_title=?,about_meta_keyword=?,about_meta_description=? WHERE id=1");
            $statement->execute(array($_POST['about_title'],$_POST['about_content'],$_POST['about_meta_title'],$_POST['about_meta_keyword'],$_POST['about_meta_description']));
        }

        $success_message = 'About Page Information is updated successfully.';
        
    }
    
}



if(isset($_POST['form_faq'])) {
    
    $valid = 1;

    if(empty($_POST['faq_title'])) {
        $valid = 0;
        $error_message .= 'Title can not be empty<br>';
    }

    $path = $_FILES['faq_banner']['name'];
    $path_tmp = $_FILES['faq_banner']['tmp_name'];

    if($path != '') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {

        if($path != '') {
            // removing the existing photo
            $statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
            foreach ($result as $row) {
                $faq_banner = $row['faq_banner'];
                unlink('../assets/uploads/'.$faq_banner);
            }

            // updating the data
            $final_name = 'faq-banner'.'.'.$ext;
            move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_page SET faq_title=?,faq_banner=?,faq_meta_title=?,faq_meta_keyword=?,faq_meta_description=? WHERE id=1");
            $statement->execute(array($_POST['faq_title'],$final_name,$_POST['faq_meta_title'],$_POST['faq_meta_keyword'],$_POST['faq_meta_description']));
        } else {
            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_page SET faq_title=?,faq_meta_title=?,faq_meta_keyword=?,faq_meta_description=? WHERE id=1");
            $statement->execute(array($_POST['faq_title'],$_POST['faq_meta_title'],$_POST['faq_meta_keyword'],$_POST['faq_meta_description']));
        }

        $success_message = 'FAQ Page Information is updated successfully.';
        
    }
    
}



if(isset($_POST['form_contact'])) {
    
    $valid = 1;

    if(empty($_POST['contact_title'])) {
        $valid = 0;
        $error_message .= 'Title can not be empty<br>';
    }

    $path = $_FILES['contact_banner']['name'];
    $path_tmp = $_FILES['contact_banner']['tmp_name'];

    if($path != '') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {

        if($path != '') {
            // removing the existing photo
            $statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
            foreach ($result as $row) {
                $contact_banner = $row['contact_banner'];
                unlink('../assets/uploads/'.$contact_banner);
            }

            // updating the data
            $final_name = 'contact-banner'.'.'.$ext;
            move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_page SET contact_title=?,contact_banner=?,contact_meta_title=?,contact_meta_keyword=?,contact_meta_description=? WHERE id=1");
            $statement->execute(array($_POST['contact_title'],$final_name,$_POST['contact_meta_title'],$_POST['contact_meta_keyword'],$_POST['contact_meta_description']));
        } else {
            // updating the database
            $statement = $pdo->prepare("UPDATE tbl_page SET contact_title=?,contact_meta_title=?,contact_meta_keyword=?,contact_meta_description=? WHERE id=1");
            $statement->execute(array($_POST['contact_title'],$_POST['contact_meta_title'],$_POST['contact_meta_keyword'],$_POST['contact_meta_description']));
        }

        $success_message = 'Contact Page Information is updated successfully.';
        
    }
    
}


?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Reports</h1>
    </div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_page WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);                           
foreach ($result as $row) {
    $about_title = $row['about_title'];
    $about_content = $row['about_content'];
    $about_banner = $row['about_banner'];
    $about_meta_title = $row['about_meta_title'];
    $about_meta_keyword = $row['about_meta_keyword'];
    $about_meta_description = $row['about_meta_description'];
    $faq_title = $row['faq_title'];
    $faq_banner = $row['faq_banner'];
    $faq_meta_title = $row['faq_meta_title'];
    $faq_meta_keyword = $row['faq_meta_keyword'];
    $faq_meta_description = $row['faq_meta_description'];
    $contact_title = $row['contact_title'];
    $contact_banner = $row['contact_banner'];
    $contact_meta_title = $row['contact_meta_title'];
    $contact_meta_keyword = $row['contact_meta_keyword'];
    $contact_meta_description = $row['contact_meta_description'];

}
?>



<section class="content">

    <div class="row">
        <div class="col-md-12">
                            
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Customer Info</a></li>
                        <li><a href="#tab_5" data-toggle="tab">Yearly Sales</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Daily Sales</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Payment Info</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Stock Info</a></li>
                        <li><a href="#tab_6" data-toggle="tab">Supplier Info</a></li>

                    </ul>

                    <!-- Report Page Content -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-info">
                                            <div class="box-body">

                                                <h4>Customer Information</h4>

                                                <form method="post" action="#">
                                                    <a href="CustomerAllReports.php" target="_blank" class="btn btn-success">Generate PDF</a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                        </div>

        <!-- FAQ Page Content -->

                        <div class="tab-pane" id="tab_2">

                            <div class="box box-info">
                                <div class="box-body">
                                    <h4>Daily Sales</h4>
                                    <form method="post" action="daily-sales-report.php">

                                        <div class="input-group input-daterange">
                                            <label for="start_date">Select Date</label>
                                            <input type="date" class="form-control" name="daily_start_date" id="start_date"
                                                   required>

                                        </div>
                                        <button type="submit" formtarget="_blank" name="dailySalesBtn" class="btn btn-success" style="margin-top: 10px">Generate PDF</button>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab_3">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <h4>Payment Info</h4>

                                        <form method="post" action="#">
                                            <a href="payment-details-report.php" target="_blank" class="btn btn-success">Generate PDF</a>
                                        </form>
                                    </div>
                                </div>
                        </div>

                        <div class="tab-pane" id="tab_4">
                            <div class="box box-info">
                                <div class="box-body">
                                    <h4>Stock Details Report</h4>
                                    <form method="post" action="#">
                                        <a href="stock-report.php" target="_blank" class="btn btn-success">Generate PDF</a>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane" id="tab_5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-info">
                                        <div class="box-body">


                                            <h4>Yearly Sales</h4>
                                            <form method="post" action="yearly-wise-sales-report.php">

                                                <div class="input-group input-daterange">
                                                    <label for="start_date">Start Date</label>
                                                    <input type="date" class="form-control" name="year_sales_start_date" id="start_date"
                                                    required>
                                                    <div class="input-group-addon" style="border: none">TO</div>
                                                    <label for="end_date">End Date</label>
                                                    <input type="date" class="form-control " name="year_sales_end_date"  id="end_date" required>
                                                </div>
                                                <button type="submit" formtarget="_blank" name="yearSalesBtn" class="btn btn-success" style="margin-top: 10px">Generate PDF</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="tab-pane" id="tab_6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-info">
                                        <div class="box-body">

                                            <h4>Supplier Details</h4>

                                            <form method="post" action="#">
                                                <a href="supplier-all-report.php" target="_blank" class="btn btn-success">Generate PDF</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                

            </form>
        </div>
    </div>

</section>

<?php require_once('footer.php'); ?>



