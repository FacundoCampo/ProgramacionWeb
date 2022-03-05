function validateEmail(email) 
    {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

function validarSoloLetras(valor) 
    {
        var re = /^[A-Z ]+$/i;
        return re.test(valor);
    }

    function validarNumeroDecimal(valor) 
    {
        var re = /^\d+\.\d{0,2}$/;
        return re.test(valor);
    }

    function validarNumeroEntero(valor) 
    {
        var re = /^[0-9]+$/;
        return re.test(valor);
    }

    function validarNumTarjet(valor){
        var re = /^[0-9]{15}$/;
        return re.test(valor);
    }