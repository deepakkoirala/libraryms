 function delWishlist()
	{
		var	choice	= confirm("Delete Wishlist?");
		if(choice == 1)
			return true;
		else
			return false;
	}	
function editDpt()
{
	var	choice	= confirm("Edit Department?");
	if(choice == 1)
	return true;
	else
	return false;
}
 function delDpt()
{
	var	choice	= confirm("Delete Department?");
	if(choice == 1)
	return true;
else
	return false;
}	


function lostBook()
{
	var	choice	= confirm("Report Book as Lost?");
	if(choice == 1)
	return true;
	else
	return false;
}
function returnAllBook()
{
	var	choice	= confirm("Return All Books at Once?");
	if(choice == 1)
	return true;
	else
	return false;
}
function returnBook()
{
	var	choice	= confirm("Return Book?");
	if(choice == 1)
	return true;
	else
	return false;
}
function del_staff()
{
	var	choice	= confirm("Delete Staff?");
	if(choice == 1)
	return true;
	else
	return false;
}
function edit_mem()
{
	var	choice	= confirm("Edit Member?");
	if(choice == 1)
	return true;
	else
	return false;
}

function edit_staff()
{
	var	choice	= confirm("Edit Staff?");
	if(choice == 1)
	return true;
	else
	return false;
}
function edit_book()
{
	var	choice	= confirm("Edit Book?");
	if(choice == 1)
	return true;
	else
	return false;
}


function del_book()
{
	var	choice	= confirm("Delete Book?");
	if(choice == 1)
	return true;
	else
	return false;
}
function del_mem()
{
	var	choice	= confirm("Delete Member?");
	if(choice == 1)
	return true;
	else
	return false;
}
 
function clearall(form){
	var choice = confirm("This will load default values !");
	if(choice == true)
	{
		return true;
	}
	return false;
}
function focusLogin(){
	document.forms[0].elements[0].focus();
	
}
function nothing(){
	return false;
}
function logout()
{
	var	choice	= confirm("Confirm Logout ?");
	if(choice == 1)
	return true;
	else
	return false;
}
function checkData(f)
{
	//Retriving userdata from the form inputs
	email=f.txtemail.value.trim();
	pass=f.txtpass.value.trim();
		
	//userID validation
	
	if(email == "")
	{
		f.txtid.focus();
		document.getElementById("id").innerHTML="Email Required !";
		return false;
	}
	else
	{
		document.getElementById("id").innerHTML="";
		f.txtemail.focus();
	}
	//password validation
	
	if(pass == "")
	{
		f.txtpass.focus();
		document.getElementById("password").innerHTML="Password Required !";
		return false;
	}
	else
	{
		
		document.getElementById("password").innerHTML="";
	}
	return true;
}

function updateDateTime()
{
	var now = new Date();
	var day = now.getDate();
	var dayno = now.getDay();
	var month = now.getMonth();
	var year = now.getFullYear();

	var weekday = new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	var mon = new Array("Januray","February","March","April","May","June","July","August","September","October","November","December");
	var t;
	var getdate = new Date();
	var date = getdate.toLocaleString();
	var time = getdate.toLocaleTimeString();
	
	document.getElementById("dateTime").innerHTML = weekday[dayno]+","+mon[month]+" "+day+","+year+"<br\>"+time;
	t = setTimeout(function(){updateDateTime()},1000);		
}	
setTimeout(function(){updateDateTime()},1);
// JavaScript Document
/*function changeBackground()
{
	var color;
	colorId=prompt("Enter Color:","White");
	document.getElementById("newBackground").style.background=colorId;
}*/
//	Navigator Infos				   = Outputs
// 	-----------------------------------------------
/*	appName = navigator.appName; = Netscape
	appCodeName = navigator.appCodeName; = Mozilla
	appVersion = navigator.appVersion; = 5.0 Windows
	cookieEnabled =	navigator.cookieEnabled; = True
	geoLocation = navigator.geolocation;	= Undefined
	mimeType = navigator.mimeTypes;[ObjectMimeTypeArray]
	plugin = navigator.plugins.length; = 6
	userAgent = navigator.userAgent; =  Mozilla/5.0 Windows NT Firefox 25.0 full details
	javaEnabledState = navigator.javaEnabled();  = false

	alert("Welcome "+navigator.appCodeName+" user. SystemEnvironment:"+navigator.userAgent);

	switch(navigator.platform)
	{
			case "Win32":
				alert("You are running "+navigator.appCodeName+" in Windows.");
				break;
			case "MacPPC":
				alert("You are running "+navigator.appCodeName+" in Mac PC.");
				break;
			case "MacIntel":
				alert("You are running "+navigator.appCodeName+" in Intel based Mac.");
				break;
			default:
				alert("You havce " + navigator.platform);
	}
*/
function updateDateTime()
{
	var t;
	var getdate = new Date();	
	var date = getdate.toLocaleDateString();
	
	var day = new Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
	var CurrentDay = getdate.getDay();
	
	var month = new Array("Jan","Feb","March","Apr","May","Jun","July","Aug","Sept","Oct","Nov","Dec");
	var CurrentMonth = getdate.getMonth();
	
	var MonthDay = getdate.getDate();
	
	var time = getdate.toLocaleTimeString();
	document.getElementById("dateTime").innerHTML = day[CurrentDay]+", "+month[CurrentMonth]+" "+MonthDay+", "+getdate.getFullYear()+"<br\>"+time;

	t = setTimeout(function(){updateDateTime()},1000);		
}	
setTimeout(function(){updateDateTime()},1);
function getWeatherData()
{
	$.get("GetWeatherInfo.php",null,function(json) {	
	
	var d = jQuery.parseJSON(json);	
	
	temp = Math.floor(d["main"]["temp"]);
	temp = temp+"&deg;c";
	temp_min = d["main"]["temp_min"]+"&deg;c";
	temp_max = d["main"]["temp_max"]+"&deg;c";
	humidity = d["main"]["humidity"]+"%";
	cloudiness = d["clouds"]["all"]+"%";
	description = d["weather"][0]["description"];
	
	document.getElementById("weather").innerHTML = "Mostly <font color=\"yellow\">"+description+"</font>. It's <font color=\"yellow\">"+temp+"</font>;with clouds <font color=\"yellow\">"+cloudiness+"</font> & humidity <font color=\"yellow\">"+humidity+"</font>";
	});
	t = setTimeout(function(){getWeatherData()},10000);
}
setTimeout(function(){getWeatherData()},1);

