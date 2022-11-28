<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
    $valid = 1;

    if(empty($_POST['supplier_name'])) {
        $valid = 0;
        $error_message .= 'Name can not be empty<br>';
    }

    if(empty($_POST['supplier_address'])) {
        $valid = 0;
        $error_message .= 'Address can not be empty<br>';
    }if(empty($_POST['supplier_contact'])) {
        $valid = 0;
        $error_message .= 'Contact can not be empty<br>';
    }if(empty($_POST['nic'])) {
        $valid = 0;
        $error_message .= 'Nic can not be empty<br>';
    }


    if($valid == 1) {


        $statement = $pdo->prepare("INSERT INTO supplier (`supplier_name`, `supplier_address`, `supplier_contact`, `NIC`) VALUES (?,?,?,?)");
        $statement->execute(array($_POST['supplier_name'],$_POST['supplier_address'],$_POST['supplier_contact'],$_POST['nic']));

        $success_message = 'Supplier is added successfully!';

        unset($_POST['supplier_name']);
        unset($_POST['supplier_address']);
        unset($_POST['supplier_contact']);
        unset($_POST['nic']);
    }
}
?>

    <section class="content-header">
        <div class="content-header-left">
            <h1>Add Supplier</h1>
        </div>
        <div class="content-header-right">
            <a href="suppliers.php" class="btn btn-primary btn-sm">View All</a>
        </div>
    </section>


    <section class="content">

        <div class="row">
            <div class="col-md-12">

                <?php if($error_message): ?>
                    <div class="callout callout-danger">
                        <p>
                            <?php echo $error_message; ?>
                        </p>
                    </div>
                <?php endif; ?>

                <?php if($success_message): ?>
                    <div class="callout callout-success">
                        <p><?php echo $success_message; ?></p>
                    </div>
                <?php endif; ?>

                <form class="form-horizontal" action="" method="post">
                    <div class="box box-info">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Supplier Name <span>*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" autocomplete="off" class="form-control" name="supplier_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Supplier Address <span>*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" autocomplete="off" class="form-control" name="supplier_address" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Supplier Contact</label>
                                <div class="col-sm-6">
                                    <input type="text" autocomplete="off" class="form-control" name="supplier_contact" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Supplier NIC</label>
                                <div class="col-sm-6">
                                    <input type="text" autocomplete="off" class="form-control" name="nic">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label"></label>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>

<?php require_once('footer.php'); ?>
