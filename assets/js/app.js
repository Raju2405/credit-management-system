function numval(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function add_user()
{
	var form = document.getElementById("add_new_user");
	var button = document.getElementById("add_user_button");

	if(form.style.display === "none")
	{
		form.style.display = "flex";
		button.classList.remove("btn-primary");
		button.classList.add("btn-danger");
		button.innerHTML = "CANCEL";
	}
	else
	{
		form.style.display = "none";
		button.classList.remove("btn-danger");
		button.classList.add("btn-primary");
		button.innerHTML = "ADD USER";
	}
}

$(".form-group #rating").on("keypress", function(e){
    var currentValue = String.fromCharCode(e.which);
    var finalValue = $(this).val() + currentValue;
    if(finalValue > 10){
        e.preventDefault();
    }
});
