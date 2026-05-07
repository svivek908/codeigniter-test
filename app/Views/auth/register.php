<!DOCTYPE html>
<html>

<head>

<title>Register</title>

<link href=
"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-4">

<div class="card shadow">

<div class="card-header text-center">
<h4>Register</h4>
</div>

<div class="card-body">

<form method="post"
action="<?= base_url('register') ?>">

<?= csrf_field(); ?>

<div class="mb-3">

<label>Name</label>

<input type="text"
name="name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Password</label>

<input type="password"
name="password"
class="form-control"
required>

</div>

<button type="submit"
class="btn btn-success w-100">

Register

</button>

</form>

<div class="text-center mt-3">

<a href="<?= base_url('login') ?>">

Already have account?

</a>

</div>

</div>

</div>

</div>

</div>

</div>

</body>
</html>