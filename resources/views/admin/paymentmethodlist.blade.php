@extends('layouts.main')

@section('content')
{{Form::hidden('', $increment = 1)}}
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payment Methods</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Payment Methods</h3>
              </div>
              
              <div class="col-12" style="margin: 1% 3% 0%">
                <a href="{{route('setuppaymentmethod')}}" class="btn btn-primary float-right">Add New Payment</a>
              </div>

              @if (Session::has('status'))
              <div class="alert alert-success">
                {{Session::get('status')}}
              </div>
              @endif
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: auto">
               
                 
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    
                    <th>name</th>
                   
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if($payment_methods)
                  @foreach ($payment_methods as $payment_method)
                  <tr>
                    <td>{{$increment}}</td>
                 
                    <td>{{$payment_method->name}}</td>

                    
                    <td>
                      <a href="{{url('/editpaymentmethod/'. $payment_method->id)}}" id="edit" class="btn btn-warning " >Edit</a>
                    </td>
                    <td>
                      <a href="{{url('/deletepaymentmethod/'. $payment_method->id)}}" id="delete" class="btn btn-danger " >Delete</a>
                    </td>
                  </tr>
                  {{Form::hidden('', $increment = $increment + 1)}}
                  @endforeach
                  @endif
                  </tbody>
                  <tfoot>
                  {{-- <tr>
                    <th>Num.</th>
                    <th>Country Code</th>
                    <th>Country Name</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr> --}}
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
  @section('style')

  <link rel="stylesheet" href="backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

  @endsection

@section('scripts')

<!-- DataTables -->
<script src="backend/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="backend/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="asset{{'backend/dist/js/adminlte.min.js'}}"></script>

<script src="backend/dist/js/bootbox.min.js"></script>
<!-- page script -->

<script>
  $(document).on("click", "#delete", function(e){
  e.preventDefault();
  var link = $(this).attr("href");
  bootbox.confirm("Do you really want to delete this element ?", function(confirmed){
    if (confirmed){
        window.location.href = link;
      };
    });
  });
</script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

@endsection
