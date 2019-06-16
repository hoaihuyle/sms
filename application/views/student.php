<?php 
if($this->input->get('opt') == '' || !$this->input->get('opt')) {
  show_404();
} else {
?>

<div id="request" class="div-hide"><?php echo $this->input->get('opt'); ?></div>

<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Trang chủ</a></li> 
  <?php   
  if($this->input->get('opt') == 'addst') {
    echo '<li class="active">Thêm Sinh Viên</li>';
  } 
  else if ($this->input->get('opt') == 'bulkst') {
    echo '<li class="active">Thêm nhiều Sinh Viên</li>';
  }
  else if ($this->input->get('opt') == 'mgst') {
    echo '<li class="active">Quản lý sinh viên</li>';
  }
  ?>  

</ol>

<?php if($this->input->get('opt') == 'addst' || $this->input->get('opt') == 'bulkst') { ?>

<div class="panel panel-default">
  <div class="panel-heading">
    <?php   
    if($this->input->get('opt') == 'addst') {
      echo "Thêm Sinh Viên";
    } 
    else if ($this->input->get('opt') == 'bulkst') {
      echo "Thêm nhiều Sinh Viên";
    }
    ?>  
  	
  </div>
  <div class="panel-body">
  	 <div id="messages"></div>

      <?php   
      if($this->input->get('opt') == 'addst') {
        // echo "Add Student";
        ?>
        <form action="<?php echo base_url('student/create') ?>" method="post" id="createStudentForm" enctype="multipart/form-data">  
          <div class="col-md-7">
          <fieldset>
            <legend>Thông tin sinh viên</legend>

            <div class="form-group">
              <label for="fname">Họ</label>
              <input type="text" class="form-control" id="fname" name="fname" placeholder="Họ" autocomplete="off" >
            </div>
            <div class="form-group">
              <label for="lname">Tên</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Tên" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="dob">Ngày sinh</label>
                <input type="text" class="form-control" id="dob" name="dob" placeholder="Ngày Sinh" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="age">Tuổi</label>
                <input type="text" class="form-control" id="age" name="age" placeholder="Tuối" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="contact">Liên hệ</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Liên hệ" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
            </div>

          </fieldset>     

          <fieldset>
            <legend>Thông tin địa chỉ</legend>

            <div class="form-group">
              <label for="address">Địa chỉ</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="city">Thành phố</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Thành phố" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="country">Quê quán</label>
                <input type="text" class="form-control" id="country" name="country" placeholder="Quốc gia" autocomplete="off">
            </div>            
          </fieldset>       

          </div> 
          <!-- /col-md-6 -->

          <div class="col-md-5">          

          <fieldset>
            <legend>Thông tin đăng ký</legend>

            <div class="form-group">
              <label for="registerDate">Ngày đăng ký</label>
              <input type="text" class="form-control" id="registerDate" name="registerDate" placeholder="Ngày đăng ký" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="className">Ngành học</label>
              <select class="form-control" name="className" id="className">
                <option value="">Lựa chọn</option>
                <?php foreach ($classData as $key => $value) { ?>
                  <option value="<?php echo $value['class_id'] ?>"><?php echo $value['class_name'] ?></option>
                <?php } // /forwach ?>
              </select>
            </div>
            <div class="form-group">
              <label for="sectionName">Lớp học</label>
              <select class="form-control" name="sectionName" id="sectionName">
                <option value="">Chọn Lớp học</option>
              </select>
            </div>
          </fieldset>       

          <fieldset>
             <legend>Thông tin tài khoản</legend>
              <div class="form-group">
                <label for="userName">Tên tài khoản</label>
                <input type="text" class="form-control" id="userName" name="userName" placeholder="Tên tài khoản" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="pass">Mật khẩu</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Mật khẩu" autocomplete="off">
              </div>
          </fieldset>

          <fieldset>
            <legend>Ảnh</legend>

            <div class="form-group">
              <label for="photo">Ảnh</label>
              <!-- the avatar markup -->
              <div id="kv-avatar-errors-1" class="center-block" style="max-width:500px;display:none"></div>             
                <div class="kv-avatar center-block" style="width:100%">
                    <input type="file" id="photo" name="photo" class="file-loading"/>                       
                </div>
            </div>
          
          </fieldset>       
           

          </div>
          <!-- /col-md-6 -->

          <div class="col-md-12">

            <br /> <br />
            <center>  
              <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
              <button type="button" class="btn btn-default">Đặt lại</button>      
            </center>       
          </div>
                  

        </form>

        <?php
      } // /add student
      else if ($this->input->get('opt') == 'bulkst') {
        // echo "Add Bulk Student";        
        ?>        
        <form action="student/createBulk" method="post" id="createBulkForm">

        <center>          
          <button type="button" class="btn btn-default" onclick="addRow()">Thêm dòng</button>
          <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </center>
        <br /> <br />

        <table class="table" id="addBulkStudentTable">
           <thead>
             <tr>
               <th style="width: 20%;">Họ</th>
               <th style="width: 20%;">Tên</th>
               <th style="width: 20%;">Ngành học</th>
               <th style="width: 20%;">Lớp học</th>
               <th style="width: 2%;">Hoạt động</th>
             </tr>
           </thead> 
           <tbody>
            <?php 
            for($x = 1; $x < 4; $x++) { ?>
              <tr id="row<?php echo $x; ?>">
                <td>
                  <div class="form-group">
                    <input type="text" class="form-control" id="bulkstfname<?php echo $x; ?>" name="bulkstfname[<?php echo $x; ?>]" placeholder="Họ" autocomplete="off">
                  </div>                  
                </td>
                <td>
                  <div class="form-group">
                    <input type="text" class="form-control" id="bulkstlname<?php echo $x; ?>" name="bulkstlname[<?php echo $x; ?>]" placeholder="Tên" autocomplete="off">
                  </div>                  
                </td>
                <td>
                  <div class="form-group">
                    <select class="form-control" name="bulkstclassName[<?php echo $x; ?>]" id="bulkstclassName<?php echo $x; ?>" onchange="getSelectClassSection(<?php echo $x; ?>)">
                      <option value="">Lựa chọn</option>
                      <?php foreach ($classData as $key => $value) { ?>
                        <option value="<?php echo $value['class_id'] ?>"><?php echo $value['class_name'] ?></option>
                      <?php } // /forwach ?>
                    </select>
                  </div>                    
                </td>
                <td>
                  <div class="form-group">
                    <select class="form-control" name="bulkstsectionName[<?php echo $x; ?>]" id="bulkstsectionName<?php echo $x; ?>">
                      <option value="">Chọn Lớp học</option>
                    </select>
                  </div>                  
                </td>
                <td>
                  <button type="button" class="btn btn-default" onclick="removeRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
                </td>
              </tr>
            <?php
            } // /for
            ?>
             
           </tbody>
        </table>
        <!-- /.form -->

        </form>
        <!-- /.form -->

        <?php
      } // /add bulk student      
      ?>  
      
  
        	
  </div>
  <!-- /panle-bdy -->
</div>
<!-- /.panel -->

<?php 
} // /checking condition for add student and bulk student 
else if($this->input->get('opt') == 'mgst') { ?>
  <div class="row">
          <div class="col-md-4">
            <div class="panel panel-default">

              <div class="panel-heading">
                Lớp
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
            <!-- /.panel -->
          </div>
          <!-- /.col-md-4 -->
          <div class="col-md-8">              

            <div class="panel panel-default">
              <div class="panel-heading">Quản lý sinh viên</div>
              <div class="panel-body">
                <div id="result"></div>                                        

              </div>
              <!-- /panel-body -->
            </div>      
            <!-- /panel -->
          </div>
          <!-- /.col-md-08 -->
        </div>
        <!-- /.row -->
<?php  
} // /condition for manage student
?>

<!-- edit student modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editStudentModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Chỉnh sửa sinh viên</h4>
      </div>
     
      <div class="modal-body edit-modal">
      
        <div id="edit-teacher-messages"></div>

        <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Ảnh</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Chi tiết cá nhân</a></li>      
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
          <br /> 

        <form class="form-horizontal" method="post" id="updateStudentPhotoForm" action="student/updatePhoto" enctype="multipart/form-data">

        <div class="row">
          <div class="col-md-12">
            <div id="edit-upload-image-message"></div>

            <div class="col-md-6">
              <center>
                <img src="" id="student_photo" alt="Student Photo" class="img-thumbnail upload-photo" />
              </center>               
            </div>

            <div class="col-md-6">
              <div class="form-group">
                  <label for="editPhoto" class="col-sm-4 control-label">Ảnh: </label>
                  <div class="col-sm-8">                  
                      <!-- the avatar markup -->
                  <div id="kv-avatar-errors-1" class="center-block" style="max-width:500px;display:none"></div>             
                    <div class="kv-avatar center-block" style="width:100%">
                        <input type="file" id="editPhoto" name="editPhoto" class="file-loading"/>                       
                    </div>
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <center>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </center>
                  </div>
                </div>

            </div>
            <!-- /col-md-6 -->
          </div>
          <!-- /col-md-12 -->
        </div>
        <!-- /row -->
          
        </form>
        </div>
        <!-- /tab panel of image -->

        <div role="tabpanel" class="tab-pane" id="profile">

        <br /> 
        <form class="form-horizontal" method="post" action="student/updateInfo" id="updateStudentInfoForm">
          <div class="row">

            <div class="col-md-12">
              <div id="edit-personal-student-message"></div>

              <div class="col-md-6">
                <div class="form-group">
                <label for="editFname" class="col-sm-4 control-label">Họ : </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="editFname" name="editFname" placeholder="Họ" />
                  </div>
              </div>
              <div class="form-group">
                  <label for="editLname" class="col-sm-4 control-label">Tên : </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="editLname" name="editLname" placeholder="Tên"/>
                  </div>
              </div>
              <div class="form-group">
                  <label for="editDob" class="col-sm-4 control-label">Ngày sinh: </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editDob" name="editDob" placeholder="Ngày sinh" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="editAge" class="col-sm-4 control-label">Tuổi: </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editAge" name="editAge" placeholder="Tuổi" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="editContact" class="col-sm-4 control-label">Liên hệ: </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editContact" name="editContact" placeholder="Liên hệ" />
                  </div>
                </div>  
                <div class="form-group">
                  <label for="editEmail" class="col-sm-4 control-label">Email: </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editEmail" name="editEmail" placeholder="Email" />
                  </div>
                </div>  
                <div class="form-group">
                  <label for="editAddress" class="col-sm-4 control-label">Địa chỉ: </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editAddress" name="editAddress" placeholder="Địa chỉ" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="editCity" class="col-sm-4 control-label">Thành phố: </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editCity" name="editCity" placeholder="Thành phố" />
                  </div>
                </div>            
                <div class="form-group">
                  <label for="editCountry" class="col-sm-4 control-label">Quê quán: </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editCountry" name="editCountry" placeholder="Quốc gia" />
                  </div>
                </div>
              </div>
              <!-- /col-md-6 -->

              <div class="col-md-6">

                <div class="form-group">
                  <label for="editRegisterDate" class="col-sm-4 control-label">Ngày đăng ký : </label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="editRegisterDate" name="editRegisterDate" placeholder="Ngày đăng ký" />
                    </div>
                </div>              
                <div class="form-group">
                  <label for="editClassName" class="col-sm-4 control-label">Lớp</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="editClassName" id="editClassName">
                    <option value="">Lựa chọn</option>
                    <?php foreach ($classData as $key => $value) { ?>
                      <option value="<?php echo $value['class_id'] ?>"><?php echo $value['class_name'] ?></option>
                    <?php } // /forwach ?>
                  </select>
                  </div>                  
                </div>
                <div class="form-group">
                  <label for="editSectionName" class="col-sm-4 control-label">Ngành học</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="editSectionName" id="editSectionName">
                      <option value="">Chọn lớp</option>
                    </select>
                  </div>                  
                </div>

                <div class="form-group">
                  <label for="editUserName" class="col-sm-4 control-label">Tên tài khoản: </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editUserName" name="editUserName" placeholder="Tên tài khoản" />
                  </div>
                </div>

                <div class="form-group">
                  <label for="editPass" class="col-sm-4 control-label">Mật khẩu: </label>
                  <div class="col-sm-8">
                      <input type="password" class="form-control" id="editPass" name="editPass" placeholder="Mật khẩu" />
                  </div>
                </div>

              </div>         
                <!-- /col-md-4 -->

              <div class="form-group">
                <div class="col-sm-12">
                  <center>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                      <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                  </center>
                </div>
              </div>
            </div>
            <!-- /col-md-12 -->
      
        </div>
        <!-- /row -->           
      </form>

        </div>        
        <!-- /tab-panel of teacher information -->
      </div>


      </div>
      <!-- /modal-body -->      
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- remove studet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeStudentModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Xóa sinh viên</h4>
      </div>
      <div class="modal-body">
        <p>Bạn có thực sự muốn loại bỏ ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" id="removeStudentBtn">Lưu thay đổi</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php 

} // /else show_404() 

?>



<script type="text/javascript" src="<?php echo base_url('custom/js/student.js') ?>"></script>
