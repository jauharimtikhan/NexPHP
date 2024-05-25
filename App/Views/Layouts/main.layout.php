<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>NexPHP</title>
</head>

<body>
    <!-- Navbar NexPHP Anda Bisa Melakukan Laayouting dari file ini-->
    <?php
    global $app;
    include $app::$ROOT_DIR . '/App/Views/Layouts/navbar.layout.php';
    ?>
    <!-- End Navbar -->
    <div class="container py-5">
        {{content}} <!-- Sintaks Ini Wajib Untuk Merender Halaman Lain -->

    </div>
    <footer class="fixed-bottom">
        <p class="text-center  bg-light text-muted">© 2024 Copyright By <a href="https://nexphp.com" target="_blank">NexPHP</a></p>
    </footer>
    <!-- Optional JavaScript -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>