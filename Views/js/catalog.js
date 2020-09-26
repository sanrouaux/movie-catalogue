checkokLogin();

window.onload = function() {   
    loadUserName();
    document.getElementsByClassName('logout')[0].addEventListener('click',logout);
    
    if(profile == 'administrador') {
        hideUserButtons();
        addFuncionalityToAdminButtons();
    } 
    else {
        hideAdminButtons();
        addFuncionalityToUserButtons();
    }
};


function checkokLogin() {
    firstName = this.localStorage.getItem('firstName');
    lastName = this.localStorage.getItem('lastName');
    profile = this.localStorage.getItem('profile');
    if(profile == null) {
        window.location.href="./";
    } 
}


function loadUserName() {
    message = firstName;
    if(profile == 'administrador') {
        message += '<br>(administrador)';
    }
    this.document.getElementById('username').innerHTML = message;    
}



function addFuncionalityToAdminButtons() {

    document.addEventListener('click', function (event) {

        if (event.target.matches('.delete-button')) {
            var htmlElement = event.target;
            var className = htmlElement.className;
            var filmId = className.split(" ")[1].split("-")[2];

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./deletefilm");
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            if (confirm('¿Estás seguro? \n (Este cambio no podrá ser deshecho).')) {
                xhr.send('id=' + filmId);
            } 
            xhr.onreadystatechange = function () {
                if(xhr.status == 200 && xhr.readyState == 4)
                {
                    response = JSON.parse(xhr.response);        
                    if(response.delete)
                    {         
                        window.location.href="./catalog";
                    }
                    else
                    {
                        alert("Error. No se pudo eliminar la película");
                    } 
                }
            }
        }

        else if (event.target.matches('.add-film')) {    
            
            hideAddValidationMessages();
            document.getElementById('add-poster-preview').src = './images/empty-image.png';

            var modal = document.getElementById("addFilmModal");
            var span = document.getElementsByClassName("close")[0];
            var body = document.getElementsByTagName("body")[0];            
            var input = document.getElementsByClassName("add-input-poster")[0];
            var preview = document.getElementById('add-poster-preview');    

            modal.style.display = "block";
            body.style.position = "static";
            body.style.height = "100%";
            body.style.overflow = "hidden";           

            span.onclick = function() {
                modal.style.display = "none";
                body.style.position = "inherit";
                body.style.height = "auto";
                body.style.overflow = "visible";
            }

            input.onchange = function(){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();            
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                    }            
                    reader.readAsDataURL(input.files[0]);
                }
            };
        }

        else if (event.target.matches('.accept-add-film-button')) {
            var name = document.getElementsByClassName('add-input-name')[0].value;
            var director = document.getElementsByClassName('add-input-director')[0].value;
            var year = document.getElementsByClassName('add-input-year')[0].value;
            var photo = null;
            if(photo = document.getElementsByClassName('add-input-poster')[0].files[0]) {
                var photoName = (document.getElementsByClassName('add-input-poster')[0].value).split("\\")[2];
                var photoExtension = photoName.split(".")[1];
            }

            if(addValidation(name, director, year, photo)) {
                var formData = new FormData();
                formData.append("name", name);
                formData.append("director", director);
                formData.append("year", year);
                formData.append("photoExtension", photoExtension);
                formData.append("photo", photo);
                
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "./addfilm");
                xhr.setRequestHeader("enctype", "multipart/form-data");
                xhr.send(formData);
                xhr.onreadystatechange = function () {
                    if(xhr.status == 200 && xhr.readyState == 4)
                    {
                        var response = JSON.parse(xhr.response);
                        if(response.exito) {
                            window.location.href="./catalog";
                        }
                        else {
                            alert('No se pudo agregar la película. \n' + response.mensaje);
                        }
                    }
                }
            }            
        }

        else if (event.target.matches('.edit-button')) {

            hideEditValidationMessages();

            var htmlElement = event.target;
            var className = htmlElement.className;
            var filmId = className.split(" ")[1].split("-")[2];
            localStorage.setItem("edit-id-film", filmId);

            var preview = document.getElementById('edit-poster-preview');
            var input = document.getElementsByClassName("edit-input-poster")[0];
            input.onchange = function(){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();            
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                    }            
                    reader.readAsDataURL(input.files[0]);
                }
            };

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./retrievefilm");
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send('id=' + filmId);
            xhr.onreadystatechange = function () {
                if(xhr.status == 200 && xhr.readyState == 4)
                {
                    response = JSON.parse(xhr.response);        
                    if(response.success)
                    {                   
                        var modal = document.getElementById("editFilmModal");     
                        var body = document.getElementsByTagName("body")[0];
                        var close = document.getElementsByClassName("close")[1];                        

                        modal.style.display = "block";
                        body.style.position = "static";
                        body.style.height = "100%";
                        body.style.overflow = "hidden";

                        close.onclick = function() {
                            modal.style.display = "none";
                            body.style.position = "inherit";
                            body.style.height = "auto";
                            body.style.overflow = "visible";
                        }

                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                                body.style.position = "inherit";
                                body.style.height = "auto";
                                body.style.overflow = "visible";
                            }
                        }

                        document.getElementsByClassName('edit-input-name')[0].value = response.film.name;
                        document.getElementsByClassName('edit-input-director')[0].value = response.film.director;
                        document.getElementsByClassName('edit-input-year')[0].value = response.film.year;
                        document.getElementById('edit-poster-preview').src = './images/posters/' + response.film.image;
                    }
                    else
                    {
                        alert("Error. No se encontró la película");
                    } 
                }
            }
        }

        else if (event.target.matches('.accept-edit-film-button')) {
            var id = localStorage.getItem('edit-id-film');
            var name = document.getElementsByClassName('edit-input-name')[0].value;
            var director = document.getElementsByClassName('edit-input-director')[0].value;
            var year = document.getElementsByClassName('edit-input-year')[0].value;
            
            var photo = null;
            if(photo = document.getElementsByClassName('edit-input-poster')[0].files[0]) {
                var photoName = (document.getElementsByClassName('edit-input-poster')[0].value).split("\\")[2];
                var photoExtension = photoName.split(".")[1];
            }

            if(editValidation(name, director, year)) {
                var formData = new FormData();
                formData.append("id", id);
                formData.append("name", name);
                formData.append("director", director);
                formData.append("year", year);
                if(photo) {
                    formData.append("photoExtension", photoExtension);
                    formData.append("photo", photo);
                }                                
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "./editfilm");
                xhr.setRequestHeader("enctype", "multipart/form-data");
                xhr.send(formData);
                xhr.onreadystatechange = function () {
                    if(xhr.status == 200 && xhr.readyState == 4)
                    {
                        var response = JSON.parse(xhr.response);
                        if(response.exito) {
                            window.location.href="./catalog";
                        }
                        else {
                            alert('No se pudo editar la película. \n Intentelo de nuevo');
                        }
                    }
                }
            } 
        }
    }, false);
}

