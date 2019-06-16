var manageStudentTable;
var studentSectionTable = {};
var base_url = $("#base_url").val();
 
$(document).ready(function() {
	$("#topScheduleNav").addClass('active'); 

	var request = $("#request").text();

	// Attendance
	// ============
	if(request == 'add') { 

		$("#takeScheduleNav").addClass('active');


		// select on the attendance type 
		$("#type").unbind('change').bind('change', function() {
			var id = $(this).val();			
			$('.result').load(base_url + 'schedule/fetchAttendaceType/'+id, function() {
				$("#attendance-result").html('');

				$('#date').calendarsPicker({
					dateFormat: 'yyyy-mm-dd'
				});

				// $("#className").unbind('change').bind('change', function() {
				// 	var classId = $(this).val();
				// 	$("#sectionName").load( base_url + 'schedule/fetchClassSection/'+classId);
				// });
				
				$("#getAttendanceForm").unbind('submit').bind('submit', function() {

						var className = $("#type").val();			
						var sectionName = $("#sectionName").val();
						var date = $("#date").val();

						if(className == "") {
							$("#className").closest('.form-group').removeClass('has-success').addClass('has-error');
							$("#className").after('<p class="text-danger">The Class field is required</p>');
						} 
						else {
							$("#className").closest('.form-group').removeClass('has-error').addClass('has-success');	
							$(".text-danger").remove();
						}

						if(sectionName == "") {
							$("#sectionName").closest('.form-group').removeClass('has-success').addClass('has-error');
							$("#sectionName").after('<p class="text-danger">The Section field is required</p>');
						} 
						else {
							$("#sectionName").closest('.form-group').removeClass('has-error').addClass('has-success');	
							$(".text-danger").remove();
						}

						if(date == "") {
							$("#date").closest('.form-group').removeClass('has-success').addClass('has-error');
							$("#date").after('<p class="text-danger">The Date field is required</p>');
						} 
						else {
							$("#date").closest('.form-group').removeClass('has-error').addClass('has-success');	
							$(".text-danger").remove();
						}

						if(className && sectionName && date) {
							$(".form-group").removeClass('has-error').removeClass('has-success');

							$("#attendance-result").load( base_url + 'schedule/getScheduleTable/'+className+'/'+sectionName + '/' + date, function() {
								// submit the attendance form

								$("#createAttendanceForm").unbind('submit').bind('submit', function() {
									var form = $(this);
									var url = form.attr('action');
									var type = form.attr('method');
									console.log(form);
									console.log(url);
									console.log(type); 
									$.ajax({
										url: url,
										type: type,
										data: form.serialize(),
										dataType: 'json',
										success:function(response) {
											console.log(response);
											if(response.success == true) {
												$("#attendance-message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
												  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
												  response.messages + 
												'</div>');
											}
											else {
												$("#attendance-message").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
												  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
												  response.messages + 
												'</div>');
											}
										} // /success
									}); // /ajax
									return false;
								});
							});
						}	
						
					return false;
				});	 // /get student for attendance form				
				
			}); 
		}); // /select on the attendance type
		
	} 
	else if(request == 'report') {
		$("#scheduleRepott").addClass('active');

		/* 
		*----------------------------------------------------
		* select the attendance type
		*----------------------------------------------------
		*/
		$("#className").unbind('change').bind('change', function() {
			var typeId = $(this).val();

			// if(typeId == 1) {
				$("#student-form").load(base_url + 'schedule/fetchClassAndSection', function() {
					$("#className").unbind('change').bind('change', function() {
						var classId = $(this).val();
						$("#sectionName").load('schedule/fetchClassSection/'+classId);
					});
				});
			// } 
			// else {
			// 	$("#student-form").html('');
			// }
		});	

		$("#reportDate").calendarsPicker({			
			calendar: $.calendars.instance(),		
			dateFormat: 'yyyy-mm',								
			onChangeMonthYear: function(year, month) { 								
				if(month < 10) {
					$('#reportDate').val(year + '-' + '0' + month); 						
				} else {
					$('#reportDate').val(year + '-' + month); 
				} // /else       
				daysInMonth(month, year);
    	},
    	onShow: function(picker, calendar, inst) { 
        	picker.find('table').addClass('alternate-dates'); 
	    },
	    onSelect: function(dates) { 	    	
	    	var minDate = dates[0]; 
	        for (var i = 1; i < dates.length; i++) { 
	            if (dates[i].getTime() < minDate.getTime()) { 
	                minDate = dates[i]; 
	            } // /if
	        }  // /for
	        var year = minDate.year();
	        var month = minDate.month();
		    	daysInMonth(month, year);
		    }  	 
		}); // attendance report date

		function daysInMonth(month,year) {						
			var pc = $.calendars.instance();
			var dim = pc.daysInMonth(year, month);    	
    		
    		$("#num_of_days").val(dim);
		}	


		/*
		*----------------------------------------------------
		*click on the generate report btn
		*----------------------------------------------------
		*/
		$("#getAttendanceReport").unbind('submit').bind('submit', function() {	
			var form = $(this);

			var type = $("#className").val();
			var reportDate = $("#reportDate").val();


			if(type == "") {
				$("#className").closest('.form-group').removeClass('has-success').addClass('has-error');
				$("#className").after('<p class="text-danger">The Type field is required</p>');
			} 
			else {
				$("#className").closest('.form-group').removeClass('has-error').addClass('has-success');	
				$(".text-danger").remove();
			}

			if(reportDate == "") {
				$("#reportDate").closest('.form-group').removeClass('has-success').addClass('has-error');
				$("#reportDate").after('<p class="text-danger">The Date field is required</p>');
			} 
			else {
				$("#reportDate").closest('.form-group').removeClass('has-error').addClass('has-success');	
				$(".text-danger").remove();
			}

			if(type && reportDate) {
				$('.form-group').removeClass('has-error').removeClass('has-success');
				$('.text-danger').remove();

				var num_of_days = $("#num_of_days").val();
				var className = $("#className").val();
				var sectionName = $("#sectionName").val();

				if($("#className").val() == "") {
						$("#className").closest('.form-group').removeClass('has-success').addClass('has-error');
						$("#className").after('<p class="text-danger">The Date field is required</p>');
					} 
					else {
						$("#className").closest('.form-group').removeClass('has-error').addClass('has-success');	
						$(".text-danger").remove();
					}				

					if($("#sectionName").val() == "") {
						$("#sectionName").closest('.form-group').removeClass('has-success').addClass('has-error');
						$("#sectionName").after('<p class="text-danger">The Date field is required</p>');
					} 
					else {
						$("#sectionName").closest('.form-group').removeClass('has-error').addClass('has-success');	
						$(".text-danger").remove();
					}		

					if($("#className").val() && $("#sectionName").val()) {
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$('.text-danger').remove();

						var url = form.attr('action') + '/' + type + '/' + reportDate + '/' + num_of_days + '/' + className + '/' + sectionName;
						$("#report-div").load(url);
					} // /if						 
			}
			return false;
			
			
		});
	}// /.else report
	// ========//End Attendance

		$("#manageMarks").addClass('active');

		$("#className").unbind('change').bind('change', function() {

			var classId = $(this).val();

			$("#sectionName").load(base_url +'schedule/fetchSectionDataByClass/'+classId);		

			
		});			

	
}); // /.document ready

/*
*----------------------------
* get class section function
*----------------------------
*/
function getClassSection(classId = null) 
{
	if(classId) {
		$(".list-group-item").removeClass('active');
		$("#classId"+classId).addClass('active');

		$('.result').load(base_url + 'schedule/fetchMarksheetTable/' + classId, function() {
			$('#date').calendarsPicker({
				dateFormat: 'yyyy-mm-dd'
			});

		});
				
	}
}

