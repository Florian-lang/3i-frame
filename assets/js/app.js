document.addEventListener('DOMContentLoaded', function () {
    function openClose(elementId) {
        let element = document.getElementById(elementId);

        // Si l'élément est actuellement caché, l'ouvrir
        if (element.style.display === 'none' || element.style.display === '') {
            element.style.display = 'block';
        } else {
            element.style.display = 'none'; // Sinon, fermer l'élément
        }
    }


    document.getElementById('button-dropdown-profile').onclick = () => {
        openClose('dropdown-profile')
    }
})();