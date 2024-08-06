var server = "http://localhost/fileupload_server";


var uploaded_files = [];

function onFileSelect(event){
    var files = event.target.files;
    console.log('files', files.length);
    uploadFiles(event.target.files);
}


function uploadFiles(files) {
    var formData = new FormData();

    for (var file of files) {
        if (file) {
            console.log('file', file);
            formData.append('files[]', file);
        }
    }

    
    var http = new XMLHttpRequest();

    http.onload = function() {
        try {
            var response = JSON.parse(http.responseText);
            console.log("response.success: " + response.success);
            var success = response.success;
            if (success) {
                window.location.href = "/dashbord.html";
            }
        } catch (e) {
            console.error("Error parsing response JSON:", e);
        }
    };

    http.onerror = function(err) {
        console.error('Error', err);
    };

    http.open('POST', server + '/index.php?function=upload_files', true);
    http.send(formData);
}


function fetchData() {
    var http = new XMLHttpRequest();

    http.onload = function(){
        // console.log(http.response)
        var response = JSON.parse(http.response);
        // console.log("response:" + response)
        var uploadedFiles = response.upload_files;
        console.log(uploadedFiles);
        loopData(uploadedFiles );
        window.location
    }

    http.open('GET', server+'/index.php?function=fetch-data');
    http.send();
}
fetchData();

function loopData(uploadedFiles){

    // if(uploadedFiles.length > 0){
        var container = document.getElementById('tbody');
    // console.log(projects);
    var tr = "";
    for(var i=0;i<uploadedFiles.length;i++){
        tr += `

      <tr class="table-row">
            <td class="text-center"><img src="${server+'/uploads/'+uploadedFiles[i].file_name}"  id="preview_image" alt="cool" /></td>

            <td class="text-center">${uploadedFiles[i].file_name}</td>

            <td class="text-center">${uploadedFiles[i].file_type}</td>

            <td class="text-center"><img  src="./asset/images/delete.svg" alt="" onClick="deleteData(${uploadedFiles[i].id})"></td>
        </tr>
        `;

    }
    if(container){
        container.innerHTML = tr;
    }}
    



//delete 
function deleteData(fileUpload_id){

    var confirmDelete = confirm('Are you sure you want to delete');

    if(confirmDelete){

        var http = new XMLHttpRequest();

        http.onload = function(){
            var response = JSON.parse(http.response);
            var server_response = response.success;
            fetchData();
            alert(server_response);
        }

        http.onerror = function(err){
            console.log(err);
        }

        http.open('GET', server+'/index.php?function=delete-data&fileUpload_id='+fileUpload_id);
        http.send();
    }else{
        //do nothing  else cancel the operation.
    }
    
}
