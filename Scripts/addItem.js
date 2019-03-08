//alert("Connected");
// set counter variable for items
var runCount = 0;
// set variable to be used to establish the number of items
var itemCounter = 0;

function add_feed(){ // to add item fields to a request
   if (runCount == 0){
        onFormLoad();
        // runCount++; // this is for setting a limit to the number of items, if so desired
    }
    var div1 = document.createElement('div');
    div1.id = itemCounter;
    console.log(itemCounter);
    //Get div field to start propogating from
    document.getElementById('newlink').appendChild(div1);
    //This name attribute change works
    var iurl = 'itemUrl' + itemCounter; // 
    var ides = 'itemdescription' + itemCounter; // 
    var icat = 'itemcategory' + itemCounter; // 
    // test message A
    window.alert("A: " + icat + ", " + ides); // for testing only
     // start test A
    // item number header
    var h = document.createElement('h5');
      h.setAttribute('id', "hd05"); // needs to be added to the source PHP
      h.setAttribute('name', "numberOfItems"); // needs to be added to the source PHP, as is used to count current items
      h.innerHTML = "Item " + itemCounter;
    div1.appendChild(h);
    // select option section
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
    var o1 = document.createElement('option');
      o1.setAttribute('value', "");
      o1.setAttribute('selected', "");
      o1.innerHTML = "Choose...";
    var o2 = document.createElement('option');
      o2.setAttribute('value', "Qualification");
      o2.innerHTML = "Qualification";
    var o3 = document.createElement('option');
      o3.setAttribute('value', "Equipment");
      o3.innerHTML = "Equipment";
    var o4 = document.createElement('option');
      o4.setAttribute('value', "Events");
      o4.innerHTML = "Events";
    var o5 = document.createElement('option');
      o5.setAttribute('value', "Professional accreditation");
      o5.innerHTML = "Professional accreditation";
    var o6 = document.createElement('option');
      o6.setAttribute('value', "Vocational placement");
      o6.innerHTML = "Vocational placement";
    a.appendChild(o1);
    a.appendChild(o2);
    a.appendChild(o3);
    a.appendChild(o4);
    a.appendChild(o5);
    a.appendChild(o6);
    // item description section
    var d2 = document.createElement('div');
      d2.setAttribute('class', "form-group row");
    div1.appendChild(d2);
    var d2a = document.createElement('div');
      d2a.setAttribute('class', "col-12");
    d2.appendChild(d2a);
    var d2ai = document.createElement('input');
      d2ai.setAttribute('type', "text");
      d2ai.setAttribute('name', ides);
      d2ai.setAttribute('class', "form-control");
      d2ai.setAttribute('placeholder', "Item description:");
      //d2ai.setAttribute('required',); // does not seem to work if the requried field is added
    d2a.appendChild(d2ai);
    // item URL section
    var d3 = document.createElement('div');
    d3.setAttribute('class', "form-group row");
    div1.appendChild(d3);
    var d3a = document.createElement('div');
      d3a.setAttribute('class', "col-12");
    d3.appendChild(d3a);
    var d3ai = document.createElement('input');
      d3ai.setAttribute('type', "text");
      d3ai.setAttribute('name', iurl);
      d3ai.setAttribute('class', "form-control");
      d3ai.setAttribute('placeholder', "URL to the item:");
      //d2ai.setAttribute('required',); // does not seem to work if the requried field is added
    d3a.appendChild(d3ai);


    // end test A
    // set console log output for testing
    console.log(ides);
    console.log(icat);
    itemCounter++;
}
function delItem(eleId){
    d = document;
    var ele = d.getElementById(eleId);
}

// get the item count
function onFormLoad() {
    itemCounter = getItemCount();
   // window.alert("itemCounter" + itemCounter); // for testing only
    itemCounter++;
}
// may read in the name tags of the bage and get the supplied number of items.
function getItemCount(){ // this needs to be an onLoad() action
    // find the numberOfItems element
    var x = document.getElementsByName("numberOfItems").length;
    //window.alert("x: " + x); // for testing only
    return x;
}
