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

function addPreceptor() {
	if($("#preceptorData").is(":visible")) {
		$("#preceptorData").hide();
	} else {
		$("#preceptorData").show();
	}
}

function addSubject($school, $person, $courses, $type_user) {
	var html = "";
	var item = $("#selectsSubjects").find("select").length;

	if(item > 0) {
		item = item / 3;
	}

	html = "<div id=\"addSubjectContent" + item + "\" class=\"row\">";

	html += "<div class=\"row\">"
	html += createCourseSelect($school, $person, $courses, $type_user, item);
	html += createGroupSelect($school, $person, $type_user, item);
	html += "</div>";

	html += "<div class=\"row\">"
	html += createSubjectSelect(item);
	html += createValidateButton(item);
	html += "</div>";

	html += "</div>";

	$("#selectsSubjects").append(html);
	$("#selectsSubjects").show();

	var tooltipTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl);
	});
}

function createCourseSelect($school, $person, $courses, $type_user, item) {
	var html = "";
	var courses = JSON.parse($courses);

	html += "<div class=\"col-md-6\">";
	html += "<div class=\"row\">";

	html += "<div class=\"col-md-2\">";
	html += "</div>";
	html += "<div class=\"col-md-3\">";
	html += "<label>Curso</label>";
	html += "</div>";

	html += "<select id=\"course" + item + "\" class=\"col-md-4\" onchange=\"validateCourseForSubject('" + $school + "', '" + $person + "', '" +  $type_user + "', " + item + ")\">";
	html += "<option disabled=\"disabled\" selected=\"selected\">Seleccione un curso</option>";

	courses.forEach(course => {
		html += "<option value=\"" + course.id + "\">" + course.number + " " + course.degree + "</option>";
	});

	html += "</select>";

	html += "</div>";
	html += "</div>";

	return html;
}

function createGroupSelect($school, $person, $type_user, item) {
	var html = "";

	html += "<div class=\"col-md-6\">";
	html += "<div class=\"row\">";

	html += "<div class=\"col-md-2\">";
	html += "</div>";
	html += "<div class=\"col-md-3\">";
	html += "<label>Grupo</label>";
	html += "</div>";

	html += "<select id=\"group" + item + "\" class=\"col-md-4\" onchange=\"validateGroupForSubject('" + $school + "', '" + $person + "', '" +  $type_user + "', " + item + ")\">";
	html += "<option disabled=\"disabled\" selected=\"selected\">Seleccione un grupo</option>";
	html += "</select>";

	html += "</div>";
	html += "</div>";

	return html;
}

function createSubjectSelect(item) {
	var html = "";

	html += "<div class=\"col-md-6\">";
	html += "<div class=\"row\">";

	html += "<div class=\"col-md-2\">";
	html += "</div>";
	html += "<div class=\"col-md-3\">";
	html += "<label>Asignatura</label>";
	html += "</div>";

	html += "<select id=\"subject" + item + "\" class=\"col-md-4\">";
	html += "<option disabled=\"disabled\" selected=\"selected\">Seleccione una asignatura</option>";
	html += "</select>";

	html += "</div>";
	html += "</div>";

	return html;
}

function createValidateButton(item) {
	var html = "";

	html += "<div class=\"col-md-6\">";
	html += "<div class=\"row\">"

	html += "<div class=\"col-md-2\">";
	html += "</div>";

	html += "<div class=\"col-md-2\">";
	html += "<button id=\"validate" + item + "\" class=\"btn btn-outline-success\" data-bs-toggle=\"tooltip\" data-bs-placement=\"right\" title=\"Validar asignatura\" onclick=\"validateSubject(" + item + ")\">";
	html += "<i class=\"fas fa-circle-check\"></i>";
	html += "</button>";
	html += "</div>";

	html += "<div class=\"col-md-2\">";
	html += "<button id=\"cancel" + item + "\" class=\"btn btn-outline-danger\" data-bs-toggle=\"tooltip\" data-bs-placement=\"right\" title=\"Cancelar\" onclick=\"cancelSubject(" + item + ")\">";
	html += "<i class=\"fas fa-circle-xmark\"></i>";
	html += "</button>";
	html += "</div>";

	html += "</div>";
	html += "</div>";

	return html;
}

