if (window.XMLHttpRequest) {
    // code for modern browsers
    xmlhttp1 = new XMLHttpRequest();
   
} else {
   // code for old IE browsers
    xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
}

var url = "process_form.php";
var viewURL = "view_book.php?view=";
var myArr = new Array();
var pageMyArr = new Array();
var currentPage = 1;
const numberPerPage = 10;
var numberOfPages = 0;
var viewAllFrame = document.getElementById("viewAllFrame");
var addFrame = document.getElementById("addFrame");
var updateFrame = document.getElementById("updateFrame");
var updateCountry = document.getElementById("updateCountry");
var addState = document.getElementById("addState");
var updateState = document.getElementById("updateState");

var showAllToSend = "mode=showAll";
var viewPage;
var searchToSend;
var loadStatesToSend;
var deleteToSend;
var updateToSend;
var celebrity_id;


var addForm = document.getElementById('addCelebrity');  // Our HTML form's ID
var addFile = document.getElementById('addImage');  // Our HTML files' ID

var updateForm = document.getElementById('updateCelebrity');  // Our HTML form's ID
var updateFile = document.getElementById('updateImage');  // Our HTML files' ID

//var searchToSend = "mode=search&celeName=${searchName}";

// fetch json from database by server through Ajax,input:string for request(req),
function ajaxRequest(req,callback){
    if(xmlhttp1){
    fetch(url, {
      method: "POST",
      
      headers: { 'content-type': 'application/x-www-form-urlencoded' },
      
      body: req,
     
       }
     )
    .then(res => res==-1? displayMessage("No results found") : res.json())
    .then(data => myArr = data)
    .then(callback)
    .catch(error => console.warn('Something went wrong.', error)
    );
  }
  else if(xmlhttp2){
      xmlhttp2.onreadystatechange = function() {
          if (this.readyState == 4 && this.status ==  200) {
            if (this.responseText == -1){
                displayMessage("No results found");                
                return false;
            }else{
                myArr = JSON.parse(this.responseText);
                callback();
            }
          }
      };
      xmlhttp2.open("POST", url, true);
      //xmlhttp.setRequestHeader("Content-type", "multipart/form-data");
      xmlhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp2.send(req);
    }
};



//invoke viewAll/search event
function displayAllCele() {
  displayMessage("");
  closeDiv(addFrame);
  closeDiv(updateFrame);
  ajaxRequest(showAllToSend,displayViewAll);
  //alert(myArr);
  document.getElementById("searchByName").value = "";
  showDiv(viewAllFrame);  //display the viewAll&search div
};

 
 
//invoke viewAll/search event
function displayCele() {
  myArr = [];
  closeDiv(addFrame);
  closeDiv(updateFrame);
  closeDiv(viewAllFrame);
  document.getElementById("display").innerHTML = "";
  document.getElementById("message").innerHTML = "";
  let searchInput = document.getElementById("searchByName").value;
  let letters = /^[A-Za-z]+$/;
     
  if (searchInput == "") {
    displayMessage("Name must be filled out");
    document.getElementById("searchByName").value = "";     
    return false;
  }else if (letters.test(searchInput)) { 

    let searchToSend = "mode=search&celeName=" + searchInput;     
    ajaxRequest(searchToSend,displayViewAll);
   //display the viewAll&search div
    showDiv(viewAllFrame);
    document.getElementById("searchByName").value = ""; 
  }else{
    displayMessage("please enter char only");
    document.getElementById("searchByName").value = "";     
    return false;
  }
 
  
};


//display viewAll/search results
function displayViewAll() 
{
    if (myArr.length) {
        numberOfPages = getNumberOfPages();
        loadList();
    }else{
        displayMessage("No results found");       
        closeDiv(viewAllFrame);
        return false;
    }
  

};
//confirm the last page number
function getNumberOfPages() {
    return Math.ceil(myArr.length / numberPerPage);
};

//loading the display results(by paginator function)
function loadList() {
    var begin = ((currentPage - 1) * numberPerPage);
    var end = begin + numberPerPage;

    pageMyArr = myArr.slice(begin, end);
    drawList(pageMyArr);
    check();
};

