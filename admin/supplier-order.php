<?php require_once('header.php'); ?>

<section class="content-header" xmlns="http://www.w3.org/1999/html">
    <div class="content-header-left">
        <h1>Purchase Order</h1>
    </div>
    <div class="content-header-right">
        <a href="supplier-all-orders.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="callout callout-success" style="display: none" id="success_block">
                <p>Supplier Order is added successfully!'</p>
            </div>
            <div class="box box-info">
                <div class="box-body">
                    <div class="row">
                        <form method="post" action="">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date"> Select Tools/Product </label>

                                    <select class="form-control select2" name="prod_name"
                                            tabindex="1" autofocus required id="selected_product">
                                        <option selected disabled value="">Select</option>
                                        <?php
                                        $i = 0;
                                        $statement = $pdo->prepare("select * from tbl_product  order by p_name");
                                        $statement->execute();
                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $row) {
                                            $i++;
                                            ?>
                                            <option value="<?php echo $row['p_id']; ?>"><?php echo $row['p_name'] . " Available(" . $row['p_qty'] . ")"; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-2">
                                <label for="date">Quantity</label>
                                <input type="number" class="form-control" min="0" name="qty"
                                       tabindex="2" value="1" required id="qty">
                            </div>

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label for="date">Select Supplier</label>

                                    <select class="form-control select2" name="supplier"
                                            tabindex="1" autofocus required id="selected_supplier">
                                        <option selected disabled value="">Select Supplier</option>
                                        <?php
                                        $i = 0;
                                        $statement = $pdo->prepare("select * from supplier  order by supplier_name");
                                        $statement->execute();
                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $row) {
                                            $i++;
                                            ?>
                                            <option value="<?php echo $row['supplier_id']; ?>"><?php echo $row['supplier_name']; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-1" style="margin-top: 23px;">
                                <label for=""> </label>
                                <button class="btn btn-small btn-success " type="button"
                                        tabindex="3"
                                        name="addtocart" id="addToCart">+
                                </button>
                            </div>


                            <div class="col-md-12">

                        </form>
                    </div>


                </div>
            </div>


            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>PID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Amount</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody id="tbl_purchase_order">
                </tbody>

            </table>
        </div>

        <div class="row" style="margin-left: 10px">
            <table class="table">
                <thead>
                <tr>
                    <th class="text-blue">Total Amount</th>
                    <th class="text-blue">Total Items</th>
                </tr>
                <tr>
                    <td class="text-bold text-muted" id="totalAmount">0.00</td>
                    <td class="text-bold text-muted" id="totalItems">0</td>
                </tr>
                </thead>
            </table>
        </div>

        <div class="row" style="margin-left: 5px;">
            <button class="btn btn-success" id="supplier_order_save" type="button">Save Order</button>
        </div>
    </div>

</section>

<?php require_once('footer.php'); ?>

<script>

    var totalAmount = 0;
    var totalCount = 0;

    var orderItems = [];

    $('#addToCart').click(function (e) {
        // e.preventDefault();
        totalAmount = 0;
        totalCount = 0;
        let selected_product = $('#selected_product').val();

        $.ajax({
            type: "POST",
            url: 'supplier_order_add.php',
            data: {
                p_id: selected_product
            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                // var jsonData = JSON.parse(response);
                if (response.success != []) {
                    let qty = $('#qty').val();
                    let res = response.success;
                    let button = "<button class=\"btn btn-xs btn-danger\" onclick=\"removeSelectedRow(" + res[0] + ") \"><i class=\"fa fa-trash\"></i></button>";
                    let row = "<tr id=" + res[0] + ">" +
                        "<td>" + res[0] + "</td>" +
                        "<td>" + res[1] + "</td>" +
                        "<td>" + res[2] + "</td>" +
                        "<td>" + qty + "</td>" +
                        "<td>" + res[2] * qty + "</td>" +
                        "<td>" + button + "</td>" +
                        "</tr>";
                    $('#tbl_purchase_order').append(row);
                    getAmountData();
                } else {
                    alert('Invalid Credentials!');
                }
            }
        })


    });

    function removeSelectedRow(tid) {
        $('#' + tid).remove();
        totalAmount = 0;
        totalCount = 0;
        getAmountData();
        $('#totalAmount').text(totalAmount.toFixed(2));
        $('#totalItems').text(totalCount);
    }

    function getAmountData() {
        orderItems = [];
        $("#tbl_purchase_order tr").each(function () {
            let currentRow = $(this);

            // var col1_value=currentRow.find("td:eq(0)").text();
            // var col2_value=currentRow.find("td:eq(1)").text();
            let pid = currentRow.find("td:nth-child(1)").text();
            let productName = currentRow.find("td:nth-child(2)").text();
            let price = currentRow.find("td:nth-child(3)").text();
            let col4_value = currentRow.find("td:nth-child(4)").text();
            let col5_value = currentRow.find("td:nth-child(5)").text();
            totalCount += Number(col4_value);
            totalAmount += Number(col5_value);

            $('#totalAmount').text(totalAmount.toFixed(2));
            $('#totalItems').text(totalCount);
            let itemObj = {
                pid: pid,
                productName: productName,
                price: price,
                qty: col4_value,
                amount: col5_value
            }
            orderItems.push(itemObj);
        });
    }

    $('#supplier_order_save').click(function (e) {

        let selected_supplier = $('#selected_supplier').val();
        console.log(selected_supplier);
        console.log(orderItems);


        $.ajax({
            type: "POST",
            url: 'supplier_order_add.php',
            data: {
                selected_supplier: selected_supplier,
                orderItems: orderItems,
                amount: totalAmount
            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response.success === "1") {
                    alert("Supplier Order Added.")
                    $('#success_block').css('display', 'block');
                    setTimeout(() => {
                        location.reload();

                    }, 2000)
                } else {
                    alert('Not Added.');
                }
            }
        })


    });

</script>
