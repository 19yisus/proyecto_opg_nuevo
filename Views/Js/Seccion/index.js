$(document).ready( () => {
  $("#Formulario").validate({
    rules: {
      anio:{
        required: true,
        number: true,
        minlength: 1,
        maxlength: 1,
      },
      seccion:{
        required: true,
        minlength: 1,
        maxlength: 1,
      }
    },
    messages: {
      anio: {
        required: "Este campo es requerido!",
        minlength: "Minimo 1 caracter numerico!",
        maxlength: "Maximo 1 caracter numerico!",
        number: "Solo se aceptan caracteres numericos!",
      },
      seccion: {
        required: "Este campo es requerido",
        minlength: "Minimo 1 caracter",
        maxlength: "Maximo 1 caracter",
      }
    },
    errorElement: "span",
    errorPlacement: function (error, element){
        error.addClass("invalid-feedback");
        element.closest(".form-group").append(error);
    },
    highlight: function (element, errorClass, validClass){
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass){
        $(element).removeClass('is-invalid');
    }
  });
});