// bloquer la touche entrer
$(document).ready(function() {

    $("form").bind("keypress", function(e) {
        if (e.keyCode == 13) {
            return false;
        }
    });
});

// si tout est charger
window.onload = function() {
    
    $("#logoAjoutPanier").fadeOut( 3000 );
    // fonction route
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
    setRoute('btnPaie', "paiement");
    setRoute('btnValidComm', "paiementF");
    setRoute('btnModifProfil', "modifProfil");
    setRoute('oubliMdpValid', 'renvoieMdp')

    // ouvre et ferme l'espace chat
    var liveActive=false;
    document.getElementById("liveVendeur").addEventListener('click', afficheLive);
    document.getElementById("fermeChat").addEventListener('click', afficheLive);

    function afficheLive(){
        liveActive=!liveActive;
        if(liveActive){
            document.getElementById("displayLive").style.display = "block";
        }else{
            document.getElementById("displayLive").style.display = "none";
        }
    }

    // ajax communication
    var httpRequest;
    var typeRequest='POST';
    var pageRequest="modele/requetesServer.php";
    var sendValue;
    var sendVarName;
    var sending;
    var responsePlace;
    var myInterval = setInterval(refreshMsg, 1000/100);

    // fonction ajax pour rafraichir les images
    function refreshImg() { 
        sendValue=document.getElementById("mesCouleur").value;
        sendVarName ='changeImage';
        responsePlace =document.getElementById("imageChange");
        sending = sendVarName+'='+ encodeURIComponent(sendValue);
        makeRequest();
    }
    
    //fonction ajax rafraichir le chat toutes les 10ème de seconde
    function refreshMsg() { 
        sendValue="";
        sendVarName ='refresh';
        responsePlace =document.getElementById("exampleFormControlTextarea1");
        sending = sendVarName+'='+ encodeURIComponent(sendValue);
        makeRequest();
    }

    // fonction ajax pour poster les messages 
    function postMsg() {
        sendValue=document.getElementById("exampleFormControlTextarea2").value;
        sendVarName ='postMsgLive';
        responsePlace ="";
        sending = sendVarName+'='+ encodeURIComponent(sendValue);
        makeRequest();
        document.getElementById("exampleFormControlTextarea2").value='';
    }

    // verification des erreurs a l'inscription
    document.getElementById('linkInscription').addEventListener('click', function(e) {
        let hasError = false;
        hasError = setInput('lastName', 'errorLastName', hasError, 1);
        hasError = setInput('firstName', 'errorFirstName', hasError, 1);
        hasError = setInput('pseudo', 'errorPseudo', hasError, 3);
        hasError = setInput("email", "errorEmail", hasError, 7);
        hasError = setInput('pwd1', 'errorPwd1', hasError, 5);
        hasError = setInput('pwd2', 'errorPwd2', hasError, 5);
        let pwd1 = document.getElementById("pwd1").value;
        let pwd2 = document.getElementById("pwd2").value;
        hasError = compareMdp(pwd1, pwd2, hasError);
		//hasError = test_adresse_email(document.getElementById("email").value);

        if(hasError) {
            e.preventDefault();
        } else {
            $('#controllerAction').val("inscription");
            $('#formNav').submit();
        }
    });

    // Fermer la modal connexion par le bouton-lien s'inscrire (afin de recharger une modal pour s'inscrire)
    document.getElementById('btnInscription').addEventListener('click', function(e) {
        $('#connectionModal').modal('hide'); //hide pous masquer la modal connexion
        initInscriptionModal();
    });

    // Fermer la modal connexion par le bouton-lien oubli mot de passe (afin de recharger une modal pour renvoyer mdp)
    document.getElementById('btnOubliMdp').addEventListener('click', function(e) {
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

    // requete ajax (fonction necessaire pour les fonctions)
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

    // alert ajax
    function alertContents() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                responsePlace.innerHTML =httpRequest.responseText;
            } else {
                alert('There was a problem with the request.');
            }
        }
    }

    //recuperer l'etat de la souris
    document.getElementById("btnCompte").addEventListener("mouseover", mouseOver);
    document.getElementById("btnCompte").addEventListener("mouseout", mouseOut);
    
    // si souris sur le bouton mon compte 
    function mouseOver() {
        document.getElementById("logoMonCompte").style.display = "block";
    }
    // si souris pas sur le bouton mon compte
    function mouseOut() {
        document.getElementById("logoMonCompte").style.display = "none";
    }



}


// Regex (bug)verifie le format email lors de l'inscription et lors d'un changement sur la page mon compte
function test_adresse_email(email)
{
    var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
    if(reg.test(email))
    {
        document.getElementById('errorEmail').style.display = "none";
        return(true);
    }
    else
    {
        document.getElementById('errorEmail').style.display = "block";
        return(false);
    }
}

