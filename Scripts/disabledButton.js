var checker = document.getElementById('agreeCheckbox');
var sendbtn = document.getElementById('send');

checker.onchange = function() {
  sendbtn.disabled = !this.checked;
};