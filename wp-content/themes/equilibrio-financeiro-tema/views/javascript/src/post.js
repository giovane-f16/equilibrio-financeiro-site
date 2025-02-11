jQuery(function(){
    jQuery("#copiar_link").click(function(e) {
        e.preventDefault();
        var url = window.location.href;
        copiarLink(url);
        mostrarNotificacao("Copiado");
    });

    function copiarLink (url) {
        var tempInput = jQuery("<input>");
        jQuery("body").append(tempInput);
        tempInput.val(url).select();
        document.execCommand("copy");
        tempInput.remove();
    }

    function mostrarNotificacao(message) {
        var notificacao = jQuery("<div>").addClass("notificacao").text(message);
        jQuery("#compartilhe ul li:first-of-type").append(notificacao);

        setTimeout(function() {
            notificacao.remove();
        }, 1000);
    }
});