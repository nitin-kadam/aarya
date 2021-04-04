@include('backend.layout.header')
 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Clients  <small>List</small></h3>
              </div>

              <div class="title_right" >
                
              
	             <a href="{{ url('add_client')}}"><button class="btn btn-primary" data-toggle="tooltip" title="Add Clients" style="float: right;"><i class="fa fa-plus-circle"></i></button></a>              
              </div>
             </div>

            <div class="clearfix"></div>

            <div class="row">
             
                    @if ($message = Session::get('error'))
                     <div class="alert alert-danger alert-block" id="flassMessage">
                      <!-- <button type="button" class="close">×</button>  -->
                      <strong>{{ $message }}</strong>
                      </div> 
                     @endif

                      @if ($message = Session::get('success'))
                     <div class="alert alert-success alert-block" id="flassMessage">
                      <!-- <button type="button" class="close">×</button>  -->
                      <strong>{{ $message }}</strong>
                      </div> 
                     @endif

               <div class="col-md-12 col-sm-12 ">
              	

                <div class="x_panel">
                  <div class="x_title">
                    <h2>Clients list</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           <!--  <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a> -->
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                  
                    <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action" style="width:100%">
                      <thead>
                        <tr>                        
						<th><input type="checkbox" id="check-all" ></th> 
                          <th>Id</th>
                          <th>Name</th>
                          <th>email</th>
                          <th>Image</th>                         
                          <th>Actions</th>
                        </tr>
                      </thead>


                      <tbody>
                       @if(!empty($all_client))
                        @foreach($all_client as $key =>  $client)

                        <tr>   
                        <td><input type="checkbox" id="check-all" >  </td>

                          <td>{{ $key + 1 }}</td>
                          <td>{{ $client->name }}</td>
                          <td>{{ $client->email }}</td>
                           <td>
                          <img class="img-rounded" style="height:45px; width: 45px;" src="{{ URL::asset("storage/admin_media/images/client/".$client->image) }}" alt="{{ $client->image }}">
                          </td>
                         
                          
                          <td>  <a  href="{{ url('/edit_view_client/'.$client->id) }}"><button class="btn btn-info"  title="edit client" data-toggle="tooltip" ><i class="fa fa-pencil"></i></button></a>
                         
                          <a onClick="return confirm('Are you sure you want to delete this record ?')" href="{{ url('/delete_client/'.$client->id) }}"><button class="btn btn-danger" title="delete client" data-toggle="tooltip"><i class="fa fa-trash"></i></button></a>
                         
                           <a href="{{ url('/view_client/'.$client->id) }}"><button class="btn btn-warning" title="view client" data-toggle="tooltip"><i class="fa fa-eye"></i></button></a>
                          </td>

                      </tr>
                      @endforeach 
                      @endif                      
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
        </div>
        <!-- /page content -->
@include('backend.layout.footer')

<script type="text/javascript">
setTimeout(function() {
    $('#flassMessage').fadeOut("slow");
}, 3000); //

</script>