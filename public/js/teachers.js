const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

function newTeacher($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/teachers/" + school + "/person/" + person + "/newTeacher?type_user=" + $type_user;
}

function editTeacher($school, $person, $type_user, teacher) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/teachers/" + school + "/person/" + person + "/editTeacher/" + teacher + "?type_user=" + $type_user;
}

function deleteTeacher($teacher) {
	fetch("/deleteTeacher", {
		method : "PUT",
		body: JSON.stringify({
			teacher : $teacher
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

		for (let i in data.groups) {
			groupsSelect += "<option value=\"" + data.groups[i] + "\">" + data.groups[i] + "</option>";
		}

		$("#group").html(groupsSelect);
		$("#h5subjectsFields").hide();
		$("#subjectsFields").hide();
		$("#selectsSubjects").html("");
		$("#addSubject").show();
	}).catch(error => console.error(error));
}

function validateGroup($school, $person, $type_user) {
	$("#error").hide();
	$("#teachersTable").hide();

	fetch("/teaching", {
		method : "POST",
		body: JSON.stringify({
			school : $school,
			person : $person,
			type_user : $type_user,
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
		var teachersTable = "";

		if(data.teachers.length > 0) {
			for(let i in data.teachers) {
				teachersTable = createImpartColumns($school, $person, $type_user, data.teachers[i], teachersTable);
			}

			$("#teachersTableContent").html(teachersTable);
			$("#teachersTable").show();

			var tooltipTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
			var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
				return new bootstrap.Tooltip(tooltipTriggerEl);
			});
		} else {
			var errores = "<label>Aun no se ha creado ningún profesor para este curso y este grupo, cuando lo haga aparecerá aquí.</label>"

			showErrors(errores);
		}
	}).catch(error => console.error(error));
}

function createImpartColumns($school, $person, $type_user, teachers, teachersTable) {
	teachersTable += "<div class=\"row\">";
	teachersTable += "<div class=\"col-md-1\"></div>";

	if($type_user === "Teacher" || $type_user === "Manager") {
		teachersTable += "<div class=\"col-md-3\">";
	} else {
		teachersTable += "<div class=\"col-md-2\">";
	}

	teachersTable += "<a href=\"http://schoolmanager:8080/teachers/" + $school + "/person/" + $person + "/teacher/" + teachers['id'] + "?type_user=" + $type_user + "\">" + teachers['teacherName'] + "</a>";
	teachersTable += "</div>";

	if($type_user === "Teacher" || $type_user === "Manager") {
		teachersTable += "<div class=\"col-md-8\">";
	} else {
		teachersTable += "<div class=\"col-md-5\">";
	}

	teachersTable += "<a href=\"http://schoolmanager:8080/subjects/" + $school + "/person/" + $person + "/subject/" + teachers['code'] + "?type_user=" + $type_user + "\">" + teachers['subjectName'] + "</a>";
	teachersTable += "</div>";

	if($type_user !== "Teacher" && $type_user !== "Manager") {
		teachersTable = createOptionsColumns($school, $person, $type_user, teachers['id'], teachersTable);
	}

	teachersTable += "</div>";

	return teachersTable;
}

function createOptionsColumns($school, $person, $type_user, teacherId, teachersTable) {
	teachersTable += "<div class=\"col-md-4\">";
	teachersTable += "<div class=\"row\">"

	teachersTable += "<div class=\"col-md-2\">";
	teachersTable += "<button id=\"editButton\" class=\"btn btn-secondary\" data-bs-toggle=\"tooltip\" data-bs-placement=\"right\" title=\"Editar profesor\" onclick=\"editTeacher('" + $school + "', '" + $person + "', '" +  $type_user + "', '" + teacherId + "')\">";
	teachersTable += "<i class=\"fas fa-user-edit\"></i>";
	teachersTable += "</button>";
	teachersTable += "</div>";

	teachersTable += "<div class=\"col-md-1\">";
	teachersTable += "</div>";

	teachersTable += "<div class=\"col-md-2\">";
	teachersTable += "<button id=\"deleteButton\" class=\"btn btn-secondary\" data-bs-toggle=\"tooltip\" data-bs-placement=\"right\" title=\"Eliminar profesor\" onclick=\"deleteTeacher('" + teacherId + "')\">";
	teachersTable += "<i class=\"fas fa-user-times\"></i>";
	teachersTable += "</button>";
	teachersTable += "</div>";

	teachersTable += "</div>";
	teachersTable += "</div>";

	return teachersTable;
}

function addSubject($school, $person, $type_user, option) {
	fetch("/subjects", {
		method : "POST",
		body: JSON.stringify({
			school : $school,
			person : $person,
			type_user : $type_user,
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
		var subjectsSelect = createSubjectsSelect(data.subjects);

		if(option == 1) {
			$("#h5subjectsFields").show();
			$("#subjectsFields").show();
			$("#selectsSubjects").html(subjectsSelect);
		} else {
			$("#selectsSubjects").append(subjectsSelect);
		}
	}).catch(error => console.error(error));

	/*var selects = $("#selectsSubjects").find("select").length;

	if ($("#course option:selected").text().includes("preschool") == true) {
		$("#addSubject").hide();
	} else if (selects > 4) {
		$("#addSubject").hide();
	}*/
}

function createSubjectsSelect(subjects) {
	var subjectsSelect = "";
	var idSelect = $("#selectsSubjects").find("select").length + 1;

	subjectsSelect += "<div class=\"row\">";
	subjectsSelect += "<div class=\"col-md-6\">";
	subjectsSelect += "<div class=\"row\">";
	subjectsSelect += "<div class=\"col-md-2\"></div>";
	subjectsSelect += "<div class=\"col-md-3\">";
	subjectsSelect += "<label>Asignatura</label>";
	subjectsSelect += "</div>";

	subjectsSelect += "<select id=\"subject" + idSelect + "\" name=\"subject\">";
	subjectsSelect += "<option disabled=\"disabled\" selected=\"selected\">Seleccione una asignatura</option>";

	for (let i in subjects) {
		subjectsSelect += "<option value=\"" + subjects[i].code + "\">" + subjects[i].name + "</option>";
	}

	subjectsSelect += "</select>";

	subjectsSelect += "</div>";
	subjectsSelect += "</div>";
	subjectsSelect += "</div>";

	return subjectsSelect;
}

function save($teacher, $type_user) {
	var errores = "";

	if($("#preceptor").is(":checked")) {
		errores += validationPreceptor();
	}

	errores += validationTeacherData();
	errores += validationResidenceData();
	errores += validationContactData();
	errores += validationSchoolData();

	if(errores === "") {
		$("#error").hide();
		savePerson($teacher, $type_user);
	} else {
		showErrors(errores);
	}
}

function validationPreceptor() {
	fetch("/preceptor", {
		method : "POST",
		body: JSON.stringify({
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
		var errores = "";

		if(data.preceptor !== "") {
			errores += "This group already has a Preceptor" + "<br>";
		}

		return errores;
	}).catch(error => console.error(error));
}

function validationTeacherData() {
	var errores = "";

	if(!validateDNI($("#teacherDNI").val())) {
		errores += "You must insert a correct identification" + "<br>";
	}

	if($("#teacherName").val() === "") {
		errores += "You must insert a legal guardian name" + "<br>";
	}

	if($("#teacherSurnames").val() === "") {
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

	if($("#teacherAddress").val() === "") {
		errores += "You must insert the address of the legal guardian" + "<br>";
	}

	if($("#teacherLocation").val() === "") {
		errores += "You must insert the location of the legal guardian" + "<br>";
	}

	if($("#teacherProvince").val() === "") {
		errores += "You must insert the province of the legal guardian" + "<br>";
	}

	if(!validatePostalCode($("#teacherPostalCode").val())) {
		errores += "You must insert a correct postal code" + "<br>";
	}

	return errores;
}

function validatePostalCode(postalCode) {
	var postalCodeRexp = new RegExp("^(?:0[1-9]|[1-4]\\d|5[0-2])\\d{3}$");

	return postalCodeRexp.test(postalCode) ? true : false;
}

function validationContactData() {
	var errores = "";

	if(!validatePhoneNumber($("#teacherPhone").val())) {
		errores += "You must insert a correct phone number (+34 654 321 987)" + "<br>";
	}

	if(!validateEmail($("#teacherEmail").val())) {
		errores += "You must insert a correct mail (mail@mail.com o mail@mail.es)" + "<br>";
	}

	return errores;
}

function validatePhoneNumber(phone) {
	var phoneRexp = new RegExp("^(0034|\\+34)?(\\d\\d\\d)-? ?(\\d\\d)-? ?(\\d)-? ?(\\d)-? ?(\\d\\d)$");

	return phoneRexp.test(phone) ? true : false;
}

function validateEmail(phone) {
	var phoneRexp = new RegExp('^(([^<>()[\\]\\.,;:\\s@\\"]+(\\.[^<>()[\\]\\.,;:\\s@\\"]+)*)|(\\".+\\"))@(([^<>()[\\]\\.,;:\\s@\\"]+\\.)+[^<>()[\\]\\.,;:\\s@\\"]{2,})$');

	return phoneRexp.test(phone) ? true : false;
}

function validationSchoolData() {
	var errores = "";

	if($("#course option:selected").text() === "Seleccione un curso") {
		errores += "You must chouse a course" + "<br>";
	}

	if($("#group option:selected").text() === "Seleccione un grupo") {
		errores += "You must chouse a group" + "<br>";
	}

	var selects = $("#selectsSubjects").find("select").length;

	for(var i = 1; i <= selects; i++) {
		if($("#subject" + i + " option:selected").text() === "Seleccione una asignatura") {
			errores += "You must chouse a subject " + i + "<br>";
		}
	}

	return errores;
}

function savePerson($teacher, $type_user) {
	var url = "";

	if($teacher === "") {
		url = "/newPerson";
	} else {
		url = "/updatePerson";
	}

	fetch(url, {
		method : "PUT",
		body: JSON.stringify({
			type_user : $type_user,
			dni : $("#teacherDNI").val(),
			name : $("#teacherName").val(),
			surnames : $("#teacherSurnames").val(),
			address : $("#teacherAddress").val(),
			location : $("#teacherLocation").val(),
			province : $("#teacherProvince").val(),
			phone : $("#teacherPhone").val(),
			email : $("#teacherEmail").val(),
			postal_code : $("#teacherPostalCode").val()
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		saveTeacher(data.dni, $teacher);
	}).catch(error => console.error(error));
}

function saveTeacher(person, $teacher) {
	if($teacher === "") {
		url = "/addTeacher";
	} else {
		url = "/updateTeacher";
	}

	fetch(url, {
		method : "PUT",
		body: JSON.stringify({
			teacher : person,
			preceptor : $("#preceptor").is(":checked")
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		if($("#preceptor").is(":checked")) {
			savePreceptor(person);
		}

		saveImparts(person);
	}).catch(error => console.error(error));
}

function savePreceptor(person, $teacher) {
	if($teacher === "") {
		url = "/newPreceptor";
	} else {
		url = "/updatePreceptor";
	}

	fetch("/newPreceptor", {
		method : "PUT",
		body: JSON.stringify({
			preceptor : person,
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
	}).catch(error => console.error(error));
}

function saveImparts(person) {
	//var selects = $("#selectsSubjects").find("select").length;

	//for(var i = 1; i <= selects; i++) {
	fetch("/newImpart", {
		method : "PUT",
		body: JSON.stringify({
			teacher : person,
			subject : $("#subject" + 1 + " option:selected").val(),
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
		window.history.go(-1);
	}).catch(error => console.error(error));
	//}
}

function edit() {
	$("#teacherDNILabel").hide();
	$("#teacherNameLabel").hide();
	$("#teacherSurnamesLabel").hide();
	$("#teacherPhoneLabel").hide();
	$("#teacherEmailLabel").hide();
	$("#teacherAddressLabel").hide();
	$("#teacherLocationLabel").hide();
	$("#teacherProvinceLabel").hide();
	$("#teacherPostalCodeLabel").hide();
	$("#courseLabel").hide();
	$("#groupLabel").hide();
	$("#preceptorLabel").hide();
	$("#subjectLabel").hide();

	$("#edit").hide();

	$("#teacherDNI").show();
	$("#teacherName").show();
	$("#teacherSurnames").show();
	$("#teacherPhone").show();
	$("#teacherEmail").show();
	$("#teacherAddress").show();
	$("#teacherLocation").show();
	$("#teacherProvince").show();
	$("#teacherPostalCode").show();
	$("#course").show();
	$("#group").show();
	$("#preceptorForm").show();
	$("#subject").show();

	$("#saveOptions").show();
}

function cancel() {
	$("#teacherDNILabel").show();
	$("#teacherNameLabel").show();
	$("#teacherSurnamesLabel").show();
	$("#teacherPhoneLabel").show();
	$("#teacherEmailLabel").show();
	$("#teacherAddressLabel").show();
	$("#teacherLocationLabel").show();
	$("#teacherProvinceLabel").show();
	$("#teacherPostalCodeLabel").show();
	$("#courseLabel").show();
	$("#groupLabel").show();
	$("#preceptorLabel").show();
	$("#subjectLabel").show();

	$("#edit").show();

	$("#teacherDNI").hide();
	$("#teacherName").hide();
	$("#teacherSurnames").hide();
	$("#teacherPhone").hide();
	$("#teacherEmail").hide();
	$("#teacherAddress").hide();
	$("#teacherLocation").hide();
	$("#teacherProvince").hide();
	$("#teacherPostalCode").hide();
	$("#course").hide();
	$("#group").hide();
	$("#preceptorForm").hide();
	$("#subject").hide();

	$("#saveOptions").hide();
}

function showErrors(errores) {
	$("#error").show();
	$("#error").html(errores);
}
