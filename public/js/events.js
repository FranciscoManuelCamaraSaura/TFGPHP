const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

function timetable($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/events/" + school + "/person/" + person + "/timetable?type_user=" + $type_user;
}

function calendar($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/events/" + school + "/person/" + person + "/calendar?type_user=" + $type_user;
}

function addEvent($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/events/" + school + "/person/" + person + "/addEvent?type_user=" + $type_user;
}

function editEvents($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/events/" + school + "/person/" + person + "/editEvents?type_user=" + $type_user;
}

function back($page) {
	var calendar_menu = $page * -1;

	window.history.go(calendar_menu);
}

function createDataPicker() {
	var datesDisabled = getHolidays();

	$("#datepickerExam").datepicker({
		language: "es",
		autoclose: true,
		clearBtn: true,
		datesDisabled: datesDisabled,
		endDate: "30/06/2022",
		daysOfWeekDisabled: [0, 6],
		startDate: "01/09/2021",
		todayHighlight: true
	});

	$("#datepickerEvent").datepicker({
		language: "es",
		autoclose: true,
		clearBtn: true,
		datesDisabled: datesDisabled,
		endDate: "30/06/2022",
		// daysOfWeekDisabled: [0, 6],
		startDate: "01/09/2021",
		todayHighlight: true
	});
}

function getHolidays() {
	var datesDisabled = [
		// Días previos al inicio del curso
		"01/09/2021",
		"02/09/2021",
		"03/09/2021",
		"06/09/2021",
		"07/09/2021",

		// Días festivos
		"12/10/2021",
		"01/11/2021",
		"06/12/2021",
		"08/12/2021",

		// Vacaciones de Navidad
		"23/12/2021",
		"24/12/2021",
		"27/12/2021",
		"28/12/2021",
		"29/12/2021",
		"30/12/2021",
		"31/12/2021",
		"03/01/2022",
		"04/01/2022",
		"05/01/2022",
		"06/01/2022",
		"07/01/2022",

		// Vacaciones de Pascua
		"14/04/2022",
		"15/04/2022",
		"18/04/2022",
		"19/04/2022",
		"20/04/2022",
		"21/04/2022",
		"22/04/2022",
		"25/04/2022",

		// Días posteriores al fin del curso
		"21/06/2022",
		"22/06/2022",
		"23/06/2022",
		"24/06/2022",
		"27/06/2022",
		"28/06/2022",
		"29/06/2022",
		"30/06/2022"
	];

	return datesDisabled;
}

function showForm() {
	var event = $('[name="typeEvent"]:checked').val();

	if(event === "exam") {
		$("#error").hide();
		$("#radioButtonContent").hide();
		$("#examData").show();
	} else if(event === "event") {
		$("#error").hide();
		$("#radioButtonContent").hide();
		$("#eventData").show();
	} else {
		var errores = "You must chouse a event type";
		showErrors(errores);
	}
}

