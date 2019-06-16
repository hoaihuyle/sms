var manageStudentTable;
var studentSectionTable = {};
var base_url = $("#base_url").val();
console.log(base_url);

$(document).ready(function() {
	$("#topTimelineNav").addClass('active'); 

	var request = $("#request").text();

	// Attendance
	// ============
	if(request == 'add') { 
	} 
	else if(request == 'report') {
	}// /.else report
	

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

