document.addEventListener('DOMContentLoaded', function () {

    // Sélectionner les éléments d'entrée de couleur
    const bgColorInput = document.getElementById('bgColor');
    const textColorInput = document.getElementById('textColor');
    // Sélectionner l'élément de div d'exemple
    const colorExample = document.getElementById('colorExample');

    // Fonction pour mettre à jour la couleur de fond et de texte de la div d'exemple
    function updateColorExample() {
        const bgColor = bgColorInput.value;
        const textColor = textColorInput.value;

        colorExample.style.backgroundColor = bgColor;
        colorExample.style.color = textColor;
    }

    // Écouter les événements de changement de valeur dans les inputs de couleur
    bgColorInput.addEventListener('input', updateColorExample);
    textColorInput.addEventListener('input', updateColorExample);

    // Appeler la fonction initiale pour afficher le rendu initial des couleurs
    updateColorExample();
});