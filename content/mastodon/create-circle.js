/*
Dies ist eine erste Implementierung, da ist noch vieeeel zu tun :)
*/

let ownProfilePic;
let userInfo;
let connection_list = {};
let requestCounter = 1;

// The main function called by the button-click
function circle_main() {
    // Make Button invisible to prevent clicking
    document.getElementById("btn_create").style.display = "none";
    // Get handle from Textfield
    let mastodon_handle = document.getElementById("txt_mastodon_handle").value;
    userInfo = formatedUserHandle(mastodon_handle);
    getStatuses();
    //setTimeout(showConnections,3000);
}

// Format the Mastodon Handle to an array: [username, userID, instance.tld]
function formatedUserHandle(mastodon_handle) {
    // Remove leading @
    if (mastodon_handle.charAt(0) === '@') mastodon_handle = mastodon_handle.substr(1);
    // Split handle into name and 
    mastodon_handle = mastodon_handle.split("@");
    // Return the array
    return [mastodon_handle[0], getIdFromName(mastodon_handle[0], mastodon_handle[1]), mastodon_handle[1]];
}

// Get the user ID from the handle
function getIdFromName(name, server) {
    var xmlHttp = new XMLHttpRequest();
    let url = "https://"+server+"/api/v1/accounts/lookup?acct="+name;
    xmlHttp.open( "GET", url, false ); // false for synchronous request
    xmlHttp.send( null );
    let response = JSON.parse(xmlHttp.responseText);
    ownProfilePic = response["avatar"];
    return response["id"];
}

// Get a JSON String with all the posted statuses from the account and call processStatuses()
async function getStatuses() {
    // Build the URL
    let url = "https://"+userInfo[2]+"/api/v1/accounts/"+userInfo[1]+"/statuses";
    // Do the async http request and call processStatuses()
    httpRequest(url, processStatuses);
}

// Process the JSON String into an array
function processStatuses(statuses) {
    jsonStat = JSON.parse(statuses);

    let request_limit = 30;

    for (var i=0; i<jsonStat.length; i++) {
        if (!jsonStat[i]["reblog"]) {
            evaluateStatus(jsonStat[i]["id"], (jsonStat[i]["favourites_count"]>0), (jsonStat[i]["reblogs_count"]>0));
            request_limit--;
            if (request_limit<0) break;
        }
    }
}

// Get all Reblogs and Favs for a status update
function evaluateStatus(id, faved, rebloged) {
    requestCounter += faved+rebloged+1;
    // Build the URL
    let url1 = "https://"+userInfo[2]+"/api/v1/statuses/"+id+"/reblogged_by";
    // Do the async http request
    if (rebloged) httpRequest(url1, evalStatusInteractions, 1.3);

    // Build the URL
    let url2 = "https://"+userInfo[2]+"/api/v1/statuses/"+id+"/context";
    // Do the async http request
    httpRequest(url2, evalReplies, 1.1);

    // Build the URL
    let url3 = "https://"+userInfo[2]+"/api/v1/statuses/"+id+"/favourited_by";
    // Do the async http request
    if (faved) httpRequest(url3, evalStatusInteractions, 1.0);
}

// Evaluate the direct replies to tweets (no trees yet :( )
function evalReplies(jsonString, plus) {
    let jsonArray = JSON.parse(jsonString)["descendants"];

    for (var i=0; i<jsonArray.length; i++) {
        incConnectionValue(jsonArray[i]["account"], plus);
    }

    if (requestCounter<=0) showConnections();
}

// Evaluate the Favs and Reposts
function evalStatusInteractions(jsonString, plus) {
    let jsonArray = JSON.parse(jsonString);
    
    for (var i=0; i<jsonArray.length; i++) {
        incConnectionValue(jsonArray[i], plus);
    }

    if (requestCounter<=0) showConnections();
}


// increment the relationship value by the integer "plus" (3 for reblogs, 1 for likes)
function incConnectionValue(conJSON, plus) {
    let id = conJSON["id"];
    // Test if a connection was already discovered
    if (!(id in connection_list)) {
        // NO? call addNewConnection and create the connection!
        addNewConnection(conJSON)
    }
    // Increment the connection strength
    connection_list[id]["conStrength"] = connection_list[id]["conStrength"] + plus;
}

// Create a new node in the connection_list dictionary
function addNewConnection(jsonArray) {
    connection_list[jsonArray["id"]] = {};
    connection_list[jsonArray["id"]]["conStrength"] = 0;
    connection_list[jsonArray["id"]]["acct"] = jsonArray["acct"];
    connection_list[jsonArray["id"]]["pic"] = jsonArray["avatar"];
    connection_list[jsonArray["id"]]["name"] = jsonArray["display_name"]
    connection_list[jsonArray["id"]]["bot"] = jsonArray["bot"];
}



function showConnections() {
    // Remove own User from Dict
    if (userInfo[1] in connection_list) delete connection_list[userInfo[1]];

    // Sort dict into Array items
    var items = Object.keys(connection_list).map(
        (key) => { return [key, connection_list[key]] });
    items.sort(
        (first, second) => { return second[1]["conStrength"] - first[1]["conStrength"] }
    );
    
    // Render the Objects
    render(items);
}

function createUserObj(usr) {
    let usrElement = document.createElement("div");
    usrElement.innerHTML = "<img src=\""+usr["pic"]+"\" width=\"20px\">&nbsp;&nbsp;&nbsp;<b>"+usr["name"]+"</b>&nbsp;&nbsp;"+usr["acct"];
    document.getElementById("outDiv").appendChild(usrElement);
}


// Function for the http request
function httpRequest(url, callback, callbackVal=null)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4) {
            requestCounter--;
            if (xmlHttp.status == 200) {
                callback(xmlHttp.responseText, callbackVal);
            } else
                callback("[]", callbackVal);
        }
    }
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}