const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');

function showPassword() {
	const type = password.getAttribute("type") === "password" ? "text" : "password";
	password.setAttribute("type", type);

	//this.classList.toggle("fa-eye-slash");
}

function login($school) {
	var errores = validationFields();

	if(errores === "") {
		$("#error").hide();

		fetch("/identify", {
			method : "POST",
			body: JSON.stringify({
				school_id : $school,
				type_user : $("#type_user option:selected").val(),
				user_name : $("#user_name").val(),
				password : $("#password").val()
			}),
			headers: {
				"Content-Type": "application/json",
				"X-CSRF-Token": csrfToken
			}
		}).then(response => {
			return response.json();
		}).then(data => {
			validationData(data, $school);
		}).catch(error => console.error(error));
	} else {
		showErrors(errores);
	}
}

function validationData(data, $school) {
	if(typeof data.message === 'string') {
		showErrors(data.message);
	} else {
		switch ($("#type_user option:selected").val()) {
			case "Super Admin":
				window.location.href = "/home/superadmin/" + data.message.id;

				break;

			case "Admin":
				window.location.href = "/home/" + $school + "/admin/" + data.message.id;

				break;

			case "Manager":
				window.location.href = "/home/" + $school + "/manager/" + data.message.id;

				break;

			case "Teacher":
				window.location.href = "/home/" + $school + "/teacher/" + data.message.id;

				break;
		}
	}
}

function validationFields() {
	var errores = "";

	if($("#type_user option:selected").text() === "Seleccione un tipo de usuario" ) {
		errores += "You must chose a type" + "<br>";
	}

	if($("#user_name").val() === "" ) {
		errores += "You must insert a user name" + "<br>";
	}

	if($("#password").val() === "") {
		errores += "You must insert a password";
	}

	return errores;
}

function showErrors(errores) {
	$("#error").show();
	$("#error").html(errores);
}