//display the final results
function drawList(arr) {
    
    document.getElementById("display").innerHTML = "";
    var loginCheck = document.getElementById("loginTag");
    var table = "";
    if(document.body.contains(loginCheck)){
        for(let i = 0; i < arr.length; i++){
           table += "<table>";
                   table += "<tbody>";
                       table += "<tr>";
                           table += "<td class='td-img'>"
                               table += "<img class='thumbnail' src='profile_pics/" + arr[i].celebrity_picture + "' alt='Celebrity Picture' width='200' height='200'>";
                           table += "</td>";
                           table += "<td class='td-content'>";
                               table += "<div class='data-header'>";
                                    table += "<h4>" + arr[i].celebrity_first_name + " " + arr[i].celebrity_middle_name + " " + arr[i].celebrity_last_name + "<br><span class='occupation'>(" + arr[i].occupation + ")</span></h4>";
                               table += "</div>";
                               table += "<p class='lead'>";
                                   table += "<span class='content-head'> Contact Number: </span>"
                                            + arr[i].celebrity_mobile_number;
                                   table += "<br/>";
                                   table += "<span class='address'>";
                                       table += "<span class='content-head'> Address: </span>"
                                                + arr[i].celebrity_street_no + " " + arr[i].celebrity_street_name + ", <br/> " + arr[i].suburb + "  " + arr[i].state  + " <br/> " + arr[i].country;
                                   table += "</span><br/>";
                                   table += "<span class='email'>";
                                       table += "<span class='content-head'> Email: </span>"
                                                + arr[i].celebrity_email;
                                   table += "</span>";
                               table += "</p>";
                           table += "</td>";
                           table += "<td class='td-button' id='tdBtns'>";     
                           table += "<a onclick='openViewPage(`view_book.php?view=" + arr[i].celebrity_id + "`)' class='btn btn-warning view'>View</a>";
                           table += "<button type='button' class='btn btn-info update' name='updateCele' id='updateCele' onclick='displayUpdate(" +i + ")'>Update</button>";
                           table += "<button type='button' class='btn btn-danger delete' name='deleteCele' id='deleteCele' onclick='deleteCele(" + i + ")'>Delete</button>";
                           table += "</td>";
                       table += "</tr>";
                   table += "</tbody>";
               table += "</table><br><br>";
       }
    }else{
        for(let i = 0; i < arr.length; i++){
           table += "<table>";
                   table += "<tbody>";
                       table += "<tr>";
                           table += "<td class='td-img'>"
                               table += "<img class='thumbnail' src='profile_pics/" + arr[i].celebrity_picture + "' alt='Celebrity Picture' width='200' height='200'>";
                           table += "</td>";
                           table += "<td class='td-content'>";
                               table += "<div class='data-header'>";
                                    table += "<h4>" + arr[i].celebrity_first_name + " " + arr[i].celebrity_middle_name + " " + arr[i].celebrity_last_name + "<br><span class='occupation'>(" + arr[i].occupation + ")</span></h4>";
                               table += "</div>";
                               table += "<p class='lead'>";
                                   table += "<span class='content-head'> Contact Number: </span>"
                                            + arr[i].celebrity_mobile_number;
                                   table += "<br/>";
                                   table += "<span class='address'>";
                                       table += "<span class='content-head'> Address: </span>"
                                                + arr[i].celebrity_street_no + " " + arr[i].celebrity_street_name + ", <br/> " + arr[i].suburb + "  " + arr[i].state  + " <br/> " + arr[i].country;
                                   table += "</span><br/>";
                                   table += "<span class='email'>";
                                       table += "<span class='content-head'> Email: </span>"
                                                + arr[i].celebrity_email;
                                   table += "</span>";
                               table += "</p>";
                           table += "</td>";
                           table += "<td class='td-button' id='tdBtns'>";
                           table += "<a onclick='openViewPage(`view_book.php?view=" + arr[i].celebrity_id + "`)' class='btn btn-warning view'>View</a>";
                           table += "</td>";
                       table += "</tr>";
                   table += "</tbody>";
               table += "</table><br><br>";
       }
    }
    document.getElementById("display").innerHTML = table; 
     
};
 
//define the paginator bar's status
function check() {
    document.getElementById("next1").disabled = currentPage == numberOfPages ? true : false;
    document.getElementById("previous1").disabled = currentPage == 1 ? true : false;
    document.getElementById("first1").disabled = currentPage == 1 ? true : false;
    document.getElementById("last1").disabled = currentPage == numberOfPages ? true : false;
    document.getElementById("next2").disabled = currentPage == numberOfPages ? true : false;
    document.getElementById("previous2").disabled = currentPage == 1 ? true : false;
    document.getElementById("first2").disabled = currentPage == 1 ? true : false;
    document.getElementById("last2").disabled = currentPage == numberOfPages ? true : false;
};
 
