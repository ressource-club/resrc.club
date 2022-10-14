function montrer_fenetres(fenetres, masque)
{
    masque.classList.add('actif');
    fenetres.classList.add('ouvertes');
}

function masquer_fenetres(fenetres, masque)
{
    fenetres.classList.remove('ouvertes');
    masque.classList.remove('actif');
}

function fermer_fenetre_ouverte()
{
    let fenetreOuverte = document.querySelector(".resrc>footer>#fenetres>section.ouverte");
    if (fenetreOuverte === null)
    {
        console.debug("Aucune fenêtre ouverte.");
    }
    else 
    {
        activation_activateur(fenetreOuverte.id.replace('fenetre-', ''));
        fenetreOuverte.classList.remove('ouverte');
    }
    return fenetreOuverte;
}

// ACTIVATIONS

function activation_activateur(id)
{
    let activateur = document.querySelector(".resrc>footer>nav#menus #" + id);
    if (activateur === null)
    {
        console.debug("Activateur cible inexistant (" + id + ").");
        return;
    }

    if (activateur.classList.contains('actif'))
    {
        activateur.classList.remove('actif');
    }
    else
    {
        activateur.classList.add('actif');
    }
}

function activation_fenetre(id)
{
    let fenetres = document.querySelector(".resrc>footer>#fenetres");
    let masque = document.querySelector(".resrc>footer>canvas#masque");
    id_fenetre = "fenetre-" + id;
    let fenetre = document.querySelector(".resrc>footer>#fenetres>section#" + id_fenetre);
    if (fenetre === null)
    {
        console.debug("Fenêtre cible inexistante (" + id_fenetre + ").");
        return;
    }

    if (fenetres.classList.contains('ouvertes'))
    {
        let fenetreOuverte = fermer_fenetre_ouverte();
        if (!!fenetreOuverte && fenetreOuverte.id === id_fenetre)
        {
            masquer_fenetres(fenetres, masque);
            return;
        }
    }
    else
    {
        montrer_fenetres(fenetres, masque);  
    }
    activation_activateur(id);
    fenetre.classList.add('ouverte');
}

function activation_masque()
{
    let fenetres = document.querySelector(".resrc>footer>#fenetres");
    let masque = document.querySelector(".resrc>footer>canvas#masque");
    fermer_fenetre_ouverte();
    masquer_fenetres(fenetres, masque); 
}