<?php
include "../../../dbconnect.php";
if(isset($_POST['company'])){

}
?>
<html>
    <head>
        <link href="/HPV/build/css/custom.min.css" rel="stylesheet">
        <link href="/HPV/build/css/added_style.css" rel="stylesheet">
    </head>
</html>
<body>
<div class="x_content">
    <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
        <div class="row">
        </div>
        <div class="row"><div class="col-sm-12">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                    <thead>
                    <tr role="row">

                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 79.8889px;" aria-sort="ascending" aria-label="First name: activate to sort column descending">Actions
                        </th>

                        <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 84.8889px;" aria-label="Last name: activate to sort column ascending">Payment Request No
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 84.8889px;" aria-label="Last name: activate to sort column ascending">Date Submitted
                        </th>

                        <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 84.8889px;" aria-label="Last name: activate to sort column ascending">Company
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 182.889px;" aria-label="Position: activate to sort column ascending">Requested By
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 81.8889px;" aria-label="Office: activate to sort column ascending">Amount
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 80px;" aria-label="E-mail: activate to sort column ascending">Status
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Fetch data from database -->


                                <tr role="row" class="odd">

                                    <td> <a href='#ViewBrModal' data-toggle='modal' id="edit" class="btn btn-primary btn-xs edit_data" data-id="<?php echo $row->brno ?>"> <span class="fa fa-eye" aria-hidden="true"></span> View
                                        </a>
                                    </td>

                                    <td> </td>
                                    <td></td>
                                    <td>  </td>
                                    <td></td>
                                    <td></td>
                                    <td><a class="btn btn-success btn-xs">  </a></td>

                                </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
