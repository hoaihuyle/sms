
<?php 
	
?>

<div id="request" class="div-hide"><?php echo $this->input->get('atd'); ?></div>

<ol class="breadcrumb">
  <li><a href="<?php echo base_url('home') ?>">Trang chủ</a></li> 
  <?php   
  if($this->input->get('atd') == 'add') {
    echo '<li class="active">Đăng kí lịch học</li>';
  } 
  else if ($this->input->get('atd') == 'report') {
    echo '<li class="active">Xem lịch học</li>';
  }   
  ?>  
</ol>
<?php   
	if($this->input->get('atd') == 'add') {
// echo "Add attendance";
?>
<div style="margin: 15px;">
	<div class="panel panel-default">
		<div class="panel-heading">
			<p><?php if($className) echo ('Ngành học : '.$className[0]['class_name']); else echo ('Ngành học : '); ?></p>  	
		</div>
	<!-- /panle-bdy -->
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				
				<div class="panel-heading">
					
					Danh sách các môn học thuộc chuyên ngành học 
				</div>
				<div class="list-group">			
					<?php 
					if($subjectData) {
						$x = 1; 
						foreach ($subjectData as $value) { 
						?>
							<a class="list-group-item classSideBar <?php if($x == 1) { echo 'active'; } ?>" onclick="getClassSection(<?php echo ($value['subject_id'].','.$userData) ?>)" id="classId<?php echo $value['subject_id'] ?>">
					    		<?php echo $value['name'].' '; ?>(<?php echo'Thang điểm:  '.$value['total_mark']; ?>)
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
			  <div class="panel-heading">Quản lý lịch môn học </div>
			  
			  <div class="panel-body">		  
			  	<div id="remove-message"></div>

			  	<div class="result"></div>
			  </div>			  
			</div>
		</div>
		<!-- /col-md-8 -->
	</div>
</div>
	<!-- /row -->
<?php
} // /add attendance
else{
// echo "report";        
?>   
<br/>
<h1 class="codyhouse"> THỜI KHÓA BIỂU CÁC MÔN HỌC</h1>
<div class="cd-schedule loading">
	<div class="timeline">
		<ul>
			<li><span>07:00</span></li>
			<li><span>07:30</span></li>
			<li><span>8:00</span></li>
			<li><span>8:30</span></li>
			<li><span>9:00</span></li>
			<li><span>9:30</span></li>
			<li><span>10:00</span></li>
			<li><span>10:30</span></li>
			<li><span>11:00</span></li>
			<li><span>11:30</span></li>
			<li><span>12:00</span></li>
			<li><span>12:30</span></li>
			<li><span>13:00</span></li>
			<li><span>13:30</span></li>
			<li><span>14:00</span></li>
			<li><span>14:30</span></li>
			<li><span>15:00</span></li>
			<li><span>15:30</span></li>
			<li><span>16:00</span></li>
			<li><span>16:30</span></li>
			<li><span>17:00</span></li>
			<li><span>17:30</span></li>
			<li><span>18:00</span></li>
			<li><span>18:30</span></li>
			<li><span>19:00</span></li>
		</ul>
	</div> <!-- .timeline -->

	<div class="events">
		<ul>
			<li class="events-group">
				<div class="top-info"><span>Thứ</span></div>

				<ul>
					<li class="single-event" data-start="17:00" data-end="19:00" data-content="event-abs-circuit" data-event="event-1">
						<a href="#0">
							<em class="event-name">Abs Circuit</em>
						</a>
					</li>

					<li class="single-event" data-start="11:00" data-end="12:30" data-content="event-rowing-workout" data-event="event-2">
						<a href="#0">
							<em class="event-name">Rowing Workout</em>
						</a>
					</li>

					<li class="single-event" data-start="14:00" data-end="15:15"  data-content="event-yoga-1" data-event="event-3">
						<a href="#0">
							<em class="event-name">Yoga Level 1</em>
						</a>
					</li>
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info"><span>Thứ 3</span></div>

				<ul>
					<li class="single-event" data-start="10:00" data-end="11:00"  data-content="event-rowing-workout" data-event="event-2">
						<a href="#0">
							<em class="event-name">Rowing Workout</em>
						</a>
					</li>

					<li class="single-event" data-start="11:30" data-end="13:00"  data-content="event-restorative-yoga" data-event="event-4">
						<a href="#0">
							<em class="event-name">Restorative Yoga</em>
						</a>
					</li>

					<li class="single-event" data-start="13:30" data-end="15:00" data-content="event-abs-circuit" data-event="event-1">
						<a href="#0">
							<em class="event-name">Abs Circuit</em>
						</a>
					</li>

					<li class="single-event" data-start="15:45" data-end="16:45"  data-content="event-yoga-1" data-event="event-3">
						<a href="#0">
							<em class="event-name">Yoga Level 1</em>
						</a>
					</li>
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info"><span>Thứ 4</span></div>

				<ul>
					<li class="single-event" data-start="09:00" data-end="10:15" data-content="event-restorative-yoga" data-event="event-4">
						<a href="#0">
							<em class="event-name">Restorative Yoga</em>
						</a>
					</li>

					<li class="single-event" data-start="10:45" data-end="11:45" data-content="event-yoga-1" data-event="event-3">
						<a href="#0">
							<em class="event-name">Yoga Level 1</em>
						</a>
					</li>

					<li class="single-event" data-start="12:00" data-end="13:45"  data-content="event-rowing-workout" data-event="event-2">
						<a href="#0">
							<em class="event-name">Rowing Workout</em>
						</a>
					</li>

					<li class="single-event" data-start="13:45" data-end="15:00" data-content="event-yoga-1" data-event="event-3">
						<a href="#0">
							<em class="event-name">Yoga Level 1</em>
						</a>
					</li>
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info"><span>Thứ 5</span></div>

				<ul>
					<li class="single-event" data-start="09:30" data-end="10:30" data-content="event-abs-circuit" data-event="event-1">
						<a href="#0">
							<em class="event-name">Abs Circuit</em>
						</a>
					</li>

					<li class="single-event" data-start="12:00" data-end="13:45" data-content="event-restorative-yoga" data-event="event-4">
						<a href="#0">
							<em class="event-name">Restorative Yoga</em>
						</a>
					</li>

					<li class="single-event" data-start="15:30" data-end="16:30" data-content="event-abs-circuit" data-event="event-1">
						<a href="#0">
							<em class="event-name">Abs Circuit</em>
						</a>
					</li>

					<li class="single-event" data-start="17:00" data-end="18:30"  data-content="event-rowing-workout" data-event="event-2">
						<a href="#0">
							<em class="event-name">Rowing Workout</em>
						</a>
					</li>
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info"><span>Thứ 6</span></div>

				<ul>
					<li class="single-event" data-start="10:00" data-end="11:00"  data-content="event-rowing-workout" data-event="event-2">
						<a href="#0">
							<em class="event-name">Rowing Workout</em>
						</a>
					</li>

					<li class="single-event" data-start="12:30" data-end="14:00" data-content="event-abs-circuit" data-event="event-1">
						<a href="#0">
							<em class="event-name">Abs Circuit</em>
						</a>
					</li>

					<li class="single-event" data-start="15:45" data-end="16:45"  data-content="event-yoga-1" data-event="event-3">
						<a href="#0">
							<em class="event-name">Yoga Level 1</em>
						</a>
					</li>
				</ul>
			</li>

			<li class="events-group">
				<div class="top-info"><span>Thứ 7</span></div>

				<ul>
					<li class="single-event" data-start="10:00" data-end="11:00"  data-content="event-rowing-workout" data-event="event-2">
						<a href="#0">
							<em class="event-name">Rowing Workout</em>
						</a>
					</li>

					<li class="single-event" data-start="12:30" data-end="14:00" data-content="event-abs-circuit" data-event="event-1">
						<a href="#0">
							<em class="event-name">Abs Circuit</em>
						</a>
					</li>

					<li class="single-event" data-start="15:45" data-end="16:45"  data-content="event-yoga-1" data-event="event-3">
						<a href="#0">
							<em class="event-name">Yoga Level 1</em>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>

	<div class="event-modal">
		<header class="header">
			<div class="content">
				<span class="event-date"></span>
				<h3 class="event-name"></h3>
			</div>

			<div class="header-bg"></div>
		</header>

		<div class="body">
			<div class="event-info"></div>
			<div class="body-bg"></div>
		</div>

		<a href="#0" class="close">Close</a>
	</div>

	<div class="cover-layer"></div>
</div> <!-- .cd-schedule -->


<?php 
	}//report
	?>
<!-- Add markshet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addTimetableModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Đăng ký môn học</h4>
      </div>
      <div class="modal-body">
        <p>Bạn có thực sự muốn đăng ký?</p>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" id="addTimetableBtn">Đăng ký</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- remove markshet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeTimetableModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hủy đăng ký</h4>
      </div>
      <div class="modal-body">
        <p>Bạn có thực sự muốn hủy đăng ký?</p>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" id="removeTimetableBtn">Hủy đăng ký</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" src="<?php echo base_url('custom/js/home.js') ?>"></script>

<?php

?>
