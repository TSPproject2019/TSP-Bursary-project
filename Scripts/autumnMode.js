function autumnBreez() {
   var element = document.querySelector("body");
    if(element.classList.contains('t--dark') || element.classList.contains('t--summer') || element.classList.contains('t--winter')) {
        element.classList.remove('t--dark');
        element.classList.remove('t--summer');
        element.classList.remove('t--winter');       
        element.classList.add('t--autumn');
         
    } else {
        element.classList.toggle('t--autumn');
    }
}