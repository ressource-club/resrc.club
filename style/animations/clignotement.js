setInterval(() => {
    document.querySelectorAll(".resrc .resrc-clignotement").forEach(e => {
        if (e.classList.contains('actif'))
        {
            e.classList.remove('actif');
        }
        else
        {
            e.classList.add('actif');
        }
    })
}, 420)