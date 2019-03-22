document.getElementById("itemprice1").addEventListener("focusout", highlightPost);
document.getElementById("itempostage1").addEventListener("focusout", highlightPost);
document.getElementById("itemaddionalcharges1").addEventListener("focusout", highlightPost);
/*
function highlightPrice() NO LONGER NEEDED - DANNY
{
    var price = document.getElementById("itemprice1").value;//Captures that.
    var balance = document.getElementById("balance1").getAttribute("value"); //Does not capture that
    var post = document.getElementById("itempostage1").getvalue; //from a recent test
    
    console.log(balance); 
    console.log(price);
    
    if(price > balance)
        {
            document.getElementById("itemprice1").style.backgroundColor = "red";
            document.getElementById("itempostage1").style.backgroundColor = "red";
        }
    if(balance >= price)
        {
            document.getElementById("itemprice1").style.backgroundColor = "white";
            document.getElementById("itempostage1").style.backgroundColor = "white";
        }
}*/

function highlightPost()
{
    
    var price = document.getElementById("itemprice1").value; //capture the item price value
    var postage = document.getElementById("itempostage1").value; //captures the item postage value
    var addFee = document.getElementById("itemaddionalcharges1").value;
    var total = Number(price) + Number(postage) + Number(addFee);
    var balance = document.getElementById("balance1").getAttribute("value"); //captures the available balance
    
    console.log(balance); //console shows 500
    console.log(price); //console outputs the right value
    console.log(postage); //console outputs the right value 
    console.log(total); //testing and works
        
    if(balance >= total)
        {
            document.getElementById("itempostage1").style.backgroundColor = "white";
            document.getElementById("itemprice1").style.backgroundColor = "white";
            document.getElementById("itemaddionalcharges1").style.backgroundColor = "white";
        }
        
    if(total > balance)
        {
            document.getElementById("itempostage1").style.backgroundColor = "red";
            document.getElementById("itemprice1").style.backgroundColor = "red";
            document.getElementById("itemaddionalcharges1").style.backgroundColor = "red";
        }
}
/*
function highlightAdd() NO LONGER NEEDED - DANNY
{
    var count = 1; //testing
    
    var price = document.getElementById("itemprice1").value; //capture the item price value
    var postage = document.getElementById("itempostage1").value; //captures the item postage value
    var addFee = document.getElementById("itemaddionalcharges1").value;
    var total = Number(price) + Number(postage) + Number(addFee);
    var balance = document.getElementById("balance1").getAttribute("value"); //captures the available balance
    
    console.log(balance); 
    console.log(price); 
    console.log(postage);  
    console.log(addFee);
    console.log(total); 
        
    if(balance >= total)
        {
            document.getElementById("itempostage1").style.backgroundColor = "white";
            document.getElementById("itemprice1").style.backgroundColor = "white";
            document.getElementById("itemaddionalcharges1").style.backgroundColor = "white";
        }
        
    if(total > balance)
        {
            document.getElementById("itempostage1").style.backgroundColor = "red";
            document.getElementById("itemprice1").style.backgroundColor = "red";
            document.getElementById("itemaddionalcharges1").style.backgroundColor = "red";
        }
}*/

