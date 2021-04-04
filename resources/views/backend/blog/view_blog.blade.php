@include('backend.layout.header')
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>View blog</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>           

               <div class="row">
                 @if ($message = Session::get('success'))
                 <div class="alert alert-success alert-block" id="flassMessage">
                  <!-- <button type="button" class="close">×</button>  -->
                  <strong>{{ $message }}</strong>
                  </div> 
                 @endif
            
                 @if ($message = Session::get('error'))
                 <div class="alert alert-danger alert-block" id="flassMessage">
                  <!-- <button type="button" class="close">×</button>  -->
                  <strong>{{ $message }}</strong>
                  </div> 
                 @endif
            
              <div class="col-md-10 ">
              
             <div class="x_panel">
                  <div class="x_title">
                    <h2>View blog <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form id="demo-form" action="{{ url('add_blog_action')}}" method="POST" enctype="multipart/form-data"> 
                      <label for="Heading">Heading * :</label>
                      <input type="text" id="heading" class="form-control" name="heading" value="{{ $blog->heading }}" autocomplete="off" / readonly="">
                      <input type="hidden"  class="form-control" name="blog_id" value="{{ $blog->id }}" autocomplete="off" />
                       @error('heading')
                      <div class="alert alert-danger" id="error">{{ $message }}</div>
                       @enderror
                      {{ csrf_field() }}

                      <label for="Subheding">Sub Heading * :</label>
                      <input type="text" id="subheading" class="form-control" name="subheading" value="{{ $blog->subheading }}" autocomplete="off" / readonly="">
                      @error('subheading')
                      <div class="alert alert-danger" id="error">{{ $message }}</div>
                      @enderror

                      <label for="short_desc">Short Description * :</label>
                      <textarea rows="3" class="form-control" name="short_desc" id="editor" value="{{ $blog->short_desc}}" readonly="">{{ $blog->short_desc}}</textarea>
                      @error('short_desc')
                      <div class="alert alert-danger" id="short_desc">{{ $message }}</div>
                      @enderror          

                      <label for="description">Description * :</label>
                      <textarea rows="3" class="form-control" name="description" id="editor1" value="{{ $blog->description}}" readonly="">{{ $blog->description}}</textarea>
                      @error('description')
                      <div class="alert alert-danger" id="email_error">{{ $message }}</div>
                      @enderror                        
                      
                      <label for="blog_image">Blog Image * :</label>
                                        <br>
                       <img class="img-responsive avatar-view" src="{{ asset('storage/admin_media/images/blog/'.$blog->image) }}" alt="Avatar" title="Change the avatar">   
                       @error('profile')
                      <div class="alert alert-danger" id="error">{{ $message }}</div>
                         @enderror 
                          <br/><br>

                    </form>            
                  </div>
                </div>

             

              </div>


            
            </div>


            
          </div>
        </div>

@include('backend.layout.footer')
<script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>

<script>
  // CKEDITOR.replace('editor', {
  //     filebrowserUploadUrl: $("#base_url").val() + "admin/cms/Cn_cms/ImageUpload"
  // });

  CKEDITOR.replace('editor');
  /*[start:: code to upload local images]*/
  var config = {
      '.chosen-select': {},
      '.chosen-select-deselect': {allow_single_deselect: true},
      '.chosen-select-no-single': {disable_search_threshold: 10},
      '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
      '.chosen-select-width': {width: "95%"}
  }
  for (var selector in config) {
      $(selector).chosen(config[selector]);
  }
  /*[end:: code to upload local images]*/
</script>

<script type="text/javascript">
setTimeout(function() {
    $('#error,#email_error,#short_desc,#flassMessage').fadeOut("slow");
}, 3000); //

</script>
<script>
  // CKEDITOR.replace('editor', {
  //     filebrowserUploadUrl: $("#base_url").val() + "admin/cms/Cn_cms/ImageUpload"
  // });

  CKEDITOR.replace('editor1');
  /*[start:: code to upload local images]*/
  var config = {
      '.chosen-select': {},
      '.chosen-select-deselect': {allow_single_deselect: true},
      '.chosen-select-no-single': {disable_search_threshold: 10},
      '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
      '.chosen-select-width': {width: "95%"}
  }
  for (var selector in config) {
      $(selector).chosen(config[selector]);
  }
  /*[end:: code to upload local images]*/
</script>

<script type="text/javascript">
setTimeout(function() {
    $('#error,#email_error,#flassMessage').fadeOut("slow");
}, 3000); //

</script>