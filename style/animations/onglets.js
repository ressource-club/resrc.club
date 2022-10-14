function montrer_onglets(onglets, activation_onglets)
{
    activation_onglets.classList.add('actif');
    activation_onglets.querySelector('a>h1').style.transform = 'rotate(45deg)';
    onglets.classList.add('ouverts');
}

function masquer_onglets(onglets, activation_onglets)
{
    onglets.classList.remove('ouverts');
    activation_onglets.querySelector('a>h1').style.transform = 'none';
    activation_onglets.classList.remove('actif');
}

function activation_onglets()
{
    let onglets = document.querySelector(".resrc>header>menu#onglets-mobile");
    let activation = document.querySelector(".resrc>header>menu#activation-onglets-mobile>li#onglets");
    if (onglets.classList.contains('ouverts'))
    {
        masquer_onglets(onglets, activation);
    }
    else
    {
        montrer_onglets(onglets, activation);
    }
}