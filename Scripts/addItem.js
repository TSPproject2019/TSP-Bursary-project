//alert("Connected");
// set counter variable for items
var ct = 0;
// set variable to be used to establish the number of items
var itemCounter = 0;


// **** start onload event listner.
function onFormLoad() {
    itemCounter = getItemCount();
    ct = itemCounter - 1;
    itemCounter++;
    // /onload="onFormLoad()" src="addItem.js"
}
// **** end onload event listner.

function add_feed()
{
    var div1 = document.createElement('div');
    div1.id = ct;
    console.log(ct);
    //var addelement = '<input>Description />';
    //Get template data
    div1.innerHTML = document.getElementById('newitem').innerHTML;
    document.getElementById('newlink').appendChild(div1);
    //This name attribute change works
    document.getElementsByTagName("select")[ct-1].setAttribute("name","itemcategory"+itemCounter);
    var itemcategory = document.getElementsByTagName("select")[ct-1].getAttribute("name");
    //Rest inputs: iitemdescriptiontemdescription, URl, Price etc still needs to be incremented
    
    document.getElementById("").setAttribute("id","itemdescription"+itemCounter);
    // need to set "document.name"+itemCounter
    document.getElementById("itemdescription")[ct-1].setAttribute("name","itemdescription"+itemCounter);
    var itemdescription = document.getElementById("itemdescription")[ct-1].getAttribute("name");
    
    console.log(itemdescription);
    
            
    
    console.log(itemcategory);
    itemCounter++;
    ct++;
}

function delItem(eleId)
{
    d = document;
    var ele = d.getElementById(eleId);
}
//http://www.satya-weblog.com/2010/02/add-input-fields-dynamically-to-form-using-javascript.html

// may read in the name tags of the bage and get the supplied number of items.
function getItemCount(){ // this needs to be an onLoad() action
    var itemID = document.getElementsByName("numberOfItems");
    // find the numberOfItems element 
    itemS = itemID.value;
    return itemS;
}