function checkNumber(check)
     {
          var ascii = (check.which) ? check.which : event.keyCode;
          if (ascii != 46 && ascii > 31 && (ascii < 48 || ascii > 57))
             return false;
			 
          return true;
	 }
function checkEmail(form)
{	

	
						if(document.forms[1].elements[1].value!=="" || document.forms[1].elements[1].value== NULL)
							{
								checkAt = document.forms[1].elements[1].value.indexOf('@',0);
								checkDot = document.forms[1].elements[1].value.indexOf('.',0);
								if((checkAt == -1 ) || (checkDot == -1))
								{
									alert("Invalid E-mail Format.");
									document.forms[1].elements[1].value = "";
									document.forms[1].elements[1].focus();
									
									
								}
								var email = document.forms[1].elements[1].value;
								var len = email.length;
								if(len>30)
								{
									alert("Email Cannot exceed 30 characters.");
									document.forms[1].elements[1].value = "";
									document.forms[1].elements[1].focus();
									
								}
							}			
}

function getnewCode(f)
{

	var a = Math.random();
	var b = Math.random();
    a = a*10;
	a = Math.ceil(a);
	b = b*10;
	b = Math.ceil(b);
	document.getElementById("newCode").innerHTML = " "+a + " + " + b;	
}
function captchaCalc()
{
	var firstNumber = parseInt(document.getElementById("newCode").innerHTML);
	var str = document.getElementById("newCode").innerHTML;
	var secondNumber = str.charAt((str.indexOf("+")+1))+str.charAt((str.indexOf("+")+2));	
	var realSum = eval(firstNumber)+eval(secondNumber);
	return(realSum);
}

function VerifyReset(form)
{
	var r = confirm("This will clear all your form inputs!");
	if(r == true)	
	{
			form.reset();		
			return true;	
	}
	return false;
}

function VerifySend(f)
{
	if(f.Name.value.trim()=="")
	{
		showError("name","Enter your name!");
		document.forms[1].elements[0].focus();
		return false;
	}else
	{
		showError("name","");
	}
	if(f.Email.value.trim()=="")
	{
		document.forms[1].elements[1].focus();
		showError("email","E-mail required!");
		return false;
	}
	else
	{
		showError("email","");
	}
	if(f.Comment.value.trim()=="")
	{
		document.forms[1].elements[4].focus();
		showError("message","Enter your comments!");
		return false;
	}else
	{
		showError("message","");
	}
	var userInput = eval(document.forms[1].elements[5].value.trim());
	if(userInput!=captchaCalc())							
	{
		
		document.forms[1].elements[5].focus();
		showError("challenge","Type correct captch code!");
		return false;						
	}else
	{
		showError("challenge","");
	}					
}
function showError(id,msg)
{
	document.getElementById(id).innerHTML=msg;

}

function gpaResult(f)
{
	// GPA = totalgradepointsEarned / totalcreditHours;
	// totalgradePoints = creditHour * gradeValue;
	var totalcreditHours = 0;
	var totalgradePoints = 0;
	var totalSubjects = 10;
	for(var currentSubject = 1;currentSubject<=totalSubjects;currentSubject++)
	{
		var currentcreditElement ="creditHour"+currentSubject;
		var currentgradeElement = "grade"+currentSubject;
		
		var currentCreditHour=eval(f.elements[currentcreditElement].value);		
		var currentGradeValue=eval(f.elements[currentgradeElement].value);
		var currentGradePoint = currentGradeValue*currentCreditHour;	
		if ((currentGradeValue > -1) && (currentCreditHour > 0))
		{
			totalcreditHours+=currentCreditHour;
			totalgradePoints+=currentGradePoint;					
		}						
	}
	var GPA = Math.round(100 * totalgradePoints / totalcreditHours) / 100;
	f.totalCredits.value = totalcreditHours;
	document.getElementById("final").innerHTML=GPA;
	return false;
}