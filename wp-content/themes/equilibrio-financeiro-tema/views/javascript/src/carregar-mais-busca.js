jQuery(function(){
    jQuery("#carregar-mais").click(function() {
        let quantidade = jQuery(".artigo").length;
        let criterio   = jQuery(this).data("criterio");

        jQuery.ajax({
            url: "/wp-admin/admin-ajax.php",
            type: "GET",
            data: {
                action: "carregar_mais_busca",
                de: quantidade,
                s: criterio
            },
            success: function(data) {
                if (data.length == 0) {
                    jQuery("#carregar-mais").before("<p id='sem-itens'>Não há mais itens a serem carregados.</p>").prop("disabled", true);
                    return;
                }

                let html = "";

                data.forEach(destaque => {
                    html += `
                        <li class="artigo">
                            <a href="${destaque.url}">
                                <img src="${destaque.imagem}" alt="${destaque.titulo}. ${destaque.creditoDaImagem}" title="${destaque.titulo}. ${destaque.creditoDaImagem}">
                            </a>
                            <div>
                                <a href="${destaque.url}">
                                    <h2>${destaque.titulo}</h2>
                                    <p>${destaque.resumo}</p>
                                    <span>${destaque.dataDePublicacao}</span>
                                </a>
                            </div>
                        </li>
                    `;
                });

                jQuery(".artigos").append(html);
            }
        });
    });
});