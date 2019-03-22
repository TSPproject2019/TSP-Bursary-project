function winterChill() {
   var element = document.querySelector("body");
    if(element.classList.contains('t--dark') || element.classList.contains('t--autumn') || element.classList.contains('t--summer')) {
        element.classList.remove('t--dark');
        element.classList.remove('t--summer');
        element.classList.remove('t--autumn');       
        element.classList.add('t--winter');
         
    } else {      
        element.classList.toggle('t--winter');
    }
}