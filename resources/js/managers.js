const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

function newManager($school, $person, $type_user) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);

	window.location.href = "/managers/" + school + "/person/" + person + "/newManager?type_user=" + $type_user;
}

function editManager($school, $person, $type_user, manager) {
	var school = JSON.parse($school);
	var person = JSON.parse($person);console.log( $type_user);

	window.location.href = "/managers/" + school + "/person/" + person + "/editManager/" + manager + "?type_user=" + $type_user;
}

function deleteManager($manager) {
	fetch("/deleteManager", {
		method : "PUT",
		body: JSON.stringify({
			manager : $manager
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

function validateType($school) {
	fetch("/validateType", {
		method : "POST",
		body: JSON.stringify({
			school : $school,
			type_admin : $("#managerType option:selected").val()
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		if(data.message !== "") {
			$("#errorType").show();
			$("#errorType").html(data.message);
			disabledButton();
		} else {
			enableButton();
		}
	}).catch(error => console.error(error));
}

function disabledButton() {
	$("#save").attr('disabled', 'disabled');
}

function enableButton() {
	$("#errorType").hide();
	$("#save").removeAttr('disabled');
}

function save($manager, $school, $type_user) {
	var errores = "";

	errores += validationManagerData();
	errores += validationResidenceData();
	errores += validationContactData();

	if(errores === "") {
		$("#error").hide();
		savePerson($manager, $school, $type_user);
	} else {
		showErrors(errores);
	}
}

function validationManagerData() {
	var errores = "";

	if(!validateDNI($("#managerDNI").val())) {
		errores += "You must insert a correct identification" + "<br>";
	}

	if($("#managerName").val() === "") {
		errores += "You must insert a legal guardian name" + "<br>";
	}

	if($("#managerSurnames").val() === "") {
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

	if($("#managerAddress").val() === "") {
		errores += "You must insert the address of the legal guardian" + "<br>";
	}

	if($("#managerLocation").val() === "") {
		errores += "You must insert the location of the legal guardian" + "<br>";
	}

	if($("#managerProvince").val() === "") {
		errores += "You must insert the province of the legal guardian" + "<br>";
	}

	if(!validatePostalCode($("#managerPostalCode").val())) {
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

	if(!validatePhoneNumber($("#managerPhone").val())) {
		errores += "You must insert a correct phone number (+34 654 321 987)" + "<br>";
	}

	if(!validateEmail($("#managerEmail").val())) {
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

function savePerson($manager, $school, $type_user) {
	var url = "";

	if($manager === "") {
		url = "/newPerson";
	} else {
		url = "/updatePerson";
	}

	fetch(url, {
		method : "PUT",
		body: JSON.stringify({
			type_user : $type_user,
			dni : $("#managerDNI").val(),
			name : $("#managerName").val(),
			surnames : $("#managerSurnames").val(),
			address : $("#managerAddress").val(),
			location : $("#managerLocation").val(),
			province : $("#managerProvince").val(),
			phone : $("#managerPhone").val(),
			email : $("#managerEmail").val(),
			postal_code : $("#managerPostalCode").val()
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		saveManager(data.id, $manager, $school);
	}).catch(error => console.error(error));
}

function saveManager(person, $manager, $school) {
	if($manager === "") {
		url = "/addManager";
	} else {
		url = "/updateManager";
	}

	fetch(url, {
		method : "PUT",
		body: JSON.stringify({
			manager : person,
			school : $school,
			type_admin : $("#managerType option:selected").val()
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

function edit() {
	$("#managerDNILabel").hide();
	$("#managerNameLabel").hide();
	$("#managerSurnamesLabel").hide();
	$("#managerPhoneLabel").hide();
	$("#managerEmailLabel").hide();
	$("#managerAddressLabel").hide();
	$("#managerLocationLabel").hide();
	$("#managerProvinceLabel").hide();
	$("#managerPostalCodeLabel").hide();
	$("#managerTypeLabel").hide();

	$("#edit").hide();

	$("#managerDNI").show();
	$("#managerName").show();
	$("#managerSurnames").show();
	$("#managerPhone").show();
	$("#managerEmail").show();
	$("#managerAddress").show();
	$("#managerLocation").show();
	$("#managerProvince").show();
	$("#managerPostalCode").show();
	$("#managerType").show();

	$("#saveOptions").show();
}

function cancel() {
	$("#managerDNILabel").show();
	$("#managerNameLabel").show();
	$("#managerSurnamesLabel").show();
	$("#managerPhoneLabel").show();
	$("#managerEmailLabel").show();
	$("#managerAddressLabel").show();
	$("#managerLocationLabel").show();
	$("#managerProvinceLabel").show();
	$("#managerPostalCodeLabel").show();
	$("#managerTypeLabel").show();

	$("#edit").show();

	$("#managerDNI").hide();
	$("#managerName").hide();
	$("#managerSurnames").hide();
	$("#managerPhone").hide();
	$("#managerEmail").hide();
	$("#managerAddress").hide();
	$("#managerLocation").hide();
	$("#managerProvince").hide();
	$("#managerPostalCode").hide();
	$("#managerType").hide();

	$("#saveOptions").hide();
}

function showErrors(errores) {
	$("#error").show();
	$("#error").html(errores);
}
