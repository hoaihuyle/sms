<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Trang chủ</a></li> 
  <li class="active">
Quản lý Ngành học</li>
</ol>

<div class="panel panel-default">
  <div class="panel-heading">
    
Quản lý Ngành học
  </div>
  <div class="panel-body">  	    
      <div id="messages"></div>

    	<div class="pull pull-right">
    		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#addClass" id="addClassModelBtn"> 
    			<i class="glyphicon glyphicon-plus-sign"></i> Thêm Ngành học
    		</button>
    	</div>

    	<br /> <br /> <br />
    	
    	<table id="manageClassTable" class="table table-bordered">
    		<thead>
    			<tr>
    				<th>#</th>
    				<th>Tên Ngành học</th>
    				<th>Mã Ngành học</th>
    				<th>Hoạt động</th>
    			</tr>
    		</thead>
    	</table>	
    
  </div>
</div>

<!-- add class -->
<div class="modal fade" tabindex="-1" role="dialog" id="addClass">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thêm Ngành học</h4>
      </div>

      <form class="form-horizontal" method="post" id="createClassForm" action="<?php echo base_url() . 'classes/create' ?>">

      <div class="modal-body">
      
      <div id="add-class-messages"></div>

		  <div class="form-group">
		    <label for="className" class="col-sm-4 control-label">Tên Ngành học : </label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="className" name="className" placeholder="Class Name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="numericName" class="col-sm-4 control-label">Mã Ngành học : </label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="numericName" name="numericName" placeholder="Numeric Name">
		    </div>
		  </div>		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- edit class -->
<div class="modal fade" tabindex="-1" role="dialog" id="editClassModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
Chỉnh sửa Ngành học</h4>
      </div>

      <form class="form-horizontal" method="post" id="editClassForm" action="<?php echo base_url() . 'classes/update'; ?>">

      <div class="modal-body">
      
      <div id="edit-class-messages"></div>

      <div class="form-group">
        <label for="editClassName" class="col-sm-4 control-label">Tên Ngành học : </label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="editClassName" name="editClassName" placeholder="Class Name">
        </div>
      </div>
      <div class="form-group">
        <label for="editNumericName" class="col-sm-4 control-label">Mã Ngành học : </label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="editNumericName" name="editNumericName" placeholder="Numeric Name">
        </div>
      </div>      
      </div>
      <div class="modal-footer edit-class-modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- remove class -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeClassModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
Xóa Ngành học</h4>
      </div>
      
      <div class="modal-body">
        <div id="remove-messages"></div>
        <p> Bạn có thực sự muốn loại bỏ</p>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="submit" class="btn btn-primary" id="removeClassBtn">Lưu thay đổi</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript" src="<?php echo base_url('custom/js/classes.js'); ?>"></script>