var manageStudentTable;
var studentSectionTable = {};
var base_url = $("#base_url").val();


$(document).ready(function() {
	$("#topTimelineNav").addClass('active'); 

	var request = $("#request").text();

	// Attendance
	// ============
	if(request == 'add') { 
		// manage marksheet
		$("#manageMarksheet").addClass('active');

		/*
		*-------------------------------
		* fetches the class section
		* information 	
		*-------------------------------
		*/
		var classSideBar = $(".classSideBar").attr('id');
		var subId = classSideBar.substring(7);

		getClassSection(subId);
	} 
	else if(request == 'report') {
	}// /.else report
	

}); // /.document ready

/*
*----------------------------
* get class section function
*----------------------------
*/
function getClassSection(subId = null, studentId =null) 
{
	// console.log(studentId);
	if(subId && studentId) {
		$(".list-group-item").removeClass('active');
		$("#subId"+subId).addClass('active');

		$('.result').load(base_url + 'home/fetchMarksheetTable/' + subId+'/'+studentId, function() {
				// console.log(base_url + 'home/fetchMarksheetTable/' + subId);
			$('#date').calendarsPicker({
				dateFormat: 'yyyy-mm-dd'
			});

		});
				
	}
}

/*
*----------------------------
* add marksheet function
*----------------------------
*/



function addMarksheet(classId = null) 
{
	if(classId) {		

		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();
		$('#add-marksheet-message').html('');
		$("#addMarksheetForm")[0].reset();

		/*
		* -----------------------------------
		* submits the add marksheet form
		* -----------------------------------
		*/
		$("#addMarksheetForm").unbind('submit').bind('submit', function() {
			var form = $(this);
			var url = form.attr('action');
			var type = form.attr('method');
			// console.log(url);
			// console.log(type);
			$.ajax({
				url: url + '/' + classId,
				type: type,
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					
					if(response.success == true) {						
						$("#add-marksheet-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');		
						
						$('.form-group').removeClass('has-error').removeClass('has-success');
						$('.text-danger').remove();			

						$("#manageMarksheetTable").load('marksheet/fetchUpdateMarksheetTable/' + classId);
						$("#addMarksheetForm")[0].reset();
					}	
					else {															
						$.each(response.messages, function(index, value) {
							var key = $("#" + index);

							key.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.find('.text-danger').remove();							

							key.after(value);
						});						
							
					} // /else
				} // /.success
			}); // /.ajax
			return false;
		}); // /submi the add markhseet form
	}
}


/*
*----------------------------
* update marksheet function
*----------------------------
*/
function editMarksheet(marksheetId = null, classId = null)
{
	if(marksheetId) {

		$("#editMarksheetForm")[0].reset();
		$('form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();
		$('#edit-marksheet-message').html('');

		$("#editDate").calendarsPicker({
			dateFormat: 'yyyy-mm-dd'
		});

		$.ajax({
			url: base_url + 'marksheet/fetchMarksheetDataByMarksheetId/'+marksheetId,
			type: 'post',
			dataType: 'json',
			success:function(response) {
				$("#editMarksheetName").val(response.marksheet_name);
				$("#editDate").val(response.marksheet_date);

				/*
				*-------------------------------------------------------
				* submit the update marksheet form
				*-------------------------------------------------------
				*/
				$("#editMarksheetForm").unbind('submit').bind('submit', function() {
					var form = $(this);
					var url = form.attr('action');
					var type = form.attr('method');

					$.ajax({
						url: url + '/' + marksheetId + '/' + classId,
						type: type,
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success == true) {						
								$("#edit-marksheet-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  response.messages + 
								'</div>');		
								
								$('.form-group').removeClass('has-error').removeClass('has-success');
								$('.text-danger').remove();			

								$("#manageMarksheetTable").load('marksheet/fetchUpdateMarksheetTable/' + classId);								
							}	
							else {															
								$.each(response.messages, function(index, value) {
									var key = $("#" + index);

									key.closest('.form-group')
									.removeClass('has-error')
									.removeClass('has-success')
									.addClass(value.length > 0 ? 'has-error' : 'has-success')
									.find('.text-danger').remove();							

									key.after(value);
								});															
							} // /else
						} // /.success
					}); // /.ajax

					return false;
				});

			} // /.success
		}); // /.ajax
	} // /.if
}

