//registration form data validation
function validate()
{  
    //variables
    var password = document.registration.password.value;
    var password2 = document.registration.password2.value;
    var date_of_birth = document.registration.date_of_birth.value;
    var state = document.registration.state.value;
    var country = document.registration.country.value;

    //validate data
    if(password != password2)
    {
        alert("Provided passwords do not match");
        return false;
    }

    //check if the user is at least 18 years of age
    const currentDate = new Date();
    currentYear = currentDate.getFullYear();
    birthYear = date_of_birth.getFullYear();
    if(currentYear - birthYear < 18)
    {
        alert("You must be 18 years or older to register");
        return false;
    }

    if(country == "United States of America" && state.length == 0)
    {
        alert("State required for selected country");
        return false;
    }
    else if(country != "United States of America" && state.length != 0)
    {
        alert("State not allowed for selected country");
        return false;
    }
    
    return true;
}