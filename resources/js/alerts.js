const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

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

function validateGroup($school, $person, $type_user) {
	fetch("/subjects", {
		method : "POST",
		body: JSON.stringify({
			school : $school,
			person : $person,
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
		var subjectsSelect = "<option disabled=\"disabled\" selected=\"selected\">Seleccione una asignatura</option>";

		for (let i in data.subjects) {
			subjectsSelect += "<option value=\"" + data.subjects[i].code + "\">" + data.subjects[i].name + "</option>";
		}

		$("#subjects").html(subjectsSelect);
	}).catch(error => console.error(error));
}

function validateSubject($school, $person) {
	fetch("/students", {
		method : "POST",
		body: JSON.stringify({
			school : $school,
			person : $person,
			course : $("#course option:selected").val(),
			group : $("#group option:selected").val(),
			subject : $("#subjects option:selected").val()
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		var studentsSelect = "<option disabled=\"disabled\" selected=\"selected\">Seleccione un alumno</option>";

		for (let i in data.students) {
			studentsSelect += "<option value=\"" + data.students[i].id + "\">" + data.students[i].name + " " + data.students[i].surnames + "</option>";
		}

		$("#students").html(studentsSelect);
	}).catch(error => console.error(error));
}

function send($school, $person) {
	var localeDate = new Date();

	Number.prototype.padLeft = function(base, chr) {
		var  len = (String(base || 10).length - String(this).length) + 1;

		return len > 0 ? new Array(len).join(chr || '0') + this : this;
	}

	var date = [
			localeDate.getDate().padLeft(),
			(localeDate.getMonth() + 1).padLeft(),
			localeDate.getFullYear()
		].join('/') + ' ' +
		[
			localeDate.getHours().padLeft(),
			localeDate.getMinutes().padLeft(),
			localeDate.getSeconds().padLeft()
		].join(':');

	var errores = validationFields();

	if(errores === "") {
		$("#error").hide();

		fetch("/sendAlert", {
			method : "PUT",
			body: JSON.stringify({
				school : $school,
				sender : $person,
				date : date,
				course : $("#course option:selected").val(),
				group : $("#group option:selected").val(),
				student : $("#students option:selected").val(),
				massive : $("#massive").is(":checked"),
				matter : $("#matter").val()
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
	} else {
		showErrors(errores);
	}
}

function validationFields() {
	var errores = "";

	if($("#course option:selected").text() === "Seleccione un curso") {
		errores += "You must chose a course" + "<br>";
	}

	if($("#group option:selected").text() === "Seleccione un grupo") {
		errores += "You must chose a group" + "<br>";
	}

	if($("#subjects option:selected").text() === "Seleccione una asignatura") {
		errores += "You must chose a subject" + "<br>";
	}

	if($("#students option:selected").text() === "Seleccione un alumno" && !$("#massive").is(":checked")) {
		errores += "You must chose a student" + "<br>";
	}

	if($("#matter").val() === "") {
		errores += "You must insert a matter" + "<br>";
	}

	return errores;
}

function showErrors(errores) {
	$("#error").show();
	$("#error").html(errores);
}

function deleteAlert(alert_id) {
	fetch("/deleteAlert", {
		method : "PUT",
		body: JSON.stringify({
			id : alert_id
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