/*
*------------------------------------------------
* remove marksheet
*------------------------------------------------
*/ 
function addTimetable(scheduleId = null, studentId = null, subId=null)
{
	if(scheduleId && studentId && subId) {		
		// remove marksheet btn clicked in the modal
		$("#addTimetableBtn").unbind('click').bind('click', function() {
			// console.log(base_url + 'home/create/'+scheduleId+'/'+studentId);
			$.ajax({
				url: base_url + 'home/create/'+scheduleId+'/'+studentId,
				type: 'post',
				dataType:'json',
				success:function(response) {
				
					$("#addTimetableModal").modal('hide');

					if(response.success == true) {
						$("#remove-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');						

						$("#manageMarksheetTable").load('home/fetchUpdateMarksheetTable/'+subId+'/'+studentId);
					} 
					else {
						$("#remove-message").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');
					}
				}
			});
		}); // /.remove marksheet btn clicked
	}
}

/*
*------------------------------------------------
* remove marksheet
*------------------------------------------------
*/ 
function removeTimetable(scheduleId = null, studentId = null, subId=null)
{
	if(scheduleId && studentId && subId) {		
		// remove marksheet btn clicked in the modal
		$("#removeTimetableBtn").unbind('click').bind('click', function() {
			// console.log(base_url + 'home/create/'+scheduleId+'/'+studentId);
			$.ajax({
				url: base_url + 'home/remove/'+scheduleId+'/'+studentId,
				type: 'post',
				dataType:'json',
				success:function(response) {
				
					$("#removeTimetableModal").modal('hide');

					if(response.success == true) {
						$("#remove-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');						

						$("#manageMarksheetTable").load('home/fetchUpdateMarksheetTable/'+subId+'/'+studentId);
					} 
					else {
						$("#remove-message").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');
					}
				}
			});
		}); // /.remove marksheet btn clicked
	}
}

/*
*----------------------------------------------------------------------
* MANAGE MARKS OF STUDENT'S MARKSHEET
*----------------------------------------------------------------------
*/
function editMarks(studentId = null, classId = null)
{
	if(studentId && classId) {
		var marksheetId = $("#marksheet_id").val();

		$("#edit-mark-result").load(base_url + 'marksheet/studentMarksheetData/'+studentId+'/'+classId+'/'+marksheetId, function() {

			/*clearing the form error message*/
			$("#createStudentMarksForm")[0].reset();
			$(".form-group").removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
			$('#edit-mark-message').html('');

			$("#createStudentMarksForm").unbind('submit').bind('submit', function() {
				var form = $(this);
				var url = form.attr('action');
				var type = form.attr('method');

				$.ajax({
					url: url,
					type: type,
					data: form.serialize(),
					dataType: 'json',
					success:function(response) {
						if(response.success == true) {
							$("#edit-mark-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  response.messages + 
							'</div>');						

							$(".form-group").removeClass('has-error').removeClass('has-success');
							$('.text-danger').remove();							

						} 
						else {
							$.each(response.messages, function(index, value) {
								var key = $("#" + index);

								key.closest('.form-group')
								.removeClass('has-error')
								.removeClass('has-success')
								.addClass(value.length > 0 ? 'has-error' : 'has-success')
								.find('.text-danger').remove();							

								key.after(value);
							});		
						}
					} // /.successs
				});  // /.ajax
				return false;
			});
		});
	}
}

/*
*----------------------------------------------------------------------
* VIEW MARKS OF STUDENT'S MARKSHEET
*----------------------------------------------------------------------
*/
function viewMarks(studentId = null, classId = null)
{	
	if(studentId && classId) {		
		marksheetId = $("#marksheet_id").val();		
		$("#view-mark-result").load(base_url + 'marksheet/viewStudentMarksheet/'+studentId+'/'+classId+'/'+marksheetId);
	}
}

