<?php

  include('include/header.php');

?>

<!-- Page Content -->
  <div class="container">

    <!-- Page Heading -->
    <h1 class="mt-4 mb-3">
      <p class="text-center text-primary font-weight-bold">Expense Management System</p>
    </h1>

    <hr>
    <div>
        <button type="button" id="add_button" class="btn btn-primary">
          <i class="fas fa-plus"></i> Add Expense
        </button>
        <a href="expenses_report.php" target="_blank" class="btn btn-success">
          <i class="fas fa-print"></i> print
        </a>
    </div>
    <br>
    <!-- Expenses DataTable -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table font-weight-bold"></i> Expenses Table

      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="expenseTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Amont</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th colspan="2">Total</th>
                <th id="total_order"></th>
                <th colspan=""></th>
                <th></th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <!-- End Expense DataTable -->

  </div>
  <!-- /.container -->

  <!-- Expense Modal -->
  <div class="modal fade" id="formModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modal_title"></h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="expense_form">
            <p class="text-danger"><i>* Required</i></p>
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" id="description" name="description" rows="2" maxlength="100" autocomplete="off"></textarea>
              <div id="description_error_message" class="text-danger"></div>
            </div>
            <div class="form-group">
              <label for="title">Amount</label>
              <input type="number" id="amount" name="amount" class="form-control" placeholder="Enter amount" min="0" step=".01" autocomplete="off">
              <div id="amount_error_message" class="text-danger"></div>
            </div>
            <div class="form-group">
              <label for="title">Date</label>
              <input type="text" id="date" name="date" class="form-control" placeholder="YYYY/MM/DD" autocomplete="off">
              <div id="date_error_message" class="text-danger"></div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="expense_id" id="expense_id" />
              <input type="hidden" name="action" id="action" value="" />
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="button_action" id="button_action"><i class="fas fa-save"></i> Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Expense Modal -->

  <!-- Footer -->
<?php

  include("include/footer.php");

?>

<script>

  $(document).ready(function(){

    var datatable = $('#expenseTable').DataTable({
      'processing': true,
      'serverSide': true,
      'ajax': {
          url:'expense_action.php',
          type: 'POST',
          data: {action:'expense_fetch'}
      },
      drawCallback:function(settings){
        $('#total_order').html(settings.json.total);
      },
      'columns': [
          { data: 'id' },
          { data: 'description'},
          { data: 'amount'},
          { data: 'date'},
          { data: 'action',"orderable":false}
      ]
    });

    $('#date').datepicker({
        format: 'yyyy/mm/dd',
        autoclose: true,
        todayHighlight: true,
        orientation: 'bottom'
    });

    $('#add_button').click(function(){
      $('#modal_title').text('Add Expense');
      $('#button_action').val('Add');
      $('#action').val('Add');
      $('#formModal').modal('show');
      clear_field();
    });

    function clear_field()  {
      $('#expense_form')[0].reset();

      $("#description_error_message").hide();
      $("#description").removeClass("is-invalid");

      $("#amount_error_message").hide();
      $("#amount").removeClass("is-invalid");

      $("#date_error_message").hide();
      $("#date").removeClass("is-invalid");
    }

    $('#expense_form').on('submit', function(event){
      event.preventDefault();
      addExpense();
    });

    var error_description = false;
    var error_amount = false;
    var error_date = false;

    $("#description").focusout(function() {
      check_description();
    });

    $("#amount").focusout(function() {
      check_amount();
    });

    $("#date").focusout(function() {
      check_date();
    });

    function check_description() {

      if( $.trim( $('#description').val() ) == '' ){
        $("#description_error_message").html("Description is a required field.");
        $("#description_error_message").show();
        $("#description").addClass("is-invalid");
        error_description = true;
      }
      else{
        $("#description_error_message").hide();
        $("#description").removeClass("is-invalid");
      }
    }

    function check_amount() {

      if( $.trim( $('#amount').val() ) == '' ){
        $("#amount_error_message").html("Amount is a required field.");
        $("#amount_error_message").show();
        $("#amount").addClass("is-invalid");
        error_amount = true;
      }
      else{
        $("#amount_error_message").hide();
        $("#amount").removeClass("is-invalid");
      }
    }

    function check_date() {

      if( $.trim( $('#date').val() ) == '' ){
        $("#date_error_message").html("Date is a required field.");
        $("#date_error_message").show();
        $("#date").addClass("is-invalid");
        error_date = true;
      }
      else{
        $("#date_error_message").hide();
        $("#date").removeClass("is-invalid");
      }
    }

    function addExpense(){
      swal("Ready to go!", "", "success");

      error_description = false;
      error_amount = false;
      error_date = false;

      check_description();
      check_amount();
      check_date();

      if(error_description == false && error_amount == false && error_date == false) {

        data=$('#expense_form').serialize();

        $.ajax({
          type:"POST",
          data: data,
          url:"expense_action.php",
          dataType:"json",
          success:function(data){
            if(data.status=='success') {
              clear_field();
              datatable.ajax.reload();
              $('#formModal').modal('hide');
              swal("Successfully!", data.alert, "success");
            } else if (data.status=='error') {
              swal("Oops! Something went wrong.", "", "error");
            }
          },
          error:function(){
            swal("Oops! Something went wrong.", "", "error");
          }
        });
        return false;
      }else{
        swal("", "Please make sure all required fields are filled out correctly.", "error");
        return false;
      }
    }

    var expense_id = '';
    $(document).on('click', '.view_expense', function(){
      expense_id = $(this).attr('id');
      $.ajax({
        url:"expense_action.php",
        method:"POST",
        data:{action:'single_fetch', expense_id:expense_id},
        success:function(data){
          var data = JSON.parse(data);
          $('#view_id').text(data['id']);
          $('#view_description').text(data['description']);
          $('#view_amount').text(data['amount']);
          $('#view_date').text(data['date']);
        }
      });
    });

    $(document).on('click', '.edit_expense', function(){
      expense_id = $(this).attr('id');
      clear_field();
      $.ajax({
        url:"expense_action.php",
        method:"POST",
        data:{action:'edit_fetch', expense_id:expense_id},
        success:function(data){
          var data = JSON.parse(data);
          $('#expense_id').val(data['id']);
          $('#description').val(data.description);
          $('#amount').val(data.amount);
          $('#date').val(data.date);
          $('#modal_title').text('Edit Expense');
          $('#button_action').val('Edit');
          $('#action').val('Edit');
          $('#formModal').modal('show');
        }
      });
    });

    $(document).on('click', '.delete_expense', function(){
      expense_id = $(this).attr('id');
      swal({
        title: "Are you sure?",
        text: "You want to delete this expense!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
            url:"expense_action.php",
            method:"POST",
            data:{action:'delete', expense_id:expense_id },
            success:function(data){
              datatable.ajax.reload();
              swal("Expense has been successfully deleted!", {
                icon: "success",
              });
            },
            error:function(){
              swal("Oops! Something went wrong.", "", "error");
            }
          })
        }
      });
    });
  });

</script>