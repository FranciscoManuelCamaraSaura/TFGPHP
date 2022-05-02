const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

function subjects($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/subjects/" + school + "/person/" + person + "?type_user=" + $type_user;
}

function students($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/students/" + school + "/person/" + person + "?type_user=" + $type_user;
}

function messages($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/messages/" + school + "/person/" + person + "?type_user=" + $type_user;
}

function alerts($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/alerts/" + school + "/person/" + person + "?type_user=" + $type_user;
}

function teachers($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/teachers/" + school + "/person/" + person + "?type_user=" + $type_user;
}

function legalGuardians($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/messages/person/" + person;
}

function managers($person) {
	var person = JSON.parse($person);

	window.location.href = "/messages/person/" + person;
}

function calendar($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/events/" + school + "/person/" + person + "?type_user=" + $type_user;
}

function events($person) {
	var person = JSON.parse($person);

	window.location.href = "/messages/person/" + person.id;
}

function help($person) {
	var person = JSON.parse($person);

	// window.location.href = "/messages/person/" + person.id;
}

function loadNewMessages($person) {
	fetch("/newMessages", {
		method : "POST",
		body: JSON.stringify({
			receiver : $person
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		if (data.noReadedMessages > 0) {
			$("#newMessages").show();
			$("#newMessages").html(data.noReadedMessages);
		}
	}).catch(error => console.error(error));
}

function loadEventDay($school, $person, $type_user) {
	var localeDate = new Date();

	Number.prototype.padLeft = function(base, chr) {
		var  len = (String(base || 10).length - String(this).length) + 1;

		return len > 0 ? new Array(len).join(chr || '0') + this : this;
	}

	var date = [
			localeDate.getDate().padLeft(),
			(localeDate.getMonth() + 1).padLeft(),
			localeDate.getFullYear()
		].join('/');

	fetch("/checkEvents", {
		method : "POST",
		body: JSON.stringify({
			school : $school,
			receiver : $person,
			today : date,
			type_user : $type_user
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		if (data.todaysEvents > 0) {
			$("#checkEvents").show();
			$("#checkEvents").html(data.todaysEvents);
		}
	}).catch(error => console.error(error));
}

function loadReadAlerts($person) {
	fetch("/readAlerts", {
		method : "POST",
		body: JSON.stringify({
			sender : $person
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		if (data.readAlerts > 0) {
			$("#readAlerts").show();
			$("#readAlerts").html(data.readAlerts);
		}
	}).catch(error => console.error(error));
}
