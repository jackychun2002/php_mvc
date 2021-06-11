<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap"
        rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title><?php echo $title ?></title>
</head>
<body>
<div class="container">
    <h2 style="margin-top: 20px; padding: 10px 0; border-bottom: 2px solid cadetblue;" ><?php echo $title ?></h2>
    <form style="margin-top: 40px" class="row g-3 needs-validation" action="?route=saveproduct" method="post" novalidate>
        <input type="hidden" name="id" value="<?php echo $pr["id"]; ?>" />
        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Tên Sản Phẩm</label>
            <input name="name" type="text" class="form-control" id="validationCustom01" value="<?php echo $pr["name"]; ?>" required />
            <div class="invalid-feedback">
                Please enter name.
            </div>
        </div>
        <div class="col-md-4">
            <label for="validationCustom02" class="form-label">Giá</label>
            <input name="price" type="text" class="form-control" id="validationCustom02" value="<?php echo $pr["price"]; ?>" required />
            <div class="invalid-feedback">
                Please enter price.
            </div>
        </div>
        <div class="col-md-4">
            <label for="validationCustom04" class="form-label">Nhà Cung Cấp</label>
            <select name="ncc" class="form-select" id="validationCustom04" required>
                <option><?php echo $pr["ncc"]; ?></option>
                <option>Apple</option>
                <option>Samsung</option>
                <option>Oppo</option>
                <option>Nokia</option>
                <option>Huawei</option>
            </select>
            <div class="invalid-feedback">
                Please select a supplier.
            </div>
        </div>
        <div class="col-md-12">
            <label for="validationCustom03" class="form-label">Mô tả</label>
            <textarea name="painted" rows="5" class="form-control" id="validationCustom03"><?php echo $pr["painted"]; ?></textarea>
        </div>
        <div class="col-12">
            <button class="btn btn-success" type="submit">Lưu</button>
        </div>
    </form>
</div>
</body>
<script>
    (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
</html>
