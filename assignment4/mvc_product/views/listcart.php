<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect"   href="https://fonts.gstatic.com" />
    <link
            href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap"
            rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title>Giỏ hàng</title>
    <style>
        .form-group{
            margin: 0 0 20px 0;
        }
    </style>
</head>
<body>
<?php $ds = isset($_SESSION["cart"])?$_SESSION["cart"]:[]; $total = 0; ?>
<div class="container">
    <h1 class="text-center" style="margin: 20px 0; padding: 10px; background-color: rgb(13 110 253 / 25%) ;">Cart</h1>
    <a href="?route=listproduct"><button class="btn btn-secondary" style="margin: 20px 0">Sản Phẩm</button></a>
    <div class="row">
        <div class="col-md-8">
            <table class="table table-striped table-hover">
                <thead>
                <th>Id</th>
                <th>Tên Sản Phẩm</th>
                <th class="text-center">Giá</th>
                <th class="text-center">Số lượng</th>
                <th class="text-center">Subtotal</th>
                </thead>
                <tbody>
                <?php foreach ($ds as $item){ ?>
                    <tr>
                        <td><?php echo $item["id"]; ?></td>
                        <td><?php echo $item["name"]; ?></td>
                        <td class="text-center"><?php echo $item["price"]; ?></td>
                        <td class="text-center"><?php echo $item["qty"]; ?></td>
                        <td class="text-center"><?php $total += $item["price"] * $item["qty"]; echo  $item["price"] * $item["qty"]; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center">Tổng tiền: </td>
                    <td class="text-center"><?php echo $total; ?></td>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-4">
            <form action="?route=createorder" method="post">
                <div class="form-group">
                    <label>Tên khách hàng</label>
                    <input type="text" name="customer" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Sđt</label>
                    <input type="text" name="tel" class="form-control" />
                </div>
                <div class="form-group">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" class="form-control" />
                </div>
                <button type="submit" class="btn btn-success">Đặt hàng</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
