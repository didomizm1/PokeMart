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

    var street1 = document.registration.street1.value;
    var street2 = document.registration.street2.value;  
    var city = document.registration.city.value;
    var state = document.registration.state.value;  
    var zip_code = document.registration.zip_code.value;
    var country = document.registration.country.value;
    
    //check data for proper formatting and validity
    if(id.length=="" && ps.length=="") {  
        alert("User Name and Password fields are empty");  
        return false;  
    }  
    else  
    {  
        if(id.length=="") {  
            alert("User Name is empty");  
            return false;  
        }   
        if (ps.length=="") {  
        alert("Password field is empty");  
        return false;  
        }  
    }                             
}