function addFuncionalityToUserButtons() {
    document.addEventListener('click', function (event) {
        if (event.target.matches('.recommend-film')) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', './recommendfilm');
            xhr.send();
            xhr.onreadystatechange = function() {
                if(xhr.readyState == 4) {
                    if(xhr.status == 200) {
                        let response = JSON.parse(xhr.response);
                        console.log(response);
                        alert('Te recomendamos ' + response.name);
                    }
                    else {
                        alert('Hubo un error en el servidor');
                    }
                }                
            }
        }
    }, false);
}

function logout() {
    localStorage.removeItem('firstName');
    localStorage.removeItem('lastName');
    localStorage.removeItem('profile');
    window.location.href= './';
}


function hideAdminButtons() {
    buttonCollection = document.getElementsByClassName('admin-only');
    for(i = 0; i < buttonCollection.length; i++) {
        buttonCollection[i].style.display = 'none';
    }
}

function hideUserButtons() {
    buttonCollection = document.getElementsByClassName('user-only');
    for(i = 0; i < buttonCollection.length; i++) {
        buttonCollection[i].style.display = 'none';
    }
}

function addValidation(name, director, year, photo) {
    
    if(name != "") {
        var nameOk = true;
        document.getElementsByClassName('add-validation-name')[0].hidden = true;
    }
    else {
        document.getElementsByClassName('add-validation-name')[0].hidden = false;
    }
    if(director != "") {
        var directorOk = true;
        document.getElementsByClassName('add-validation-director')[0].hidden = true;
    }
    else {
        document.getElementsByClassName('add-validation-director')[0].hidden = false;
    }
    if(year == "" || isNaN(year)) {
        document.getElementsByClassName('add-validation-year')[0].hidden = false;        
    }
    else {
        var yearOk = true;
        document.getElementsByClassName('add-validation-year')[0].hidden = true;  
    }
    if(photo != null) {
        var photoOk = true;
        document.getElementsByClassName('add-validation-photo')[0].hidden = true;
    }
    else {
        document.getElementsByClassName('add-validation-photo')[0].hidden = false;
    }
    if(nameOk && directorOk && yearOk && photoOk) {
        return true;
    }
    else {
        return false;
    }
}

function editValidation(name, director, year) {
    
    if(name != "") {
        var nameOk = true;
        document.getElementsByClassName('edit-validation-name')[0].hidden = true;
    }
    else {
        document.getElementsByClassName('edit-validation-name')[0].hidden = false;
    }
    if(director != "") {
        var directorOk = true;
        document.getElementsByClassName('edit-validation-director')[0].hidden = true;
    }
    else {
        document.getElementsByClassName('edit-validation-director')[0].hidden = false;
    }
    if(year == "" || isNaN(year)) {
        document.getElementsByClassName('edit-validation-year')[0].hidden = false;        
    }
    else {
        var yearOk = true;
        document.getElementsByClassName('edit-validation-year')[0].hidden = true;  
    }
    if(nameOk && directorOk && yearOk) {
        return true;
    }
    else {
        return false;
    }
}


function hideAddValidationMessages() {
    document.getElementsByClassName('add-validation-name')[0].hidden = true;
    document.getElementsByClassName('add-validation-director')[0].hidden = true;
    document.getElementsByClassName('add-validation-year')[0].hidden = true;
    document.getElementsByClassName('add-validation-photo')[0].hidden = true;
}

function hideEditValidationMessages() {
    document.getElementsByClassName('edit-validation-name')[0].hidden = true;
    document.getElementsByClassName('edit-validation-director')[0].hidden = true;
    document.getElementsByClassName('edit-validation-year')[0].hidden = true;
}

