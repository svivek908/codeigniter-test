<!DOCTYPE html>
<html>

<head>

<title>Login</title>

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
<h4>Login</h4>
</div>

<div class="card-body">

<?php if(session()->getFlashdata('error')): ?>

<div class="alert alert-danger">

<?= session()->getFlashdata('error') ?>

</div>

<?php endif; ?>

<form method="post"
action="<?= base_url('login') ?>">

<?= csrf_field(); ?>

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
class="btn btn-primary w-100">

Login

</button>

</form>

<div class="text-center mt-3">

<a href="<?= base_url('register') ?>">

Create Account

</a>

</div>

</div>

</div>

</div>

</div>

</div>

</body>
</html>