function submit() {
	

	var author = document.getElementById("author").value;
	var heading = document.getElementById("heading").value;
	var entry = document.getElementById("entry").value;
	var password = document.getElementById("password").value;
	
	if(author == "")
	{
		alert('The field for AUTHOR name is not filled out, please enter your name to continue');
	}
	else if(heading == "")
	{
		alert('The field for HEADING name is not filled out, please enter your name to continue');
	}
	else if(entry == "")
	{
		var r = confirm('You have not put any content in this blogg, to you want it this way?');
		if(r == true)
		{
			document.getElementById("mainform").submit();
		}
	}
	else if(password == "")
	{
		alert("You have not enterd a password, if you don't get the passowrd correct you're blog will be deleted so check it carefully");
	}
	else
	{
		document.getElementById("mainform").submit();
	}
}