function validateCourse($school, $person, $type_user) {
	fetch("/group", {
		method : "POST",
		body: JSON.stringify({
			school : $school,
			person : $person,
			course : $("#course option:selected").val(),
			type_user : $type_user
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		var groupsSelect = "<option disabled=\"disabled\" selected=\"selected\">Seleccione un grupo</option>";
		var subjectsSelect = "<option disabled=\"disabled\" selected=\"selected\">Seleccione una asignatura</option>";

		for (let i in data.groups) {
			groupsSelect += "<option value=\"" + data.groups[i] + "\">" + data.groups[i] + "</option>";
		}

		$("#group").html(groupsSelect);
		$("#subjects").html(subjectsSelect);
	}).catch(error => console.error(error));
}

function validateGroup($school, $person) {
	fetch("/subjects", {
		method : "POST",
		body: JSON.stringify({
			school : $school,
			person : $person,
			course : $("#course option:selected").val(),
			group : $("#group option:selected").val()
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		var subjectsSelect = "<option disabled=\"disabled\" selected=\"selected\">Seleccione una asignatura</option>";

		for (let i in data.subjects) {
			subjectsSelect += "<option value=\"" + data.subjects[i].code + "\">" + data.subjects[i].name + "</option>";
		}

		$("#subjects").html(subjectsSelect);
	}).catch(error => console.error(error));
}

function save($school, $person) {
	var event = $('[name="typeEvent"]:checked').val();
	var date = "";
	var course = $("#course option:selected").val();
	var group = $("#group option:selected").val();
	var subject = $("#subjects option:selected").val();
	var type_exam = $('[name="typeExam"]:checked').val();
	var evaluation = $("#evaluationSelect").val();
	var name = "";
	var description = "";
	var duration = 1;

	if(event === "exam") {
		date = $("#datepickerExam").data("datepicker").getFormattedDate('dd/mm/yyyy');
		name = $("#nameExam").val();
		description = $("#descriptionExamTextArea").val();
	} else {
		date = $("#datepickerEvent").data("datepicker").getFormattedDate('dd/mm/yyyy');
		name = $("#nameEvent").val();
		duration = $("#timeEvent").val();
		description = $("#descriptionEventTextArea").val();
	}

	var errores = validationData(event, date, course, group, subject, type_exam, evaluation, name, description, duration);

	if(errores === "") {
		$("#error").hide();

		fetch("/newEvent", {
			method : "PUT",
			body: JSON.stringify({
				school : $school,
				person : $person,
				date : date,
				name : name,
				description : description,
				duration : duration
			}),
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-Token": csrfToken
			}
		}).then(response => {
			return response.json();
		}).then(data => {
			if(event === "exam") {
				saveExam(data.id, course, group, subject, type_exam, evaluation);
			} else {
				cancel();
			}
		}).catch(error => console.error(error));
	} else {
		showErrors(errores);
	}
}

function saveExam(event, course, group, subject, type_exam, evaluation) {
	fetch("/newExam", {
		method : "PUT",
		body: JSON.stringify({
			event : event,
			course : parseInt(course),
			group : group,
			subject : subject,
			type_exam : type_exam,
			evaluation : evaluation
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		cancel();
	}).catch(error => console.error(error));
}

function cancel() {
	$("#radioButtonContent").show();
	$("#examData").hide();
	$("#eventData").hide();
}

function editEvent($school, $person, $event, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	var url = new URL(window.location.protocol + "//" + window.location.host + "/events/" + school + "/person/" + person + "/editEvent"); 

	const params = {
		event : $event,
		type_user : $type_user
	};

	Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

	window.location.href = url;
}

function update($date, $type_exam, $is_exam) {
	if ($is_exam == true) {
		$("#datepickerExam").datepicker().datepicker("setDate", $date);

		$("#dateExamLabel").hide();
		$("#curseExamLabel").hide();
		$("#groupExamLabel").hide();
		$("#subjectExamLabel").hide();
		$("#typeExamExamLabel").hide();
		$("#evaluationExamLabel").hide();
		$("#nameExamLabel").hide();
		$("#descriptionExamLabel").hide();
		$("#updateExamButton").hide();
		$("#backExamButton").hide();

		$("#datepickerExam").show();
		$("#course").show();
		$("#group").show();
		$("#subjects").show();
		$("#typeExamForm").show();
		$("#evaluationSelect").show();
		$("#nameExam").show();
		$("#descriptionExamTextArea").show();
		$("#saveExamButton").show();
		$("#cancelExamButton").show();

		setExamType($type_exam);
	} else {
		$("#datepickerEvent").datepicker().datepicker("setDate", $date);

		$("#dateEventLabel").hide();
		$("#nameEventLabel").hide();
		$("#timeLabel").hide();
		$("#descriptionEventLabel").hide();
		$("#updateEventButton").hide();
		$("#backEventButton").hide();

		$("#datepickerEvent").show();
		$("#nameEvent").show();
		$("#timeEvent").show();
		$("#descriptionEventTextArea").show();
		$("#saveEventButton").show();
		$("#cancelEventButton").show();
	}
}

function setExamType($type_exam) {
	var typeExam = document.getElementsByName("typeExam");

	for(i = 0; i < typeExam.length; i++) {
		if(typeExam[i].value == $type_exam) {
			document.getElementById(typeExam[i].id).checked = true;
		}
	}
}

function updateEvent($school, $person, $event, $exam, $is_exam) {
	var event = "";
	var date = "";
	var course = "";
	var group = "";
	var subject = "";
	var evaluation = "";
	var type_exam = $('[name="typeExam"]:checked').val();
	var name = "";
	var description = "";
	var duration = 0;

	if($is_exam == true) {
		event = "exam";
		date = $("#datepickerExam").data("datepicker").getFormattedDate('dd/mm/yyyy');
		course = $("#course option:selected").val();
		group = $("#group option:selected").val();
		subject = $("#subjects option:selected").val();
		evaluation = $("#evaluationSelect option:selected").val();
		name = $("#nameExam").val();
		description = $("#descriptionExamTextArea").val();
	} else {
		event = "event";
		date = $("#datepickerEvent").data("datepicker").getFormattedDate('dd/mm/yyyy');
		name = $("#nameEvent").val();
		duration = $("#timeEvent").val();
		description = $("#descriptionEventTextArea").val();
	}

	var errores = validationData(event, date, course, group, subject, type_exam, evaluation, name, description, duration);

	if(errores === "") {
		$("#error").hide();

		fetch("/editEvent", {
			method : "PUT",
			body: JSON.stringify({
				school : $school,
				person : $person,
				event : $event,
				date : date,
				name : name,
				description : description,
				duration : duration
			}),
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-Token": csrfToken
			}
		}).then(response => {
			return response.json();
		}).then(data => {
			if(event === "exam") {
				editExam($exam, course, group, subject, type_exam, evaluation);
			}

			location.reload();
		}).catch(error => console.error(error));
	} else {
		showErrors(errores);
	}
}

function validationData(event, date, course, group, subject, type_exam, evaluation, name, description, duration) {
	var errores = "";

	if(date === "") {
		errores += "You must chouse a date" + "<br>";
	}

	if (event === "exam") {
		if(course === "Seleccione un curso") {
			errores += "You must chouse a course" + "<br>";
		}

		if(group === "Seleccione un grupo") {
			errores += "You must chouse a group" + "<br>";
		}

		if(subject === "Seleccione una asignatura") {
			errores += "You must chouse a subject" + "<br>";
		}

		if(type_exam === "") {
			errores += "You must chouse a exam type" + "<br>";
		}

		if(evaluation === "Seleccione una evaluación") {
			errores += "You must chouse a evaluation period" + "<br>";
		}
	} else {
		if(duration === "") {
			errores += "You must chouse the events duration" + "<br>";
		}
	}

	if(name === "") {
		errores += "You must indicate a event title" + "<br>";
	}

	if(description === "") {
		errores += "You must indicate a event description" + "<br>";
	}

	return errores;
}

function editExam($exam, course, group, subject, type_exam, evaluation) {
	fetch("/editExam", {
		method : "PUT",
		body: JSON.stringify({
			id : $exam,
			course : parseInt(course),
			group : group,
			subject : subject,
			type_exam : type_exam,
			evaluation : evaluation
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
	}).catch(error => console.error(error));
}

function cancelEdition($is_exam) {
	if ($is_exam == true) {
		$("#dateExamLabel").show();
		$("#curseExamLabel").show();
		$("#groupExamLabel").show();
		$("#subjectExamLabel").show();
		$("#typeExamExamLabel").show();
		$("#evaluationExamLabel").show();
		$("#nameExamLabel").show();
		$("#descriptionExamLabel").show();
		$("#updateExamButton").show();
		$("#backExamButton").show();

		$("#datepickerExam").hide();
		$("#course").hide();
		$("#group").hide();
		$("#subjects").hide();
		$("#typeExamForm").hide();
		$("#evaluationSelect").hide();
		$("#nameExam").hide();
		$("#descriptionExamTextArea").hide();
		$("#saveExamButton").hide();
		$("#cancelExamButton").hide();
	} else {
		$("#dateEventLabel").show();
		$("#nameEventLabel").show();
		$("#timeLabel").show();
		$("#descriptionEventLabel").show();
		$("#updateEventButton").show();
		$("#backEventButton").show();

		$("#datepickerEvent").hide();
		$("#nameEvent").hide();
		$("#timeEvent").hide();
		$("#descriptionEventTextArea").hide();
		$("#saveEventButton").hide();
		$("#cancelEventButton").hide();
	}
}

function showErrors(errores) {
	$("#error").show();
	$("#error").html(errores);
}

function evalueExam($school, $person, $exam, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);
	var exam = JSON.parse($exam);

	window.location.href = "/exams/" + school + "/person/" + person + "/evalueExam/" + exam + "?type_user=" + $type_user;
}

function makeEvaluation() {
	$('[name="labelId"]').hide();
	$('[name="inputId"]').show();

	$("#evalue").hide();

	$("#saveExamButton").show();
	$("#cancelExamButton").show();
}

function updateExamNotes($exam) {
	var inputId = document.getElementsByName("inputId");
	var students = [];
	var notes = [];

	for(i = 0; i < inputId.length; i++) {
		students.push(inputId[i].id);
		notes.push(document.getElementById(inputId[i].id).value);
	}

	fetch("/evaluateExam", {
		method : "PUT",
		body: JSON.stringify({
			exam : $exam,
			students : students,
			notes : notes
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		location.reload();
	}).catch(error => console.error(error));
}

function cancelNotes() {
	var labelId = $('[name="labelId"]');
	var inputId = $('[name="inputId"]');

	for(i = 0; i < labelId.length; i++) {
		$(labelId[i].id).show();

		$(inputId[i].id).hide();
	}

	$("#evalue").show();

	$("#saveExamButton").hide();
	$("#cancelExamButton").hide();
}

function deleteEvent($event) {
	fetch("/deleteEvent", {
		method : "PUT",
		body: JSON.stringify({
			id : $event
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		location.reload();
	}).catch(error => console.error(error));
}

function deleteExam($exam) {
	fetch("/deleteExam", {
		method : "PUT",
		body: JSON.stringify({
			id : $exam
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		location.reload();
	}).catch(error => console.error(error));
}
