//registration form data validation
function validate()
{  
    //variables
    var state = document.registration.state.value;
    var country = document.registration.country.value;

    //validate data
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