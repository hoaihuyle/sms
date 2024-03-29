<?php 
if($this->input->get('opt') == '' || !$this->input->get('opt')) {
  show_404();
} else {
?>
<div id="request" class="div-hide"><?php echo $this->input->get('opt'); ?></div>

<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Trang chủ</a></li> 
  <?php    
  if($this->input->get('opt') == 'mngms') {
    echo '<li class="active">Quản lý bảng điểm</li>';
  } 
  else if ($this->input->get('opt') == 'mgmk') {
    echo '<li class="active">Manage Marks</li>';
  }  
  ?>  
</ol> 

<?php if($this->input->get('opt') == 'mngms') {
// manage marksheet
?>
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			
			<div class="panel-heading">
				Ngành học
			</div>

			<div class="list-group">			
				<?php 
				if($classData) {
					$x = 1;
					foreach ($classData as $value) { 
					?>
						<a class="list-group-item classSideBar <?php if($x == 1) { echo 'active'; } ?>" onclick="getClassSection(<?php echo $value['class_id'] ?>)" id="classId<?php echo $value['class_id'] ?>">
				    		<?php echo $value['class_name']; ?>(<?php echo $value['numeric_name']; ?>)
					  	</a>	
					<?php 
					$x++;
					}
				} 
				else {
					?>
					<a class="list-group-item">Không có dữ liệu</a>
					<?php
				} // /else		
				?>
			</div>

		</div>		
	</div>
	<!-- /col-md-4 -->

	<div class="col-md-8">
		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Quản lý bảng điểm</div>
		  
		  <div class="panel-body">		  
		  	<div id="remove-message"></div>

		  	<div class="result"></div>
		  </div>			  
		</div>
	</div>
	<!-- /col-md-8 -->
</div>
<!-- /row -->
<?php
}  // /.manage marksheet
else if($this->input->get('opt') == 'mgmk') {
	// manage marks
?>
<div class="panel panel-default">
  	<!-- Default panel contents -->
	<div class="panel-heading">Quản lý nhãn hiệu</div>
	  
	<div class="panel-body">		  
		<form method="post" action="marksheet/fetchStudentMarksheet" class="form-horizontal" id="fetchStudentMarksheet">
		  	<div class="form-group">
		    	<label for="className" class="col-sm-2 control-label">Ngành học</label>
		    	<div class="col-sm-10">
		    	  	<select class="form-control" name="className" id="className">
		      			<option value="">Lựa chọn</option>
		      			<?php  
		      			foreach ($classData as $key => $value) {
		      				echo "<option value='".$value['class_id']."'>".$value['class_name']."</option>";
		      			} // /.foreach for class data
		      			?>
		      		</select>
		    	</div>
		  	</div>		  	
		  	<div class="form-group">
		    	<label for="marksheetName" class="col-sm-2 control-label">
Bảng đánh dấu</label>
		    	<div class="col-sm-10">
		      		<select class="form-control" name="marksheetName" id="marksheetName">
		      			<option value="">
Chọn ngành</option>
		      		</select>
		    	</div>
		  	</div>		  	
		  	<div class="form-group">
		    	<div class="col-sm-offset-2 col-sm-10">
		      		<button type="submit" class="btn btn-primary">Gửi đi</button>
		    	</div>
		  	</div>
		</form>
	</div>			  
</div>

<div id="marks-result"></div>

<?php
} // /.manage marks ?>


<!-- create marksheet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addMarksheetModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">
Thêm bảng tính</h4>
      </div>
      <form action="marksheet/create" method="post" id="addMarksheetForm">
      <div class="modal-body">
          <div id="add-marksheet-message"></div>

		  <div class="form-group">
		    <label for="marksheetName">
Tên bảng tính</label>
		    <input type="text" class="form-control" id="marksheetName" name="marksheetName" placeholder="Tên bảng điểm" autocomplete="off">
		  </div>
		  <div class="form-group">
		    <label for="date">Ngày thi: </label>		    
		    <input type="text" class="form-control" id="date" name="date" autocomplete="off" placeholder="Date" >
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

<!-- edit marksheet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editMarksheetModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Chỉnh sửa bảng tính</h4>
      </div>
      <form action="marksheet/update" method="post" id="editMarksheetForm">
      <div class="modal-body">
          <div id="edit-marksheet-message"></div>

		  <div class="form-group">
		    <label for="editMarksheetName">
Tên bảng tính</label>
		    <input type="text" class="form-control" id="editMarksheetName" name="editMarksheetName" placeholder="Tên bảng điểm" autocomplete="off">
		  </div>
		  <div class="form-group">
		    <label for="editDate">Ngày thi: </label>		    
		    <input type="text" class="form-control" id="editDate" name="editDate" autocomplete="off" placeholder="Date" >
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

<!-- remove markshet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMarksheetModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Xóa bảng tính</h4>
      </div>
      <div class="modal-body">
        <p>Bạn có thực sự muốn loại bỏ ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="removeMarksheetBtn">Lưu thay đổi</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- mark the stuent marks of the markshet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editMarksModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Chỉnh sửa bảng tính</h4>
      </div>
      <div class="modal-body">
      	<div id="edit-mark-message"></div>
        <div id="edit-mark-result"></div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- view the stuent's marks of the markshet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewMarksModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Xem bảng tính</h4>
      </div>
      <div class="modal-body">      	
        <div id="view-mark-result"></div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div> -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript" src="<?php echo base_url('custom/js/marksheet.js') ?>"></script>

<?php 
} // .if to check for opt request
?>