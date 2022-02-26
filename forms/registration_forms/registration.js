//registration form data validation
function validate()
{  
    //variables
    var password = document.registration.password.value;
    var password2 = document.registration.password2.value;
    var state = document.registration.state.value;
    var country = document.registration.country.value;

    //validate data
    if(password != password2)
    {
        alert("Provided passwords do not match");
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
}