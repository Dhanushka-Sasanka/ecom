<?php require_once('header.php'); ?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View Purchase Orders</h1>
    </div>
    <div class="content-header-right">
        <a href="supplier-order.php" class="btn btn-primary btn-sm">Add Purchase Order</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="30">SupplierID</th>
                            <th>Name</th>
                            <th width="100">OrderID</th>
                            <th>Date AND Time</th>
                            <th width="80">Amount</th>
                            <th width="80">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        $statement = $pdo->prepare("SELECT * FROM supplier s , supplier_order so WHERE s.supplier_id = so.supplier_id ORDER BY so.sup_order_id");
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $row) {
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $row['supplier_id']; ?></td>
                                <td><?php echo $row['supplier_name']; ?></td>
                                <td><?php echo $row['sup_order_id']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['amount']; ?></td>
                                <td>
                                    <a href="#" class="btn btn-danger btn-xs"
                                       data-href="supplier-order-delete.php?id=<?php echo $row['sup_order_id']; ?>"
                                       data-toggle="modal" data-target="#confirm-delete">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this item?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>
