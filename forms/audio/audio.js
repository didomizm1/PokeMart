document.addEventListener('click', musicPlay);

function musicPlay() 
{
    document.getElementById('audio').play();
    document.removeEventListener('click', musicPlay);
}