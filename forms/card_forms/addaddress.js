function myFunction() 
{
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("text");
  var street_add_1 = document.getElementById("street_add_1");
  var city = document.getElementById("city");
  var zip_code = document.getElementById("zip_code");

  if(checkBox.checked == true)
  {
    text.style.display = "block";
    street_add_1.setAttribute('required', '');
    city.setAttribute('required', '');
    zip_code.setAttribute('required', '');
  }
  else 
  {
    text.style.display = "none";
    street_add_1.removeAttribute('required');
    city.removeAttribute('required');
    zip_code.removeAttribute('required');
  }
}
