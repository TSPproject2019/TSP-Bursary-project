EnableSubmit = function(val)
        {
            var sbmt = document.getElementById("Submit");

            if (val.checked == true)
            {
             sbmt.disabled = false;
            }
            else
            {
                sbmt.disabled = true;
            }
        }