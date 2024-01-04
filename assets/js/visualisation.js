const allRelevesBrut = document.querySelectorAll('.brut');
const allVisualisations = document.querySelectorAll('.visualisation');

window.addEventListener('DOMContentLoaded', () => {

    for (elem in allRelevesBrut) {

        // On commence par récupérer les données brutes
        let releveBrut = allRelevesBrut[elem].innerHTML;

        // On les transforme en tableau
        let releveBrutArray = releveBrut.split('/');

        console.log(releveBrutArray);

        // On récupère les données de la visualisation
        let visualisation = allVisualisations[elem];



    }

});