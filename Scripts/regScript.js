  var pass = document.getElementById('password');
  var popBox = document.getElementById('pPop');
  var sub = document.getElementById('but1');
  
  function pop(){
    popBox.style.display = "block";
  }
  
  function popDown(){
    popBox.style.display = "none";
  }
  
  function butHov(){
    sub.style.backgroundColor = "#93427c";
    sub.style.borderColor = "#93427c";
  }
  
  function butLeave(){
    sub.style.backgroundColor = "#20134c";
    sub.style.borderColor = "#20134c";
  }