//alert("Connected");
var ct = 1;
   function add_feed()
   {
       ct++;
       var div1 = document.createElement('div');
       div1.id = ct;
       console.log(ct);
       //var addelement = '<input>Description />';
       //Get template data
       div1.innerHTML = document.getElementById('newitem').innerHTML;
       document.getElementById('newlink').appendChild(div1);
       //This name attribute change works
       document.getElementsByTagName("select")[ct-1].setAttribute("name","itemcategory"+ct);
       var itemcategory = document.getElementsByTagName("select")[ct-1].getAttribute("name");
       //Rest inputs: iitemdescriptiontemdescription, URl, Price etc still needs to be incremented
       
       document.getElementById("").setAttribute("id","itemdescription"+ct);
       
       document.getElementById("itemdescription")[ct-1].setAttribute("name","itemdescription"+ct);
       var itemdescription = document.getElementById("itemdescription")[ct-1].getAttribute("name");
       
       console.log(itemdescription);
       
               
       
       console.log(itemcategory);
   }
   function delItem(eleId)
   {
       d = document;
       var ele = d.getElementById(eleId);
   }
   //http://www.satya-weblog.com/2010/02/add-input-fields-dynamically-to-form-using-javascript.html
