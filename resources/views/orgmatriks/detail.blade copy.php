@extends('layouts.defaultlayout')




@section('contentheader')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                 <h1 class="m-0">ORGANISASI PASUKAN</h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                      <li class="breadcrumb-item active">organisasi Pasukan</li>
                  </ol>
              </div>
          </div>
        </div>
    </div>
@endsection

@section('content')

<div class="card card-danger">
  <div class="card-header">
    <h3 class="card-title">SALURAN</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <form method="POST" action="{{ route('orgchartview') }}" >
    @csrf
    
  <div class="card-body">
    <div class="row">
     
      <div class="col-5">
        <select class="form-control select2bs4 no-radius" name="saluran_id"  style="width: 100%"   id="saluran_id" required>
          <option disabled selected value> -- Pilih Saluran -- </option>
          @foreach($saluran as $sl)
              <option value="{{ $sl->id }}">{{$sl->nama}}</option>
          @endforeach
        </select>
      </div>
     
    </div>
  </div>
  <div class="card-footer">
    <button class="btn btn-primary float-right">HANTAR</button>
</div> 
</form>
  <!-- /.card-body -->
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">{{$nama_saluran}}</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div id="treelistPemerintahan"></div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<!---- Test-->
 
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
     <form method="POST" action="/orgmatriks">
      @csrf
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah anak pasukan</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
           <input type="hidden" id="parentId" name="parentId" >
           <input type="hidden" id="saluran_id" name="saluran_id" value="{{$id_saluran}}" >
           <select class="form-control select2bs4 no-radius" name="pasukan_id"  style="width: 100%"   id="saluran_id" required>
            <option disabled selected value> -- Pilih Pasukan -- </option>
            @foreach($pasukan as $sl)
                <option value="{{ $sl->id }}">{{$sl->nama}}</option>
            @endforeach
          </select>

      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        {{-- <a  class="btn btn-danger"  data-dismiss="modal">Go to Google</a> --}}
        <button type="submit" class="btn btn-primary">HANTAR</button>
        <button type="button" class="btn btn-danger"  id="close" data-dismiss="modal">Close</button>
      </div>

    </div>
  </form>
  </div>
</div>
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Open modal
</button> --}}



@push('jscript')
<script>
  var datasaluran = @json($data);
  
      // Get the modal
      var modal = document.getElementById("myModal");

      // Get the <span> element that closes the modal
      var span = document.getElementById("close");


      // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        }


        // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }

    $("#treelistPemerintahan").kendoTreeList({
      columns: [
        { field: "NAMA" },
        { command: [
        {
          name: "details",
          text: "Details",
          click: function(e) {
            var tr = $(e.target).closest("tr");
            var data = this.dataItem(tr);
            // console.log("Details for: " + data.id);
            location.href='{{ url('orgmatriks') }}'+'/' +data.show_id;
          },
          imageClass: "k-i-info"
        },
        {
          name: "tambah",
          text: "Tambah",
          click: function(e) {
            var tr = $(e.target).closest("tr");
            var data = this.dataItem(tr);
            console.log("Details for: " + data.create_parent);

            document.getElementById("parentId").value = data.create_parent;
            modal.style.display = "block";
          },
          imageClass: "k-i-info"
        },

        {
          name: "padam",
          text: "Padam",
          click: function(e) {
            var tr = $(e.target).closest("tr");
            var data = this.dataItem(tr);
            location.href='{{ url('/delete/') }}'+'/' + data.create_parent +"/"+data.saluran_id+"/"+data.show_id;

          },
          imageClass: "k-i-info"
        },

      ]}
      ],
           
      dataSource: {
        data:  datasaluran,
        schema: {
                            model: {
                                id: "id",
                                expanded: true
                            }
                        }
          },
          toolbar: [ "save" ],
      editable:  {
            move: {
                  reorderable: true,
                  function(e) {
            console.log("Details for: ");
          },
               }, 
            mode: "popup",
            template: $("#popupedit").html()
          },
          drag: function(e) {
        /* The result can be observed in the DevTools(F12) console of the browser. */
        console.log("dragging", e.source, e.target);
      }
          
    });

    // Get a reference to the kendo.ui.TreeList instance.
    var treelist = $("#treelist").data("kendoTreeList");

    // Use the expand method to expand the first row.
    treelist.expand($("#treelist tbody>tr:eq(0)"));
</script>



@endpush

@endsection
