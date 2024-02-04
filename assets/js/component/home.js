document.addEventListener('DOMContentLoaded', function () {
    function openClose(elementId) {
        let element = document.getElementById(elementId);

        if (element.style.display === 'none' || element.style.display === '') {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    }


    document.getElementById('button-dropdown-profile').onclick = () => {
        openClose('dropdown-profile')
    }
});
