const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

function newStudent($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/students/" + school + "/person/" + person + "/newStudent?type_user=" + $type_user;
}

function editStudent($school, $person, $type_user, student) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/students/" + school + "/person/" + person + "/editStudent/" + student + "?type_user=" + $type_user;
}

function deleteStudent($student) {
	fetch("/deleteStudent", {
		method : "PUT",
		body: JSON.stringify({
			student : $student
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

function sendMessage($school, $person, $subject, $student, $type_user, pantalla) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	var url = new URL(window.location.protocol + "//" + window.location.host + "/messages/" + school + "/person/" + person + "/newMessage"); 

	const params = {
		subject : $subject,
		student : $student,
		type_user : $type_user,
		pantalla : pantalla
	};

	Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

	window.location.href = url;
}

function sendAlert($school, $person, $subject, $student, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	var url = new URL(window.location.protocol + "//" + window.location.host + "/alerts/" + school + "/person/" + person); 

	const params = {
		subject : $subject,
		student : $student,
		type_user : $type_user
	};

	Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

	window.location.href = url;
}

function createDataPicker() {
	$("#datepickerBirthday").datepicker({
		language: "es",
		autoclose: true,
		clearBtn: true,
		endDate: "30/06/2022",
		startDate: "01/01/2005",
		todayHighlight: true
	});
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

		for(let i in data.groups) {
			groupsSelect += "<option value=\"" + data.groups[i] + "\">" + data.groups[i] + "</option>";
		}

		$("#group").html(groupsSelect);
		$("#studentsTable").hide();
	}).catch(error => console.error(error));
}

function validateGroup($school, $person, $type_user) {
	$("#error").hide();
	$("#studentsTable").hide();

	fetch("/evaluations", {
		method : "POST",
		body: JSON.stringify({
			school : $school,
			course : $("#course option:selected").val(),
			group : $("#group option:selected").val(),
			type_user : $type_user
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		if(data.evaluations.length > 0) {
			var studentsTable = "";

			for(let i in data.evaluations) {
				studentsTable += "<div class=\"row\">";
				studentsTable += "<div class=\"col-md-1\"></div>";

				if($type_user === "Teacher" || $type_user === "Manager") {
					studentsTable += "<div class=\"col-md-3\">";
				} else {
					studentsTable += "<div class=\"col-md-7\">";
				}

				studentsTable += "<a href=\"" + window.location.protocol + "//" + window.location.host + "/students/" + $school + "/person/" + $person + "/student/" + data.evaluations[i]['id'] + "?type_user=" + $type_user + "\">" + data.evaluations[i]['name'] + "</a>";
				studentsTable += "</div>";

				if($type_user === "Teacher" || $type_user === "Manager") {
					studentsTable = createNoteColumns(data.evaluations[i], studentsTable)
				} else {
					studentsTable = createOptionsColumns($school, $person, $type_user, data.evaluations[i]['id'], studentsTable);
				}

				studentsTable += "</div>";
			}

			$("#studentsTableContent").html(studentsTable);
			$("#studentsTable").show();

			var tooltipTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
				return new bootstrap.Tooltip(tooltipTriggerEl);
			});
		} else {
			var errores = "<label>Aun no se ha creado ningún alumno para este curso y este grupo, cuando lo haga aparecerá aquí.</label>"

			showErrors(errores);
		}
	}).catch(error => console.error(error));
}

function createNoteColumns(evaluations, studentsTable) {
	studentsTable += "<div class=\"col-md-8\">";
	studentsTable += "<div class=\"row\">"
	studentsTable += "<div class=\"col-md-4\">";
	studentsTable += "<label>" + evaluations['noteFirstTrimester'] + "</label>";
	studentsTable += "</div>";
	studentsTable += "<div class=\"col-md-4\">";
	studentsTable += "<label>" + evaluations['noteSecondTrimester'] + "</label>";
	studentsTable += "</div>";
	studentsTable += "<div class=\"col-md-4\">";
	studentsTable += "<label>" + evaluations['noteThirdTrimester'] + "</label>";
	studentsTable += "</div>";
	studentsTable += "</div>";
	studentsTable += "</div>";

	return studentsTable;
}

function createOptionsColumns($school, $person, $type_user, alumnoId, studentsTable) {
	studentsTable += "<div class=\"col-md-4\">";
	studentsTable += "<div class=\"row\">"

	studentsTable += "<div class=\"col-md-2\">";
	studentsTable += "<button id=\"editButton\" class=\"btn btn-secondary\" data-bs-toggle=\"tooltip\" data-bs-placement=\"right\" title=\"Editar alumno\" onclick=\"editStudent('" + $school + "', '" + $person + "', '" +  $type_user + "', '" + alumnoId + "')\">";
	studentsTable += "<i class=\"fas fa-user-edit\"></i>";
	studentsTable += "</button>";
	studentsTable += "</div>";

	studentsTable += "<div class=\"col-md-1\">";
	studentsTable += "</div>";

	studentsTable += "<div class=\"col-md-2\">";
	studentsTable += "<button id=\"deleteButton\" class=\"btn btn-secondary\" data-bs-toggle=\"tooltip\" data-bs-placement=\"right\" title=\"Eliminar alumno\" onclick=\"deleteStudent('" + alumnoId + "')\">";
	studentsTable += "<i class=\"fas fa-user-times\"></i>";
	studentsTable += "</button>";
	studentsTable += "</div>";

	studentsTable += "</div>";
	studentsTable += "</div>";

	return studentsTable;
}

function save($student, $type_user) {
	var errores = "";

	errores += validationLegalGuardianData();
	errores += validationResidenceData();
	errores += validationContactData();
	errores += validationStudentData();

	if(errores === "") {
		$("#error").hide();
		savePerson($student, $type_user);
	} else {
		showErrors(errores);
	}
}

function validationLegalGuardianData() {
	var errores = "";

	if(!validateDNI($("#legalGuardianDNI").val())) {
		errores += "You must insert a correct identification" + "<br>";
	}

	if($("#legalGuardianName").val() === "") {
		errores += "You must insert a legal guardian name" + "<br>";
	}

	if($("#legalGuardianSurnames").val() === "") {
		errores += "You must insert a legal guardian surnames" + "<br>";
	}

	return errores;
}

function validateDNI(dni) {
	var validChars = "TRWAGMYFPDXBNJZSQVHLCKET";
	var nifRexp = new RegExp("^\\d{8}[TRWAGMYFPDXBNJZSQVHLCKET]$");

	if (!nifRexp.test(dni)) return false;

	var number = dni.substr(0, dni.length - 1) % 23;
	var letter = dni.substr(dni.length - 1, 1);

	var validChar = validChars.substring(number, number + 1);

	return validChar === letter.toUpperCase() ? true : false;
}

function validationResidenceData() {
	var errores = "";

	if($("#legalGuardianAddress").val() === "") {
		errores += "You must insert the address of the legal guardian" + "<br>";
	}

	if($("#legalGuardianLocation").val() === "") {
		errores += "You must insert the location of the legal guardian" + "<br>";
	}

	if($("#legalGuardianProvince").val() === "") {
		errores += "You must insert the province of the legal guardian" + "<br>";
	}

	if(!validatePostalCode($("#legalGuardianPostalCode").val())) {
		errores += "You must insert a correct postal code" + "<br>";
	}

	return errores;
}

function validationContactData() {
	var errores = "";

	if(!validatePhoneNumber($("#legalGuardianPhone").val())) {
		errores += "You must insert a correct phone number (+34 654 321 987)" + "<br>";
	}

	if(!validateEmail($("#legalGuardianEmail").val())) {
		errores += "You must insert a correct mail (mail@mail.com o mail@mail.es)" + "<br>";
	}

	return errores;
}

function validationStudentData() {
	var errores = "";

	if($("#studentName").value === "") {
		errores += "You must insert a legal guardian name" + "<br>";
	}

	if($("#studentSurnames").val() === "") {
		errores += "You must insert a legal guardian surnames" + "<br>";
	}

	if($("#course option:selected").text() === "Seleccione un curso") {
		errores += "You must chouse a course" + "<br>";
	}

	if($("#group option:selected").text() === "Seleccione un grupo") {
		errores += "You must chouse a group" + "<br>";
	}

	if(!validatePhoneNumber($("#studentPhone").val())) {
		errores += "You must insert a correct phone number (+34 654 321 987)" + "<br>";
	}

	if($("#datepickerBirthday").data("datepicker").getFormattedDate('dd/mm/yyyy') === "") {
		errores += "You must chouse a date" + "<br>";
	}

	return errores;
}

function validatePostalCode(postalCode) {
	var postalCodeRexp = new RegExp("^(?:0[1-9]|[1-4]\\d|5[0-2])\\d{3}$");

	return postalCodeRexp.test(postalCode) ? true : false;
}

function validatePhoneNumber(phone) {
	var phoneRexp = new RegExp("^(0034|\\+34)?(\\d\\d\\d)-? ?(\\d\\d)-? ?(\\d)-? ?(\\d)-? ?(\\d\\d)$");

	return phoneRexp.test(phone) ? true : false;
}

function validateEmail(phone) {
	var phoneRexp = new RegExp('^(([^<>()[\\]\\.,;:\\s@\\"]+(\\.[^<>()[\\]\\.,;:\\s@\\"]+)*)|(\\".+\\"))@(([^<>()[\\]\\.,;:\\s@\\"]+\\.)+[^<>()[\\]\\.,;:\\s@\\"]{2,})$');

	return phoneRexp.test(phone) ? true : false;
}

function savePerson($student, $type_user) {
	var url = "";

	if($student === "") {
		url = "/newPerson";
	} else {
		url = "/updatePerson";
	}

	fetch(url, {
		method : "PUT",
		body: JSON.stringify({
			type_user : $type_user,
			dni : $("#legalGuardianDNI").val(),
			name : $("#legalGuardianName").val(),
			surnames : $("#legalGuardianSurnames").val(),
			address : $("#legalGuardianAddress").val(),
			location : $("#legalGuardianLocation").val(),
			province : $("#legalGuardianProvince").val(),
			phone : $("#legalGuardianPhone").val(),
			email : $("#legalGuardianEmail").val(),
			postal_code : $("#legalGuardianPostalCode").val()
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		saveLegalGuardian($student, data.dni);
	}).catch(error => console.error(error));
}

function saveLegalGuardian($student, person) {
	var url = "";

	if($student === "") {
		url = "/newLegalGuardian";
	} else {
		saveStudent($student, person);
	}

	fetch(url, {
		method : "PUT",
		body: JSON.stringify({
			legalGuardian : person
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		saveStudent($student, data.person);
	}).catch(error => console.error(error));
}

function saveStudent($student, legalGuardian) {
	var url = "";

	if($student === "") {
		url = "/saveStudent";
	} else {
		url = "/updateStudent";
	}

	fetch(url, {
		method : "PUT",
		body: JSON.stringify({
			student : $student,
			legalGuardian : legalGuardian,
			studentName : $("#studentName").val(),
			studentSurnames : $("#studentSurnames").val(),
			course : $("#course option:selected").val(),
			group : $("#group option:selected").val(),
			studentPhone : $("#studentPhone").val(),
			birthday : $("#datepickerBirthday").data("datepicker").getFormattedDate('dd/mm/yyyy')
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		window.history.go(-1);
	}).catch(error => console.error(error));
}

function showErrors(errores) {
	$("#error").show();
	$("#error").html(errores);
}

function edit($date) {
	$("#legalGuardianDNILabel").hide();
	$("#legalGuardianNameLabel").hide();
	$("#legalGuardianSurnamesLabel").hide();
	$("#legalGuardianPhoneLabel").hide();
	$("#legalGuardianEmailLabel").hide();
	$("#studentNameLabel").hide();
	$("#studentSurnamesLabel").hide();
	$("#studentPhoneLabel").hide();
	$("#birthdayLabel").hide();
	$("#legalGuardianAddressLabel").hide();
	$("#legalGuardianLocationLabel").hide();
	$("#legalGuardianProvinceLabel").hide();
	$("#legalGuardianPostalCodeLabel").hide();
	$("#courseLabel").hide();
	$("#groupLabel").hide();

	$("#edit").hide();

	$("#datepickerBirthday").datepicker().datepicker("setDate", $date);

	$("#legalGuardianDNI").show();
	$("#legalGuardianName").show();
	$("#legalGuardianSurnames").show();
	$("#legalGuardianPhone").show();
	$("#legalGuardianEmail").show();
	$("#studentName").show();
	$("#studentSurnames").show();
	$("#studentPhone").show();
	$("#datepickerBirthday").show();
	$("#legalGuardianAddress").show();
	$("#legalGuardianLocation").show();
	$("#legalGuardianProvince").show();
	$("#legalGuardianPostalCode").show();
	$("#course").show();
	$("#group").show();

	$("#saveOptions").show();
}

function cancel() {
	$("#legalGuardianDNILabel").show();
	$("#legalGuardianNameLabel").show();
	$("#legalGuardianSurnamesLabel").show();
	$("#legalGuardianPhoneLabel").show();
	$("#legalGuardianEmailLabel").show();
	$("#studentNameLabel").show();
	$("#studentSurnamesLabel").show();
	$("#studentPhoneLabel").show();
	$("#birthdayLabel").show();
	$("#legalGuardianAddressLabel").show();
	$("#legalGuardianLocationLabel").show();
	$("#legalGuardianProvinceLabel").show();
	$("#legalGuardianPostalCodeLabel").show();
	$("#courseLabel").show();
	$("#groupLabel").show();

	$("#edit").show();

	$("#legalGuardianDNI").hide();
	$("#legalGuardianName").hide();
	$("#legalGuardianSurnames").hide();
	$("#legalGuardianPhone").hide();
	$("#legalGuardianEmail").hide();
	$("#studentName").hide();
	$("#studentSurnames").hide();
	$("#studentPhone").hide();
	$("#datepickerBirthday").hide();
	$("#legalGuardianAddress").hide();
	$("#legalGuardianLocation").hide();
	$("#legalGuardianProvince").hide();
	$("#legalGuardianPostalCode").hide();
	$("#course").hide();
	$("#group").hide();

	$("#saveOptions").hide();
}
