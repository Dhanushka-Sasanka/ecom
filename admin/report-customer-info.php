
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body>
<section>
    <div class="row  col-md-12 ">
        <img class="" src="logo.png" alt="logo image">
    </div>
    <h2>Customer Info</h2>

    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th width="30">SL</th>
            <th width="180">Name</th>
            <th width="180">Email Address</th>
            <th width="180">Country, City, State</th>
            <th>Status</th>
            <th width="100">Change Status</th>
            <th width="100">Action</th>
        </tr>
        </thead>
<!--                <tbody>-->
<!--                --><?php
//                $i=0;
//                $statement = $pdo->prepare("SELECT *
//        														FROM tbl_customer t1
//        														JOIN tbl_country t2
//        														ON t1.cust_country = t2.country_id
//        													");
//                $statement->execute();
//                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
//                foreach ($result as $row) {
//                    $i++;
//                    ?>
<!--                    <tr class="--><?php //if($row['cust_status']==1) {echo 'bg-g';}else {echo 'bg-r';} ?><!--">-->
<!--                        <td>--><?php //echo $i; ?><!--</td>-->
<!--                        <td>--><?php //echo $row['cust_name']; ?><!--</td>-->
<!--                        <td>--><?php //echo $row['cust_email']; ?><!--</td>-->
<!--                        <td>-->
<!--                            --><?php //echo $row['country_name']; ?><!--<br>-->
<!--                            --><?php //echo $row['cust_city']; ?><!--<br>-->
<!--                            --><?php //echo $row['cust_state']; ?>
<!--                        </td>-->
<!--                        <td>--><?php //if($row['cust_status']==1) {echo 'Active';} else {echo 'Inactive';} ?><!--</td>-->
<!--                        <td>-->
<!--                            <a href="customer-change-status.php?id=--><?php //echo $row['cust_id']; ?><!--" class="btn btn-success btn-xs">Change Status</a>-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            <a href="#" class="btn btn-danger btn-xs" data-href="customer-delete.php?id=--><?php //echo $row['cust_id']; ?><!--" data-toggle="modal" data-target="#confirm-delete">Delete</a>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    --><?php
//                }
//                ?>
<!--                </tbody>-->

        <tbody>
        <td style="align-items: center">12503</td>
        <td style="align-items: center" >Dhanushka</td>
        <td style="align-items: center">dhanushka@gmail.com</td>
        <td style="align-items: center" >Galle</td>
        <td style="align-items: center">Active</td>
        </tbody>
    </table>
</section>
</body>
</html>

