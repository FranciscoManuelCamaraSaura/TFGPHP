const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

function showLocations() {
	fetch("/locations", {
		method : "POST",
		body: JSON.stringify({
			province : $("#provinces option:selected").val()
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		var locationsSelect = "<option disabled=\"disabled\" selected=\"selected\">Seleccione una localidad</option>";
		var schoolsSelect = "<option disabled=\"disabled\" selected=\"selected\">Seleccione un colegio</option>";
		disabledButton();

		for (let i in data.locations) {
			locationsSelect += "<option value=\"" + data.locations[i] + "\">" + data.locations[i] + "</option>";
		}

		$("#locations").html(locationsSelect);
		$("#schools").html(schoolsSelect);
	}).catch(error => console.error(error));
}

function showSchools() {
	fetch("/schools", {
		method : "POST",
		body: JSON.stringify({
			location : $("#locations option:selected").val()
		}),
		headers: {
			"Content-Type": "application/json",
			"X-CSRF-Token": csrfToken
		}
	}).then(response => {
		return response.json();
	}).then(data => {
		var schoolsSelect = "<option disabled=\"disabled\" selected=\"selected\">Seleccione un colegio</option>";
		disabledButton();

		for(let i in data.schoolsName) {
			schoolsSelect += "<option value=\"" + data.schoolsId[i] + "\">" + data.schoolsName[i] + "</option>";
		}

		$("#schools").html(schoolsSelect);
	}).catch(error => console.error(error));
}

function disabledButton() {
	$("#next").attr('disabled', 'disabled');
}

function enableButton() {
	$("#next").removeAttr('disabled');
}

function login() {
	window.location.href = "/school/" + $("#schools option:selected").val();
}
