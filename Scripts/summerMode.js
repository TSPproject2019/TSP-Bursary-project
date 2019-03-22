function summerJam() {
   var element = document.querySelector("body");
    if(element.classList.contains('t--dark') || element.classList.contains('t--autumn') || element.classList.contains('t--winter')) {
        element.classList.remove('t--dark');
        element.classList.remove('t--autumn');
        element.classList.remove('t--winter');       
        element.classList.add('t--summer');
         
    } else {
        element.classList.toggle('t--summer');
    }
}