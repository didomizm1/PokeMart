//registration form data validation
function validate()
{  
    //variables
    var username = document.registration.username.value;  
    var password = document.registration.password.value;
    var password2 = document.registration.password2.value;

    var first_name = document.registration.first_name.value;
    var middle_name = document.registration.middle_name.value;  
    var last_name = document.registration.last_name.value;
    var gender = document.registration.gender.value;  
    var date_of_birth = document.registration.date_of_birth.value;
    var email = document.registration.email.value;  
    var home_phone_number = document.registration.home_phone_number.value;
    var cell_phone_number = document.registration.cell_phone_number.value; 

    var street_1 = document.registration.street_1.value;
    var street_2 = document.registration.street_2.value;  
    var city = document.registration.city.value;
    var state = document.registration.state.value;  
    var zip_code = document.registration.zip_code.value;
    var country = document.registration.country.value;

    //check data for proper formatting and validity
    if(username.length == 0) 
    {  
        alert("No username provided");  
        return false;  
    }
    if(password.length == 0) 
    {  
        alert("No password provided");  
        return false;  
    }
    if(password !== password2)
    {
        alert("Re-entered password does not match")
        return false;
    }
    if(first_name.length == 0) 
    {  
        alert("No first name provided");  
        return false;  
    }
    if(last_name.length == 0) 
    {  
        alert("No last name provided");  
        return false;  
    }

    if(email.length == 0) 
    {  
        alert("No e-mail provided");  
        return false;  
    }
    if(home_phone_number.length == 0) 
    {  
        alert("No home phone number provided");  
        return false;  
    }

    if(street_1.length == 0) 
    {  
        alert("No street address provided");  
        return false;  
    }
    if(city.length == 0) 
    {  
        alert("No city provided");  
        return false;  
    }
    if(zip_code.length == 0) 
    {  
        alert("No zip code provided");  
        return false;  
    }
}