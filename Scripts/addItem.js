//alert("Connected");
// set counter variable for items
var runCount = 0;
var ct = 2;
// set variable to be used to establish the number of items
var itemCounter = 0;

function add_feed() //Maybe create elements each time the function runs? document.createElement[tag, options]
{
   if (runCount == 0){
        onFormLoad();
         runCount++;
    }
    var div1 = document.createElement('div');
    div1.id = itemCounter;
    console.log(itemCounter);
    //var addelement = '<input>Description />';
    //Get template data
    div1.innerHTML = document.getElementById('newitem').innerHTML;
    document.getElementById('newlink').appendChild(div1);
    //This name attribute change works
    var icat = 'itemcategory' + itemCounter;
     window.alert(icat);
     // start test A
    var h = document.createElement('h5');
      h.setAttribute('id', "hd05");
      h.innerHTML = "Item " + itemCounter;
    div1.appendChild(h);
    var d1 = document.createElement('div');
      d1.id = "optionDiv";
      d1.setAttribute('class',"col-12 mt-2 mb-5");
    div1.appendChild(d1);
    var a = document.createElement('select');
      //element.appendChild('newlink');
      a.setAttribute('name',icat);
      a.setAttribute('class', "custom-select");
      a.setAttribute('id', "categoryField");
    d1.appendChild(a);
    // end test A
    // start test B
    //document.getElementsById('hd05')[itemCounter].innerHTML = 'Item ' + itemCounter;
      //z.innerHTML = 'Item ' + itemCounter;
    var b = document.getElementsByTagName('select')[itemCounter];
     window.alert(icat);
     window.alert(b);
      b.setAttribute('name',icat);
      b.setAttribute('class', "custom-select");
      b.setAttribute('id', "categoryField");
   // var c = document.getElementsById('categoryField')[itemCounter];
   //   c.name = icat;
    // end test B //This line does not want to work.
    document.getElementsById('categoryField')[itemCounter].name = icat;

    //document.getElementsByTagName('select')[itemCounter].setAttribute('name',icat);
    var itemcategory = document.getElementsByTagName("select")[itemCounter].getAttribute("name");
    //Rest inputs: iitemdescriptiontemdescription, URl, Price etc still needs to be incremented
    
    document.getElementById("").setAttribute("id","itemdescription"+itemCounter);
    // need to set "document.name"+itemCounter
    document.getElementById("itemdescription")[itemCounter].setAttribute("name","itemdescription"+itemCounter);
    var itemdescription = document.getElementById("itemdescription")[itemCounter].getAttribute("name");
    
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

// **** start run once.
function onFormLoad() {
    // run this only once
    itemCounter = getItemCount();
    ct = itemCounter;
    window.alert("itemCounter" + itemCounter);
    itemCounter++;
}
// **** end run once.
// may read in the name tags of the bage and get the supplied number of items.
function getItemCount(){ // this needs to be an onLoad() action
    var x = document.getElementsByName("numberOfItems").length;
    // find the numberOfItems element
    window.alert("x: " + x);
    return x;
}
