// Fonction pour mettre à jour les divs avec les visualisations
function updateVisualisations() {
    const allRelevesBrut = document.querySelectorAll('.brut');
    const allVisualisations = document.querySelectorAll('.visualisation');

    allRelevesBrut.forEach((element, index) => {
        console.log(`Contenu de l'élément ${index + 1} avec la classe .brut :`, element.textContent.trim());
    });

    allRelevesBrut.forEach((releveBrut, index) => {
        const visu = generateTableFromReleve(releveBrut.textContent.trim());
        const visualisationDiv = allVisualisations[index];

        console.log(visu)

        // Efface le contenu existant
        visualisationDiv.innerHTML = '';

        // Ajoute la nouvelle table générée
        const tableauVisu = document.createElement('table');

        for (const row of visu) {
            const tr = document.createElement('tr');

            for (const cell of row) {
                const td = document.createElement('td');
                td.style.width = '40px'
                td.style.height = '40px'
                const petitTableau = document.createElement('table');
                petitTableau.style.width = '100%'
                petitTableau.style.height = '100%'
                petitTableau.style.borderCollapse = 'collapse'

                const tbody = document.createElement('tbody');
                for (let y = 0; y < 3; y++) {
                    const trInner = document.createElement('tr');
                    for (let x = 0; x < 3; x++) {
                        const tdInner = document.createElement('td');
                        if (cell.includes(y * 3 + x)) {
                            tdInner.style.backgroundColor = 'green';
                        }
                        trInner.appendChild(tdInner);
                    }
                    tbody.appendChild(trInner);
                }

                petitTableau.appendChild(tbody);
                td.appendChild(petitTableau);
                tr.appendChild(td);
            }

            tableauVisu.appendChild(tr);
        }

        visualisationDiv.appendChild(tableauVisu);
    });
}

// Fonction pour générer un nombre aléatoire entre min et max
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Fonction de génération de la matrice à partir des relevés bruts
function generateTableFromReleve(releveBrut) {
    const matrix = [];
    const releveArray = releveBrut.split('/').map(x => parseInt(x, 10));

    for (let y = 0; y < 3; y++) {
        matrix[y] = [];
        for (let x = 0; x < 3; x++) {
            matrix[y][x] = [];

            for (let i = 0; i < releveArray[y * 3 + x]; i++) {
                let index = getRandomInt(0, 8);
                while (matrix[y][x].includes(index)) {
                    index = getRandomInt(0, 8);
                }

                matrix[y][x].push(index);
            }
        }
    }

    return matrix;
}

// Exemple d'utilisation
updateVisualisations();