//paginator bars control functions
function nextPage() {
    
    currentPage += 1;
    loadList();
}

function previousPage() {
    currentPage -= 1;
    loadList();
}

function firstPage() {
    currentPage = 1;
    loadList();
}

function lastPage() {
    currentPage = numberOfPages;
    loadList();
}
 

 
//display the viewAll&search div
function showDiv(showElement){
          showElement.style.display="block";
}

//close the viewAll&search div
function closeDiv(showElement){
          showElement.style.display="none";
}

function addLoadStates(selectedOption)
{

    var length = addState.options.length;
    if (length > 1) {
        // remove states options showed before as last onchange country in select box (addState)
        for (i = length-1; i > 0; i--) {
           
           addState.removeChild( addState.options[i] ); 
         }
   }; 
    myArr = [];
    let countryid = selectedOption.value; // get the selected class type
    //alert(countryid); 
    var loadStatesToSend = "mode=loadStates&CountryID=" + countryid;
    ajaxRequest(loadStatesToSend,addIterateState);
   
};
     
function addIterateState(){
    // get reference to select element
      
    for (var key in myArr) 
    {
        //if (data.hasOwnProperty(key))
        if(key in myArr) 
        {		
            // create new option element
            let opt = document.createElement('option');
            
            // create text node to add to option element (opt)
            opt.appendChild( document.createTextNode(myArr[key].state) );
            
            // set value property of opt
            opt.value = myArr[key].stateId; 
           
            // add opt to end of select box (addState)
            addState.appendChild(opt);              
        }
    }       
}; 

function displayAdd(){
   displayMessage("");
   closeDiv(viewAllFrame);
   closeDiv(updateFrame);
   showDiv(addFrame);
};

function closeAdd(){
    document.getElementById("addFirstName").value = "";
    document.getElementById("addMiddleName").value = "";
    document.getElementById("addLastName").value = ""; 
    document.getElementById("addStreetNumber").value = "";
    document.getElementById("addStreetName").value = "";
    document.getElementById("addMobile").value = "";
    document.getElementById("addEmail").value = "";    
    document.getElementById("addImage").value = "";
    closeDiv(addFrame);
    displayMessage("");    
};

addCelebrity.onsubmit = (e) => {
    e.preventDefault();
    // Get the files from the form input
    var files = addFile.files;
    // Create a FormData object
    var formData = new FormData(addCelebrity);
    // Select only the first file from the input array
    var file = files[0];
    var FileSize = file.size / 1024 / 1024; // in MB
    if (FileSize > 2) {
        alert('File size exceeds 2 MB'); // Check the file size
        return false;
    } else if (!file.type.match('image.*')) {
        alert('The file selected is not an image.'); // Check the file type
        return false;
    } else {
  
        // Open the connection
        xmlhttp1.open('POST', 'process_form.php', true);
       
        // Set up a handler for when the task for the request is complete
        xmlhttp1.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // this.responseText == -1 ? displayMessage("Problem in inserting this celebrity"):displayMessage("This celebrity has been added successfully");
                displayMessage(this.responseText);
               }
        };
        // Send the data.
    xmlhttp1.send(formData);
    }
    closeAdd(); 
    displayAllCele();
    
};

   
function displayMessage(mes){
    document.getElementById("message").innerHTML = mes;
};



function openViewPage(url) {
  viewPage = window.open(url, "_blank", "width=500, height=500", "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes");
}


