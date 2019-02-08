window.onload = function() {
    function setRoute(button, route) {
        if(document.getElementById(button)!==null){
            document.getElementById(button).addEventListener('click', function(e) {
                document.getElementById('controllerAction').value = route;
                $('#formNav').submit();
            });
        }
    }
    
    document.getElementById("envMsg").addEventListener('click', postMsg);
    
    // routes
    setRoute('btnConnection', 'connection');
    setRoute('btnIndex', "index");
    setRoute('linkPanier', "panier");
    setRoute('btnlogout', "logout");
    setRoute('btnEnvRech', "recherche");
    setRoute('btnEnvoiePanier', "insertionPanier");
    setRoute('btnCompte', "compte");



    // ouvre et ferme l'espace chat
    var liveActive=false;
    document.getElementById("liveVendeur").addEventListener('click', afficheLive);
    function afficheLive(){
        liveActive=!liveActive;
        if(liveActive){
            document.getElementById("displayLive").style.display = "block";
        }else{
            document.getElementById("displayLive").style.display = "none";
        }
    }

    // ajax communication chat
    var httpRequest;
    var typeRequest='POST';
    var pageRequest="modele/requetesServer.php";
    var sendValue;
    var sendVarName;
    var sending;
    var responsePlace;
    var myInterval = setInterval(refreshMsg, 1000/100);

    function refreshMsg() { //rafraichir le chat toutes les 10ème de seconde
        sendValue="";
        sendVarName ='refresh';
        responsePlace =document.getElementById("exampleFormControlTextarea1");
                sending = sendVarName+'='+ encodeURIComponent(sendValue);
        makeRequest();
    }

    function postMsg() {
        sendValue=document.getElementById("exampleFormControlTextarea2").value;
        sendVarName ='postMsgLive';
        responsePlace ="";
                sending = sendVarName+'='+ encodeURIComponent(sendValue);
        makeRequest();

    }
    // event
    document.getElementById('linkInscription').addEventListener('click', function(e) {
        let hasError = false;
        hasError = setInput('lastName', 'errorLastName', hasError, 2);
        hasError = setInput('firstName', 'errorFirstName', hasError, 2);
        hasError = setInput('pseudo', 'errorPseudo', hasError, 4);
        hasError = setInput("email", "errorEmail", hasError, 8);
        hasError = setInput('pwd1', 'errorPwd1', hasError, 6);
        hasError = setInput('pwd2', 'errorPwd2', hasError, 6);
        let pwd1 = document.getElementById("pwd1").value;
        let pwd2 = document.getElementById("pwd2").value;
        hasError = compareMdp(pwd1, pwd2, hasError);

        if(hasError) {
            e.preventDefault();
        } else {
            $('#controllerAction').val("inscription");
            $('#formNav').submit();
        }
    });

    // Fermer la modal connexion par le lien s'inscrire (afin de recharger une modal pour s'inscrire)
    document.getElementById('btnInscription').addEventListener('click', function(e) {
        $('#connectionModal').modal('hide'); //hide pous masquer la modal connexion
        initInscriptionModal();
    });

    // A l'ouverture de l'inscription les messages d'erreurs sont cachés
    function initInscriptionModal() {
        document.getElementById('errorLastName').style.display = "none";
        document.getElementById('errorFirstName').style.display = "none";
        document.getElementById('errorPseudo').style.display = "none";
        document.getElementById('errorEmail').style.display = "none";
        document.getElementById('errorPwd1').style.display = "none";
        document.getElementById('errorPwd2').style.display = "none";
    }

    // Affiche les messages d'erreurs
    function setInput(inputName, msgErrorName, hasError, minLenght) {
        let input = document.getElementById(inputName);
        let msgError = document.getElementById(msgErrorName);

        if(input.value.length <=  minLenght) {
            hasError = true;
            msgError.style.display = "block";
        } else {
            msgError.style.display = "none";
        }
        return hasError;
    }

    // comparer les mots de passe à l'inscription
    function compareMdp(pwd1, pwd2, hasError) {
        let msgError = document.getElementById("errorPwd2");
        if (pwd1 !== pwd2 || (pwd1 === "" && pwd2 === "")) {
            hasError = true;
            msgError.style.display = "block";
        } else {
            msgError.style.display = "none";
        }
        return hasError;
    }

    // 
    function makeRequest() {
        httpRequest = new XMLHttpRequest();
        if (!httpRequest) {
            alert('Giving up :déçu: Cannot create an XMLHTTP instance');
            return false;
        }
        httpRequest.onreadystatechange = alertContents;
        httpRequest.open(typeRequest, pageRequest);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send(sending);
    }

    // 
    function alertContents() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                responsePlace.innerHTML =httpRequest.responseText;
            } else {
                alert('There was a problem with the request.');
            }
        }
    }
    document.getElementById("btnCompte").addEventListener("mouseover", mouseOver);
    document.getElementById("btnCompte").addEventListener("mouseout", mouseOut);
    function mouseOver() {
        document.getElementById("logoMonCompte").style.display = "block";
      }
      
      function mouseOut() {
        document.getElementById("logoMonCompte").style.display = "none";
      }
}

