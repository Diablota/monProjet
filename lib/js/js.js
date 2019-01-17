window.onload = function() {
    function setRoute($button, $route) {
        if(document.getElementById($button)!==null){
            document.getElementById($button).addEventListener('click', function(e) {
                $('#controllerAction').val($route);
                $('#formNav').submit();
            });
        }
    }

    //events
    setRoute('linkIndex', "index");
    setRoute('linkPanier', "panier");
    setRoute('navPantalons', "Pantalons");
    setRoute('navRobes', "Robes");
    setRoute('navTeeshirt', "Tee-shirt");
    setRoute('navBoutons', "Boutons");
    setRoute('navCeintures', "Ceintures");
    setRoute('navBijoux', "Bijoux");
    setRoute('navAutres', "Autres");

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

    // fermer la modal connexion par le lien s'inscrire (afin de recharger une modal pour s'inscrire)
    document.getElementById('btnInscription').addEventListener('click', function(e) {
        $('#connectionModal').modal('hide');
        initInscriptionModal();
    });


    function initInscriptionModal() {
        document.getElementById('errorLastName').style.display = "none";
        document.getElementById('errorFirstName').style.display = "none";
        document.getElementById('errorPseudo').style.display = "none";
        document.getElementById('errorEmail').style.display = "none";
        document.getElementById('errorPwd1').style.display = "none";
        document.getElementById('errorPwd2').style.display = "none";
    }

    // affiche les messages d'erreurs
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

    //comparer les mots de passe
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



}