function displayUpdate(i){
    
    let oldCeleID  = pageMyArr[i].celebrity_id;    
    let oldFirstName = pageMyArr[i].celebrity_first_name;
    let oldMiddleName = pageMyArr[i].celebrity_middle_name;
    let oldLastName = pageMyArr[i].celebrity_last_name;
    let oldStreetNumber = pageMyArr[i].celebrity_street_no;
    let oldStreetName = pageMyArr[i].celebrity_street_name;
    let oldMobile = pageMyArr[i].celebrity_mobile_number;
    let oldEmail = pageMyArr[i].celebrity_email;
    let oldOccupation = pageMyArr[i].occupation;
    let oldCountry = pageMyArr[i].country;
    let oldState = pageMyArr[i].state;
    let oldSuburb = pageMyArr[i].suburb;
    let arrImage = pageMyArr[i].celebrity_picture;
    let oldOccupationId = pageMyArr[i].occupationId; 
    let oldCountryId = pageMyArr[i].countryId;
    let oldStateId = pageMyArr[i].stateId;
    let oldPostcodeId = pageMyArr[i].postcodeId; 
    let imageSrc = "profile_pics/" + arrImage;   

    let updateFirstName = document.getElementById("updateFirstName"); 
    let updateMiddleName = document.getElementById("updateMiddleName"); 
    let updateLastName = document.getElementById("updateLastName");    
    let updateStreetNumber = document.getElementById("updateStreetNumber"); 
    let updateStreetName = document.getElementById("updateStreetName"); 
    let updateMobile = document.getElementById("updateMobile"); 
    let updateEmail = document.getElementById("updateEmail"); 
    let updateOccupation = document.getElementById("updateOccupation"); 
    let updateCountry = document.getElementById("updateCountry"); 
    let updateState = document.getElementById("updateState"); 
    let updateSuburb = document.getElementById("updateSuburb");
    let oldImage = document.getElementById("oldImage");

    displayMessage("");
    closeDiv(viewAllFrame);
    showDiv(updateFrame);
    
    document.getElementById("cele_id").value= oldCeleID; 
    document.getElementById("keyIndex").innerHTML = i; 
    

    updateFirstName.value = oldFirstName;
    updateMiddleName.value = oldMiddleName;
    updateLastName.value = oldLastName;
    updateOccupation.value = oldOccupationId;
    //updateOccupation.options[0].text = oldOccupation;
    updateCountry.value = oldCountryId;
    //updateCountry.options[0].text = oldCountry;

    updateState.options[0].text = oldState;
   // updateState.options[0].text = oldState;
    updateSuburb.value = oldPostcodeId;
    //updateSuburb.options[0].text = oldSuburb;
    updateStreetNumber.value = oldStreetNumber;
    updateStreetName.value = oldStreetName;
    updateMobile.value = oldMobile;
    updateEmail.value = oldEmail;

    document.getElementById("oldLink").value = imageSrc;
    oldImage.src = imageSrc;
    document.getElementById("imageName").innerHTML = arrImage; 

    //document.getElementById("suburb").option[0].value = "Select a suburb";



    //   updateCountry.addEventListener('change', function(event) {
    //     updateLoadStates(event.target.value);
    //   });

};


function updateLoadStates(selectedOption)
{
   
    var length = updateState.options.length;
    if (length > 1) {
        // remove states options showed before as last onchange country in select box (updateState)
        for (i = length-1; i > 0; i--) {
           
            updateState.removeChild( updateState.options[i] ); 
         }
   };    
   updateState.options[0].text="Select a state";    

    myArr = [];
    let countryid = selectedOption.value;
    //let countryid = document.getElementById("updateCountry").value; // get the selected class type
    //alert(countryid); 
    var loadStatesToSend = "mode=loadStates&CountryID=" + countryid;
    ajaxRequest(loadStatesToSend,updateIterateState);
   
};
     
function updateIterateState(){
    // get reference to select element
    
    for (var key in myArr) 
    {
        //if (data.hasOwnProperty(key))
        if(key in myArr) 
        {		
            // create new option element
            let opt = document.createElement('option');
            
            // create text node to add to option element (opt)
            opt.appendChild( document.createTextNode(myArr[key].state) );
            
            // set value property of opt
            opt.value = myArr[key].stateId; 
           
            // add opt to end of select box (updateState)
            updateState.appendChild(opt);              
        }
    }       
}; 





