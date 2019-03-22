  var pass = document.getElementById('password');
  var popBox = document.getElementById('pPop');
  var sub = document.getElementById('but1');
  var rePas = document.getElementById('repassword');
  var hint = document.getElementById('hint');
  var chBox = document.getElementById('agreeCheckbox');
  
  var check = function() 
  {
  if (pass.value === rePas.value && chBox.checked == true) {
    document.getElementById('message2').style.color = 'green';
    document.getElementById('message2').innerHTML = "Passwords match";
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = "Form agreed to";
    pass.style.borderColor = 'green';
    rePas.style.borderColor = 'green';
    sub.disabled = false;
  } 
  if (pass.value === rePas.value && chBox.checked == false) {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = "You must agree to the agreement form";
    document.getElementById('message2').style.color = 'green';
    document.getElementById('message2').innerHTML = "Passwords match";
    pass.style.borderColor = 'green';
    rePas.style.borderColor = 'green';
    sub.disabled = 'disabled';
  }
  if (pass.value == null || pass.value == "" || rePas.value == null || rePas.value == "") {
    document.getElementById('message2').style.color = 'red';
    document.getElementById('message2').innerHTML = "Passwords cannot be empty";
    pass.style.borderColor = 'red';
    rePas.style.borderColor = 'red';
    sub.disabled = 'disabled';
  }
  if (pass.value !== rePas.value) {
    document.getElementById('message2').style.color = 'red';
    document.getElementById('message2').innerHTML = "Passwords do not match";
    pass.style.borderColor = 'red';
    rePas.style.borderColor = 'red';
    sub.disabled = 'disabled';
  }
  if (pass.value !== rePas.value && chBox.checked == false) {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = "You must agree to the agreement form";
    document.getElementById('message2').style.color = 'red';
    document.getElementById('message2').innerHTML = "Passwords do not match";
    pass.style.borderColor = 'red';
    rePas.style.borderColor = 'red';
    sub.disabled = 'disabled';
  }
  }

  function pop(){
    popBox.style.display = "block";
  }
  
  function popDown(){
    popBox.style.display = "none";
  }

  function hUp(){
    hint.style.display = "block";
  }
  
  function hDown(){
    hint.style.display = "none";
  }
  
  function butHov(){
    sub.style.backgroundColor = "#93427c";
    sub.style.borderColor = "#93427c";
  }
  
  function butLeave(){
    sub.style.backgroundColor = "rgba(32, 19, 76, 1)";
    sub.style.borderColor = "rgba(32, 19, 76, 1)";
  }