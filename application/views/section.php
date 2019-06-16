<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Trang chủ</a></li> 
  <li class="active">Quản lý nhóm học</li>
</ol>

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
				}		
				?>
			</div>

		</div>		
	</div>
	<!-- /col-md-4 -->

	<div class="col-md-8">
		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Quản lý lớp học</div>

		  <div class="panel-body">		  
		  	<div class="result"></div>
		  </div>			  
		</div>
	</div>
	<!-- /col-md-8 -->
</div>
<!-- /row -->

<!-- create section modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addSectionModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thêm mục</h4>
      </div>
      <form action="<?php echo base_url('section/create') ?>" method="post" id="addSectionForm">
      <div class="modal-body">
          <div id="add-section-message"></div>

		  <div class="form-group">
		    <label for="sectionName">Tên mục</label>
		    <input type="text" class="form-control" id="sectionName" name="sectionName" placeholder="Section Name">
		  </div>
		  <div class="form-group">
		    <label for="teacherName">Giáo viên : </label>
		    <select class="form-control" name="teacherName" id="teacherName">
		    	<option value="">Chọn một giáo viên</option>
		    	<?php 
		    	if($teacherData) { 
	    			foreach ($teacherData as $key => $value): ?>
			    		<option value="<?php echo $value['teacher_id'] ?>"><?php echo $value['fname'] . ' ' . $value['lname'] ?></option>
			    	<?php 
			    	endforeach 
			    	?>
	    		<?php
		    	} 
		    	else { ?>
		    		<option value="">Không có dữ liệu</option>
		    	<?php 
		    	}
		    	?>
		    </select>
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

<!-- update section modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editSectionModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Chỉnh sửa mục</h4>
      </div>
      <form action="<?php echo base_url('section/update') ?>" method="post" id="editSectionForm">
      <div class="modal-body">
          <div id="edit-section-messages"></div>

		  <div class="form-group">
		    <label for="editSectionName">Tên mục</label>
		    <input type="text" class="form-control" id="editSectionName" name="editSectionName" placeholder="Section Name">
		  </div>
		  <div class="form-group">
		    <label for="editTeacherName">Giáo viên : </label>
		    <select class="form-control" name="editTeacherName" id="editTeacherName">
		    	<option value="">Chọn một giáo viên</option>
		    	<?php 
		    	if($teacherData) { 
	    			foreach ($teacherData as $key => $value): ?>
			    		<option value="<?php echo $value['teacher_id'] ?>"><?php echo $value['fname'] . ' ' . $value['lname'] ?></option>
			    	<?php 
			    	endforeach 
			    	?>
	    		<?php
		    	} 
		    	else { ?>
		    		<option value="">Không có dữ liệu</option>
		    	<?php 
		    	}
		    	?>
		    </select>
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

<!-- remove section modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeSectionModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Xóa mục</h4>
      </div>
      <div class="modal-body">
        <div id="remove-messages"></div>

        <p>Bạn có thực sự muốn loại bỏ ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="removeSectionBtn">Lưu thay đổi</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src="<?php echo base_url('custom/js/section.js') ?>"></script>