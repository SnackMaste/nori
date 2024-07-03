$(document).ready(function() {
    function formatCountry (country) {
        if (!country.id) { return country.text; }
        var $country = $(
            '<span><img src="' + $(country.element).data('image') + '" class="img-flag" /> ' + country.text + '</span>'
        );
        return $country;
    };

    $("#countryCode").select2({
        templateResult: formatCountry,
        templateSelection: formatCountry,
        minimumResultsForSearch: Infinity
    });
});
/**FUNCIONALIDAD DEL OJITO DE LA CONTRASEÑA */
document.getElementById('toggle-password1').addEventListener('click', function() {
    var passwordField = document.getElementById('ContraseñaR');
    var passwordFieldType = passwordField.getAttribute('type');

    if (passwordFieldType == 'password') {
        passwordField.setAttribute('type', 'text');
    } else {
        passwordField.setAttribute('type', 'password');
    }
});
document.getElementById('toggle-password2').addEventListener('click', function() {
    var passwordField = document.getElementById('ConfirContraseñaR');
    var passwordFieldType = passwordField.getAttribute('type');

    if (passwordFieldType == 'password') {
        passwordField.setAttribute('type', 'text');
    } else {
        passwordField.setAttribute('type', 'password');
    }
});



