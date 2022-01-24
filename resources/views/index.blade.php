<!doctype html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>Sample</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/style.min.css">
<style type="text/css">
    .active {
        display: block;
    }
    .inActive {
        display: none;
    }
</style>
</head>

<body class="theme-blush">
    
<!-- Overlay For Sidebars -->
<div class="overlay"></div>


<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Sample CRUD</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <h5><strong>Customer</h5>
                            <div class="row clearfix">
                                
                                <div class="col-md-12">
                                    <div id="message" class="alert" style="display: none" role="alert">
                                      
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="firstName" class="form-control" placeholder="First name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" id="lastName" class="form-control" placeholder="Last name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" id="age" maxlength="2" pattern="\d*" class="form-control" placeholder="Age">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" id="gender">
                                            <option data-id="1" >Male</option>
                                            <option data-id="2">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="Date" id="birthDate" class="form-control" placeholder="Birthdate">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" id="address" class="form-control" placeholder="Address">
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="active" id="buttonSave">
                                        <button type="submit" class="btn btn-success m-0" id="submitForm">
                                            Save  <span class="fa fa-spinner fa-spin"></span> </span>
                                        </button>
                                    </div>
                                    <div class="inActive" id="buttonUpdate">
                                        <button type="submit" class="btn btn-primary m-0" id="updateForm">
                                            Update  <span class="fa fa-spinner fa-spin"></span> </span>
                                        </button>
                                        <button type="submit" class="btn btn-danger m-0" id="cancelUpdate">
                                            Cancel  <span class="fa fa-spinner fa-spin"></span> </span>
                                        </button>
                                    </div>
                                </div>
                                <span id="hidden_id" hidden="hidden"></span>
                            </div>
                        </div>                            
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover c_table theme-color">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First name</th>
                                                <th>Last name</th>
                                                <th>Age</th>
                                                <th>Gender</th>
                                                <th>Address</th>
                                                <th>Birthdate</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> 

<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="assets/js/app.js"></script>
</body>


</html>