function validateCourseForSubject($school, $person, $type_user, item) {
	var course = "#course" + item + " option:selected";
	var group = "#group" + item;
	var subject = "#subject" + item;
	var validate = "#validate" + item;

	fetch("/group", {
		method : "POST",
		body: JSON.stringify({
			school : $school,
			person : $person,
			course : $(course).val(),
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
		var subjectSelect = "<option disabled=\"disabled\" selected=\"selected\">Seleccione una asignatura</option>";

		for (let i in data.groups) {
			groupsSelect += "<option value=\"" + data.groups[i] + "\">" + data.groups[i] + "</option>";
		}


		$(group).html(groupsSelect);
		$(subject).html(subjectSelect);
		$(validate).removeAttr('disabled');
	}).catch(error => console.error(error));
}

function validateGroupForSubject($school, $person, $type_user, item) {
	var course = "#course" + item + " option:selected";
	var group = "#group" + item + " option:selected";
	var subject = "#subject" + item;
	var validate = "#validate" + item;

	fetch("/subjects", {
		method : "POST",
		body: JSON.stringify({
			school : $school,
			person : $person,
			course : $(course).val(),
			group : $(group).val(),
			type_user : $type_user
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

		$(subject).html(subjectsSelect);
		$(validate).removeAttr('disabled');
	}).catch(error => console.error(error));
}

function validateSubject(item) {
	var course = "#course" + item + " option:selected";
	var group = "#group" + item + " option:selected";
	var subject = "#subject" + item + " option:selected";
	var validate = "#validate" + item;

	if(validationSubjectData(item)) {
		fetch("/checkImpart", {
			method : "POST",
			body: JSON.stringify({
				course : $(course).val(),
				group : $(group).val(),
				subject : $(subject).val()
			}),
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-Token": csrfToken
			}
		}).then(response => {
			return response.json();
		}).then(data => {
			var courseSelect = "#course" + item;
			var groupSelect = "#group" + item;
			var subjectSelect = "#subject" + item;

			if(data.message === "The subject does not have a teacher yet") {
				$(courseSelect).css({'border': '2px solid #0f0'});
				$(groupSelect).css({'border': '2px solid #0f0'});
				$(subjectSelect).css({'border': '2px solid #0f0'});
				$(validate).hide();
			} else {
				$(courseSelect).css({'border': '2px solid #f00'});
				$(groupSelect).css({'border': '2px solid #f00'});
				$(subjectSelect).css({'border': '2px solid #f00'});
			}
		}).catch(error => console.error(error));
	}
}

function validationSubjectData(item) {
	var course = "#course" + item + " option:selected";
	var group = "#group" + item + " option:selected";
	var subject = "#subject" + item + " option:selected";
	var courseSelect = "#course" + item;
	var groupSelect = "#group" + item;
	var subjectSelect = "#subject" + item;

	if($(course).text() === "Seleccione un curso") {
		$(courseSelect).css({'border': '2px solid #f00'});

		return false;
	} else {
		$(courseSelect).css({'border': '2px solid #000'});
	}

	if($(group).text() === "Seleccione un grupo") {
		$(groupSelect).css({'border': '2px solid #f00'});

		return false;
	} else {
		$(groupSelect).css({'border': '2px solid #000'});
	}

	if($(subject).text() === "Seleccione una asignatura") {
		$(subjectSelect).css({'border': '2px solid #f00'});

		return false;
	} else {
		$(subjectSelect).css({'border': '2px solid #000'});
	}

	return true;
}

function cancelSubject(item) {
	var subject = "#addSubjectContent" + item;
	var course = "course" + item;
	var group = "group" + item;
	var subjects = "subject" + item;
	var validate = "validate" + item;
	var cancel = "cancel" + item;

	$(subject).hide();
	//$(course).remove();
	//$(group).remove();
	//$(subjects).remove();
	//$(validate).remove();
	//$(cancel).remove();
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

	for(var i = 0; i < selects; i++) {
		var subjectContent = "#addSubjectContent" + i;
		var validate = "#validate" + i;

		if($(subjectContent).is(":visible") && $(validate).is(":visible")) {
			errores += "You must chouse a subject " + (i + 1) + "<br>";
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
	var selects = $("#selectsSubjects").find("select").length;

	for(var i = 0; i < selects; i++) {
		var subjectContent = "#addSubjectContent" + i;

		if($(subjectContent).is(":visible")) {
			var course = "#course" + i + " option:selected";
			var group = "#group" + i + " option:selected";
			var subject = "#subject" + i + " option:selected";

			fetch("/newImpart", {
				method : "PUT",
				body: JSON.stringify({
					teacher : person,
					subject : $(subject).val(),
					course : $(course).val(),
					group : $(group).val()
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
	}
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
