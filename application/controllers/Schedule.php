<?php  
 
class Schedule extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
 
		$this->isNotLoggedIn();

		// loading the section model class
		$this->load->model('model_section');
		// loading the teacher model 
		$this->load->model('model_student');
		// loading the classes model class
		$this->load->model('model_classes');
		// loading the marksheet model class
		$this->load->model('model_marksheet');	
		// loading the subject model class
		$this->load->model('model_subject');
		// loading the teacher model
		$this->load->model('model_teacher');
		// attendance
		$this->load->model('model_attendance');

		$this->load->model('model_schedule');

		// load the form validation library
		$this->load->library('form_validation');
	}

	/*
	*----------------------------------------------
	* fetches the class's marksheet table 
	*----------------------------------------------
	*/
	public function fetchMarksheetTable($classId = null)
	{
		if($classId) {			
			$classData = $this->model_classes->fetchClassData($classId);
			$marksheetData = $this->model_marksheet->fetchMarksheetData($classId);
			
			$table = '

			<div class="well">
				Ngành học : '.$classData['class_name'].'
			</div>

			<div id="messages"></div>

			<div class="pull pull-right">
	  			<button class="btn btn-default" data-toggle="modal" data-target="#addMarksheetModal" onclick="addMarksheet('.$classId.')">Thêm bảng điểm</button>	
		  	</div>
		  		
		  	<br /> <br />

		  	<!-- Table -->
		  	<table class="table table-bordered" id="manageMarksheetTable">
			    <thead>	
			    	<tr>			    		
			    		<th> Tên bảng điểm  </th>
			    		<th> Ngày </th>
			    		<th>Hoạt động </th>
			    	</tr>
			    </thead>
			    <tbody>';
			    	if($marksheetData) {
			    		foreach ($marksheetData as $key => $value) {			    			

			    			$button = '<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Action <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							    <li><a type="button" data-toggle="modal" data-target="#editMarksheetModal" onclick="editMarksheet('.$value['marksheet_id'].','.$value['class_id'].')"> <i class="glyphicon glyphicon-edit"></i> Chỉnh sửa</a></li>
							    <li><a type="button" data-toggle="modal" data-target="#removeMarksheetModal" onclick="removeMarksheet('.$value['marksheet_id'].','.$value['class_id'].')"> <i class="glyphicon glyphicon-trash"></i> Xóa</a></li>		    
							  </ul>
							</div>';

				    		$table .= '<tr>
				    			<td>'.$value['marksheet_name'].'</td>
				    			<td>'.$value['marksheet_date'].'</td>
				    			<td>'.$button.'</td>
				    		</tr>
				    		';
				    	} // /foreach				    	
			    	} 
			    	else {
			    		$table .= '<tr>
			    			<td colspan="3"><center>No Data Available</center></td>
			    		</tr>';
			    	} // /else
			    $table .= '</tbody>
			</table>
			';
			echo $table;
		} // /check class id
	} 

	public function fetchSectionDataByClass($classId = null)
	{
		if($classId) {
			$sectionData = $this->model_section->fetchSectionDataByClass($classId);
			if($sectionData) {
				foreach ($sectionData as $key => $value) {
					$option .= '<option value="'.$value['section_id'].'">'.$value['section_name'].'</option>';
				} // /foreach
			}
			else {
				$option = '<option value="">No Data</option>';
			} // /else empty section

			echo $option;
		}
	}


	// =======================
	// ===============================
	// ==Attendance=============
	// ============================
	// =====================
	public function fetchAttendaceType($id = null) 
	{
		
			$classData = $this->model_section->fetchSectionDataByClass($id);
			$form = '<div class="form-group">
		    <label for="sectionName" class="col-sm-2 control-label">Lớp học</label>
		    <div class="col-sm-10">
		      <select class="form-control" name="sectionName" id="sectionName">
		      
		      	';
			foreach ($classData as $key => $value) {
		      		$form .= '<option value="'.$value['section_id'].'">'.$value['section_name'].'</option>';
		      	} // /froeac
		      	$form .='</select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="date" class="col-sm-2 control-label">Ngày</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" id="date" name="date" placeholder="Date" autocomplete="off">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		  </div>';		 
		
		

		echo $form;
	}
	public function fetchClassAndSection() 
	{
		$classData = $this->model_classes->fetchClassData();
		$select = '<div class="form-group">
		    <label for="className" class="col-sm-2 control-label">Ngành học</label>
		    <div class="col-sm-10">
		      <select class="form-control" name="className" id="className">
		      	<option value="">Select</option>';		      	
		      	foreach ($classData as $key => $value) {
		      		$select .= '<option value="'.$value['class_id'].'">'.$value['class_name'].'</option>';
		      	}
		      $select .= '</select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="sectionName" class="col-sm-2 control-label">Lớp học</label>
		    <div class="col-sm-10">
		      <select class="form-control" name="sectionName" id="sectionName">
		      	<option value="">Select</option>		      	
		      </select>
		    </div>
		  </div>
		  ';
	  echo $select;
	}

	/*
	*------------------------------------------------
	* fetches the class's section info	
	*------------------------------------------------
	*/
	public function fetchClassSection($classId = null) 
	{
		if($classId) {
			$sectionData = $this->model_section->fetchSectionDataByClass($classId);
			if($sectionData) {
				foreach ($sectionData as $key => $value) {
					$option .= '<option value="'.$value['section_id'].'">'.$value['section_name'].'</option>';
				} // /foreach
			}
			else {
				$option = '<option value="">No Data</option>';
			} // /else empty section

			echo $option;
		}
	}

		public function getScheduleTable($classId = null, $sectionId = null, $date = null) 
	{	
		
		// // student information
		// $studentData = $this->model_student->fetchStudentByClassAndSection($classId, $sectionId);
		// student information
		$subjectData = $this->model_subject->fetchSubjectDataByClass($classId);
		// class information
		$classData = $this->model_classes->fetchClassData($classId);
		// section infromation
		$sectionData = $this->model_section->fetchSectionByClassSection($classId, $sectionId);

		$div = '
		
	    <div class="well">
	    	Ngày : '.$date.'<br />
	    	Ngành học : '.$classData['class_name'].' <br />
	    	Lớp : '.$sectionData['section_name'].' <br /> 
	    </div>		

	    <div id="attendance-message"></div>

	    <form method="post" action="schedule/createSchedule" id="createAttendanceForm">

		    <table class="table table-bordered">
		    	<thead>
		    		<tr>
		    			<th style="width:60%;">Môn học</th>
		    			<th style="width:40%;">Hoạt động</th>
		    		</tr>
		    	</thead>
		    	<tbody>';
		    	if($subjectData) {
		    		$x = 1;
		    		foreach ($subjectData as $key => $value) {
		    			// fetch attedance information through date, class id, section id, and type id
						$scheduleData = $this->model_schedule->fetchSchedule($value['subject_id'], $sectionId, $date,);
			    		$div .= '<tr>
			    			<td>
			    				'.$value['name'].'
			    				<input type="hidden" name="subjectId['.$x.']" id="subjectId" value="'.$value['subject_id'].'" />
			    			</td>
			    			<td>
			    				<select name="schedule_status['.$x.']" id="schedule_status" class="form-control">
			    					<option value="" '; 
									if($scheduleData['schedule_type'] == 0) {
										$div .= 'selected';
									}
									$div .= '></option>
			    					<option value="1" '; 
									if($scheduleData['schedule_type'] == 1) {
										$div .= 'selected';
									}
									$div .= '>Tiết 1-2</option>
			    					<option value="2" '; 
									if($scheduleData['schedule_type'] == 2) {
										$div .= 'selected';
									}
									$div .= '>Tiết 3-4</option>
			    					<option value="3" '; 
									if($scheduleData['schedule_type'] == 3) {
										$div .= 'selected';
									}
									$div .= '>Tiết 5-6</option>
									<option value="4" '; 
									if($scheduleData['schedule_type'] == 4) {
										$div .= 'selected';
									}
									$div .= '>Tiết 7-8</option>
									<option value="5" '; 
									if($scheduleData['schedule_type'] == 5) {
										$div .= 'selected';
									}
									$div .= '>Tiết 9-10</option>

			    				</select>
			    			</td>
			    		</tr>';
			    		$x++;
			    	} // /foreach
		    	} // /if
		    	else {
		    		$div .= '<tr>
		    			<td colspan="3"><center>No Data Available</center></td>
		    		</tr>';
		    	}		    	
		    	$div .= '</tbody>
		    </table>

		    <center>
		    	
		    	<input type="hidden" name="schedule_date" value="'.$date.'" />
		    	<input type="hidden" name="sectionId" value="'.$sectionId.'" />

		    	<button type="submit" class="btn btn-primary"> Lưu thay đổi </button>
		    </center>

	    </form>
		';

		echo $div;
		
			

	}

	/*
	*------------------------------------------------
	* create the attendance
	*------------------------------------------------
	*/
	public function createSchedule()
	{		
		$validator = array('success' => false, 'messages' => array());
		$attendance = $this->model_schedule->createSchedule();

		if($attendance == true) {
			$validator['success'] = true;
			$validator['messages'] = 'Successfully Added';
		}
		else {
			$validator['success'] = false;
			$validator['messages'] = 'Error';	
		}

		echo json_encode($validator);

	}

	/*
	*------------------------------------------------
	* fetch the class and section type
	*------------------------------------------------
	*/
	

	/*
	*------------------------------------------------
	* fetch the attendance report
	*------------------------------------------------
	*/
	public function report($typeId = null, $reportDate = null, $numOfDays = null, $classId = null, $sectionId = null)
	{			
		$year = substr($reportDate, 0, 4);
		$month = substr($reportDate, 5, 7);		

		$classData = $this->model_classes->fetchClassData($classId);
		$sectionData = $this->model_section->fetchSectionByClassSection($classId, $sectionId);

			// student			
			$div = '<div class="well">
				<center>
					<h4> Ngành học: '.$classData['class_name'].'<br> Lớp học : '.$sectionData['section_name'].'<h4>
					<h4> Năm : '.$year.' - Month :'.$month.'<h4>		
					<small>	
						1 : Tiết 1-2 ( 7h00-8h45) <br />				
						2 : Tiết 3-4 (9h-10h45) <br />
						3 : Tiết 5-6 (13h - 14h45)<br />
						4 : Tiết 7-8 (15h-16h45)<br />
							5 : Tiết 9-10 (17h00 - 18h45)<br />
					</small>
				</center>
			</div>

			<div style="overflow-x:auto;">			
			<table class="table table-bordered" style="width:100%;">			
				<tbody style="width:100%;">
					<tr>
						<td style="width:25%;">Môn học</td>
						';		
						// loop for days
						for($i = 1; $i <= $numOfDays; $i++) {
							$div .= '
								<td style="width:10%;">'.$i.'</td>';	
						} // /for
					$div .= '</tr>';
						
					$subjectInfo = $this->model_subject->fetchSubjectDataByClass($classId);

					foreach ($subjectInfo as $key => $value) {
						$subjectName = $value['name'];
						$div .= '
							<tr>
							<td>'.$subjectName.'</td>';

							for($i = 1; $i <= $numOfDays; $i++) {
								// $attendanceData = $this->model_attendance->getAttendance($i, $reportDate, $value['student_id'], $typeId, $classId, $sectionId);
								$scheduleData = $this->model_schedule->getAttendance($i, $reportDate, $value['subject_id'], $sectionId);
								
								$div .= '<td>';
								foreach ($scheduleData as $scheduleKey => $scheduleValue) {

									if($scheduleValue['schedule_type'] == 1) {
										// Có mặt
										$scheduleStatus = '<span class="label label-success">1</span>';	
									} else if($scheduleValue['schedule_type'] == 2) {
										// Vắng
										$scheduleStatus = '<span class="label label-primary">2</span>';	
									} else if($scheduleValue['schedule_type'] == 3) {
										// Trễ
										$scheduleStatus = '<span class="label label-warning">3</span>';	
									} else if($scheduleValue['schedule_type'] == 4) {
										// Trễ
										$scheduleStatus = '<span class="label label-warning">4</span>';	
									}
									else
									{
									// Không xác định
										$scheduleStatus = '<span class="label label-danger">5</span>';	
									}
									
									$div .= $scheduleStatus;
								}
								$div .= '
									</td>';	
								} // /for								

						$div .= '</tr>';		
					} // /foreach
				$div .= '</tbody>
				</table>
			<div>';			
			echo $div;
		

		
	}

}