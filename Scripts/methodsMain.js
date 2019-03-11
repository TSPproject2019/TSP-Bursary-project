//alert("Connected");
// set counter variable for items
var runCount = 0;
// set variable to be used to establish the number of items
var itemCounter = 0;

function addItem(){ // to add item fields to a request
  if (runCount == 0){
      onFormLoad();
      // runCount++; // this is for setting a limit to the number of items, if so desired
  }

  // set first div element for items fields
  var div1 = document.createElement('div');
  div1.id = itemCounter;
  console.log(itemCounter);
  //Get div field to start propogating from
  document.getElementById('newlink').appendChild(div1);
  //This name attribute change works
  var idel = 'javascript:deleteItem(' + itemCounter + ')';
  var iurl = 'itemUrl' + itemCounter; //    
  var ides = 'itemdescription' + itemCounter; // 
  var icat = 'itemcategory' + itemCounter; // 
  var ipri = 'itemprice' + itemCounter; //
  var ipos = 'itempostage' + itemCounter; //
  var icha = 'itemadditionalcharges' + itemCounter; //

  // start first div section
  var d0 = document.createElement('div');
    d0.setAttribute('class', "form-group row justify-content-between");
  div1.appendChild(d0);
  // item number header
  var h = document.createElement('h5');
    h.setAttribute('id', "hd05"); // needs to be added to the source PHP
    h.setAttribute('name', "numberOfItems"); // needs to be added to the source PHP, as is used to count current items
    h.innerHTML = "Item " + itemCounter;
  d0.appendChild(h);
  // span over 1 for (-) button
  var d0a = document.createElement('div');
    d0a.setAttribute('class',"delete-group col3")
  d0.appendChild(d0a);
    // span over 2 for (-) button
  var d0a1 = document.createElement('div');
    d0a1.setAttribute('class', "input-group-prepend")
  d0a.appendChild(d0a1);
  // this is the deleteItem(-) button
  var d0a1a = document.createElement('a');
    d0a1a.setAttribute('href', idel);
    d0a1a.setAttribute('style', "width: 5; height: 5;");
    d0a1a.setAttribute('class', "btn btn-success");
    d0a1a.setAttribute('title', "Delete this Item");
    d0a1a.innerHTML = "<span>&#45;</span>";
  d0a1.appendChild(d0a1a);
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
    o1.innerHTML = "Choose Category...";
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
  // item costing section
  var d4 = document.createElement('div');
    d4.setAttribute('class', "form-group row justify-content-between");
  div1.appendChild(d4);
  // itemprice section
  var d4a = document.createElement('div');
    d4a.setAttribute('class', "input-group col-3");
  d4.appendChild(d4a);
  var d4a1 = document.createElement('div');
    d4a1.setAttribute('class', "input-group-prepend");
  d4a.appendChild(d4a1);
  var d4a1s = document.createElement('span');
    d4a1s.setAttribute('class', "input-group-text");
    d4a1s.setAttribute('id', "price");
    d4a1s.innerHTML = "Item price:";
  d4a1.appendChild(d4a1s);
  var d4a1i = document.createElement('input');
    d4a1i.setAttribute('type', "text");
    d4a1i.setAttribute('class', "form-control");
    d4a1i.setAttribute('name', ipri);
    d4a1i.setAttribute('aria-describedby', "price");
  d4a.appendChild(d4a1i);
  // item postage
  var d4b = document.createElement('div');
    d4b.setAttribute('class', "input-group col-3");
  d4.appendChild(d4b);
  var d4b1 = document.createElement('div');
    d4b1.setAttribute('class', "input-group-prepend");
  d4b.appendChild(d4b1);
  var d4b1s = document.createElement('span');
    d4b1s.setAttribute('class', "input-group-text");
    d4b1s.setAttribute('id', "price");
    d4b1s.innerHTML = "Postage:";
  d4b1.appendChild(d4b1s);
  var d4b1i = document.createElement('input');
    d4b1i.setAttribute('type', "text");
    d4b1i.setAttribute('class', "form-control");
    d4b1i.setAttribute('name', ipos);
    d4b1i.setAttribute('aria-describedby', "postage");
  d4b.appendChild(d4b1i);
  // item additional costs
  var d4c = document.createElement('div');
    d4c.setAttribute('class', "input-group col-4");
  d4.appendChild(d4c);
  var d4c1 = document.createElement('div');
    d4c1.setAttribute('class', "input-group-prepend");
  d4c.appendChild(d4c1);
  var d4c1s = document.createElement('span');
    d4c1s.setAttribute('class', "input-group-text");
    d4c1s.setAttribute('id', "additionalFees");
    d4c1s.innerHTML = "Additional fees:";
  d4c1.appendChild(d4c1s);
  var d4c1i = document.createElement('input');
    d4c1i.setAttribute('type', "text");
    d4c1i.setAttribute('class', "form-control");
    d4c1i.setAttribute('name', icha);
    d4c1i.setAttribute('aria-describedby', "additionalFees");
  d4c.appendChild(d4c1i);
  // end test A
  // set console log output for testing
  console.log(ides);
  console.log(icat);
  itemCounter++;
}
function deleteItem(itemId){
  var eId = document.getElementById(itemId);
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
