const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

function newMessage($school, $person, $type_user, pantalla) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/messages/" + school + "/person/" + person + "/newMessage?type_user=" + $type_user + "&pantalla=" + pantalla;
}

function messagesSent($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/messages/" + school + "/messagesSent/" + person  + "?type_user=" + $type_user;
}

function messagesReceived($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/messages/" + school + "/messagesReceived/" + person  + "?type_user=" + $type_user;
}

function messagesDeleted($school, $person) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/messages/" + school + "/person/" + person + "/messagesDeleted";
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

function confirm($school, $person, $previous_message, $type_user, pantalla) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	var errores = validationFields();

	if(errores === "") {
		var url = new URL("http://schoolmanager:8080/messages/" + school + "/person/" + person + "/previewMessage"); 

		const params = {
			subject : $("#subjects option:selected").val(),
			student : $("#students option:selected").val(),
			matter : $("#matter").val(),
			message : $("#messageTextArea").val(),
			previous_message : $previous_message,
			type_user: $type_user,
			pantalla : pantalla
		};

		Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

		window.location.href = url;
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

	if($("#students option:selected").text() === "Seleccione un alumno") {
		errores += "You must chose a student" + "<br>";
	}

	if($("#matter").val() === "") {
		errores += "You must insert a matter" + "<br>";
	}

	if($("#messageTextArea").val() === "") {
		errores += "You must insert a message content";
	}

	return errores;
}

function showErrors(errores) {
	$("#error").show();
	$("#error").html(errores);
}

function sendMessage($sender, $receiver, $previous_message, pantalla) {
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

	fetch("/messageSender", {
		method : "PUT",
		body: JSON.stringify({
			date : date,
			matter : $("#matter").html(),
			text : $("#messageTextArea").html(),
			sender : $sender,
			receiver : $receiver,
			previous_message : $previous_message
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		if (pantalla == 1) {
			window.history.go(-2);
		} else if (pantalla == 2) {
			window.history.go(-3);
		} else if (pantalla == 3) {
			window.history.go(-4);
		}
	}).catch(error => console.error(error));
}

function getMessage($school, $person, $message, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);
	var message = JSON.parse($message);

	window.location.href = "/messages/" + school + "/person/" + person + "/getMessage/" + message + "?type_user=" + $type_user;
}

function replyMessage($school, $person, $message, $type_user, pantalla) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);
	var previous_message = JSON.parse($message);

	var url = new URL("http://schoolmanager:8080/messages/" + school + "/person/" + person + "/newMessage"); 

	const params = {
		previous_message : previous_message,
		type_user : $type_user,
		pantalla : pantalla
	};

	Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

	window.location.href = url;
}