updateCelebrity.onsubmit = (e) => {
    e.preventDefault();

    // Get the celebrity's ID
    let cele_id = document.getElementById("cele_id").value;
    let i = document.getElementById("keyIndex").innerHTML;

    let oldFirstName = pageMyArr[i].celebrity_first_name;
    let oldMiddleName = pageMyArr[i].celebrity_middle_name;
    let oldLastName = pageMyArr[i].celebrity_last_name;
    let oldStreetNumber = pageMyArr[i].celebrity_street_no;
    let oldStreetName = pageMyArr[i].celebrity_street_name;
    let oldMobile = pageMyArr[i].celebrity_mobile_number;
    let oldEmail = pageMyArr[i].celebrity_email;
    let oldImage = pageMyArr[i].celebrity_picture;
    let oldOccupationId = pageMyArr[i].occupationId; 
    let oldCountryId = pageMyArr[i].countryId;
    let oldStateId = pageMyArr[i].stateId;
    let oldPostcodeId = pageMyArr[i].postcodeId; 

    let updateFirstName = document.getElementById("updateFirstName").value; 
    let updateMiddleName = document.getElementById("updateMiddleName").value; 
    let updateLastName = document.getElementById("updateLastName").value;    
    let updateStreetNumber = document.getElementById("updateStreetNumber").value; 
    let updateStreetName = document.getElementById("updateStreetName").value; 
    let updateMobile = document.getElementById("updateMobile").value; 
    let updateEmail = document.getElementById("updateEmail").value; 
    let updateOccupationId = document.getElementById("updateOccupation").value; 
    let updateCountryId = document.getElementById("updateCountry").value; 
    let updateStateId = document.getElementById("updateState").value; 
    let updateSuburbId = document.getElementById("updateSuburb").value;
    let updateImage = document.getElementById("updateImage").value;

    // Get the files from the form input
    var files = updateFile.files;
    // Create a FormData object
    var formData = new FormData(updateCelebrity);
    // Select only the first file from the input array
    var file = files[0];
    var FileSize = file.size / 1024 / 1024; // in MB
    if (FileSize > 2) {
        alert('File size exceeds 2 MB'); // Check the file size
        return false;
    } else if (!file.type.match('image.*')) {
        alert('The file selected is not an image.'); // Check the file type
        return false;
    } else 
    if (
        updateFirstName == oldFirstName &&
        updateMiddleName == oldMiddleName &&
        updateLastName == oldLastName &&
        updateOccupationId == oldOccupationId && 
        updateCountryId == oldCountryId && 
        updateStateId == oldStateId && 
        updateSuburbId == oldPostcodeId && 
        updateStreetNumber == oldStreetNumber && 
        updateStreetName == oldStreetName && 
        updateMobile == oldMobile && 
        updateEmail == oldEmail && 
        updateImage == oldImage     
    ) {
        alert("Please make some changes. If you've only changed the image, please change the file name.");
        return false;
    }else
    {  
        // Open the connection
        xmlhttp1.open('POST', 'process_form.php', true);
       
        // Set up a handler for when the task for the request is complete
        xmlhttp1.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // this.responseText == -1 ? displayMessage("Problem in inserting this celebrity"):displayMessage("This celebrity has been added successfully");
                alert(this.responseText);
               }
        };
        // Send the data.
    xmlhttp1.send(formData);
    }    
    // setTimeout((cele_id) => updateResult(cele_id), 3000);
    // setTimeout(() => alert('Hello'), 1000);
    setTimeout(updateResult, 3000, cele_id);
};

function updateResult(cele_id){
   
   closeUpdate();
   displayAllCele();
   openViewPage("view_book.php?view=" + cele_id);
 
   
};

function closeUpdate(){

    document.getElementById("updateFirstName").value = "";
    document.getElementById("updateMiddleName").value = "";
    document.getElementById("updateLastName").value = ""; 
    document.getElementById("updateStreetNumber").value = "";
    document.getElementById("updateStreetName").value = "";
    document.getElementById("updateMobile").value = "";
    document.getElementById("updateEmail").value = "";    
    document.getElementById("updateImage").value = "";
    displayMessage("");
    closeDiv(updateFrame);
    
};

function deleteCele(i) {
    
    var r = confirm("Are you sure you want to delete this?");
    let oldCeleID  = pageMyArr[i].celebrity_id; 
    let oldFN = pageMyArr[i].celebrity_first_name; 
    let oldMN = pageMyArr[i].celebrity_middle_name;
    let oldLN = pageMyArr[i].celebrity_last_name;
    
    let oldImage = pageMyArr[i].celebrity_picture;

    if (r == true) {
      
    let deleteToSend = "mode=delete&celebrityID=" + oldCeleID +"&celebrityPic=" + oldImage;  
    document.getElementById("display").innerHTML = "";
    let deletedName = oldFN + " "+oldMN+" " + oldLN;    
    
    if(xmlhttp1){
        fetch(url, {
          method: "POST",          
          headers: { 'content-type': 'application/x-www-form-urlencoded' },          
          body: deleteToSend,         
        })
        .then(res => res==-1? displayMessage("Deleting process fails!") : displayMessage("Delete successfully! The deleted celebrity is "+deletedName))        
        .catch(error => console.warn('Something went wrong.', error)
        );
    }else if(xmlhttp2){
          xmlhttp2.onreadystatechange = function() {
            if (this.readyState == 4 && this.status ==  200) {
                displayMessage(this.responseText);                
            }
          }
          xmlhttp2.open("POST", url, true);         
          xmlhttp2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xmlhttp2.send(deleteToSend);
    }  
    displayAllCele();
    } else {
      return false;
    }


}