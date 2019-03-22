/*document
  .querySelector('.js-change-theme')
  .addEventListener('click', () => {
    const body = document.querySelector('body');
  
    if (body.classList.contains('t--light')) {
      body.classList.remove('t--light');
      body.classList.add('t--dark');
    }    
    else {
      body.classList.remove('t--dark');
      body.classList.add('t--light');
    }
  }); */

function nightfall() {
   var element = document.querySelector("body");
    if(element.classList.contains('t--summer') || element.classList.contains('t--autumn') || element.classList.contains('t--winter')  ) {
        element.classList.remove('t--summer');
        element.classList.remove('t--autumn');
        element.classList.remove('t--winter');
        element.classList.add('t--dark');
   
    } else {
        element.classList.toggle('t--dark');
    }
    
       
}