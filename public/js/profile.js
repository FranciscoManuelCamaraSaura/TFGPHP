const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

function modifyData() {
	$("#addressLabel").hide();
	$("#locationLabel").hide();
	$("#provinceLabel").hide();
	$("#phoneLabel").hide();
	$("#emailLabel").hide();

	$("#editButton").hide();
	$("#changePasswordButton").attr('disabled', 'disabled');
	$("#backButton").hide();

	$("#addressInput").show();
	$("#locationInput").show();
	$("#provinceInput").show();
	$("#phoneInput").show();
	$("#emailInput").show();

	$("#saveButton").show();
	$("#cancelButton").show();
}

function updateData($person) {
	var errores = "";

	errores += validationResidenceData();
	errores += validationContactData();

	if(errores === "") {
		$("#error").hide();

		fetch("/person", {
			method : "PUT",
			body: JSON.stringify({
				person : $person,
				address : $("#addressInput").val(),
				location : $("#locationInput").val(),
				province : $("#provinceInput").val(),
				phone : $("#phoneInput").val(),
				email : $("#emailInput").val(),
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

function validationResidenceData() {
	var errores = "";

	if($("#addressInput").val() === "") {
		errores += "You must insert the address of the legal guardian" + "<br>";
	}

	if($("#locationInput").val() === "") {
		errores += "You must insert the location of the legal guardian" + "<br>";
	}

	if($("#provinceInput").val() === "") {
		errores += "You must insert the province of the legal guardian" + "<br>";
	}

	return errores;
}

function validationContactData() {
	var errores = "";

	if(!validatePhoneNumber($("#phoneInput").val())) {
		errores += "You must insert a correct phone number (+34 654 321 987)" + "<br>";
	}

	if(!validateEmail($("#emailInput").val())) {
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

function cancelModificationData() {
	$("#addressLabel").show();
	$("#locationLabel").show();
	$("#provinceLabel").show();
	$("#phoneLabel").show();
	$("#emailLabel").show();

	$("#editButton").show();
	$("#changePasswordButton").removeAttr('disabled');
	$("#backButton").show();

	$("#addressInput").hide();
	$("#locationInput").hide();
	$("#provinceInput").hide();
	$("#phoneInput").hide();
	$("#emailInput").hide();

	$("#saveButton").hide();
	$("#cancelButton").hide();
}

function changePassword() {
	$("#name").hide();
	$("#address").hide();
	$("#location").hide();
	$("#province").hide();
	$("#phone").hide();
	$("#email").hide();
	$("#nameLabel").hide();
	$("#addressLabel").hide();
	$("#locationLabel").hide();
	$("#provinceLabel").hide();
	$("#phoneLabel").hide();
	$("#emailLabel").hide();

	$("#editButton").attr('disabled', 'disabled');
	$("#changePasswordButton").hide();
	$("#backButton").hide();

	$("#oldPassword").show();
	$("#newPassword").show();
	$("#repeatNewPassword").show();

	$("#oldPasswordInput").show();
	$("#newPasswordInput").show();
	$("#repeatNewPasswordInput").show();

	$("#savePasswordButton").show();
	$("#cancelChangePasswordButton").show();
}

function updatePassword($person, $type_user) {
	var errores = validationFields();

	if(errores === "") {
		$("#error").hide();
		var url = "";

		if ($type_user === "Teacher") {
			url = "/password/teacher";
		} else if ($type_user === "Manager" || $type_user === "Admin") {
			url = "/password/manager";
		}

		fetch(url, {
			method : "PUT",
			body: JSON.stringify({
				person : $person,
				oldPassword : $("#oldPasswordInput").val(),
				newPassword : $("#newPasswordInput").val()
			}),
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-Token": csrfToken
			}
		}).then(response => {
			return response.json();
		}).then(data => {
			validationData(data);
		}).catch(error => console.error(error));
	} else {
		showErrors(errores);
	}
}

function validationFields() {
	var errores = "";

	if($("#oldPasswordInput").val() === "") {
		errores += "You must insert the old password" + "<br>";
	}

	if($("#newPasswordInput").val() === "") {
		errores += "You must insert a new password" + "<br>";
	}

	if($("#repeatNewPasswordInput").val() === "") {
		errores += "You must repeat the new password" + "<br>";
	}

	if($("#oldPasswordInput").val() !== "" && $("#newPasswordInput").val() !== "" && $("#oldPasswordInput").val() === $("#newPasswordInput").val()) {
		errores += "The old password must be diferent of the new password" + "<br>";
	}

	if($("#newPasswordInput").val() !== "" && $("#repeatNewPasswordInput").val() !== "" && $("#newPasswordInput").val() !== $("#repeatNewPasswordInput").val()) {
		errores += "You must repeat the new password";
	}

	return errores;
}

function validationData(data) {
	if(typeof data.message === 'string') {
		showErrors(data.message);
	} else {
		cancelChangePassword();
	}
}

function showErrors(errores) {
	$("#error").show();
	$("#error").html(errores);
}

function cancelChangePassword() {
	$("#error").hide();

	$("#name").show();
	$("#address").show();
	$("#location").show();
	$("#province").show();
	$("#phone").show();
	$("#email").show();
	$("#nameLabel").show();
	$("#addressLabel").show();
	$("#locationLabel").show();
	$("#provinceLabel").show();
	$("#phoneLabel").show();
	$("#emailLabel").show();

	$("#editButton").removeAttr('disabled');
	$("#changePasswordButton").show();
	$("#backButton").show();

	$("#oldPassword").hide();
	$("#newPassword").hide();
	$("#repeatNewPassword").hide();

	$("#oldPasswordInput").hide();
	$("#newPasswordInput").hide();
	$("#repeatNewPasswordInput").hide();

	$("#savePasswordButton").hide();
	$("#cancelChangePasswordButton").hide();
}
