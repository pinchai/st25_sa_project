<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
            crossorigin="anonymous"></script>
    <title>Register Product</title>
</head>
<body>
<div class="container">
    <div class="row">
        @include('navbar')

        <div class="col-12">
            <form method="post" action="/do-register-product">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Name</label>
                        <input required type="text" class="form-control" id="name" name="name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="cost">Cost</label>
                        <input  required type="number" class="form-control" id="cost" name="cost">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="price">Price</label>
                        <input required type="number" class="form-control" id="price" name="price">
                    </div>
                </div>
                <button type="reset" class="btn btn-danger float-left">Clear</button>
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
