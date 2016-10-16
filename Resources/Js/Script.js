

$(document).ready(function() {
    //script menu
    $("li ul").hide();// Esconda os menus filhos de "li"
    $("li").hover(function() {// quando passar o mouse em cima da "li"
        $(this).find("ul:first").stop(true, true).slideToggle();// procure nesta li a primeira ul, se um evento estiver disparado ele para(.stop()) e alterne o slider.
    });

    //script mascara
    $("#mac").mask("**-**-**-**-**-**");
    $(".data").mask("99/99/9999");
    $('.celular').mask('(99)9999-9999');

//script calendario
    $(".data").datepicker({
        dateFormat: 'dd/mm/yy',
        showOn: "button",
        buttonImage: "../Resources/Img/calendario.png",
        buttonImageOnly: true,
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true,
        showOtherMonths: true,
        selectOtherMonths: true,
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado', 'Domingo'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez']

    });

    //mensagem de informação
    $.fn.mensagemBox = function(titulo, mensagem) {
        return $.msgBox({
            title: titulo,
            content: mensagem,
            type: "info",
            showButtons: false,
            opacity: 0.9,
            autoClose: true,
            timeOut: 1500
        });
    };
    //mensagem de alerta
    $.fn.mensagemBoxAlert = function(titulo, mensagem) {
        return $.msgBox({
            title: titulo,
            content: mensagem,
            type: "alert",
            showButtons: false,
            opacity: 0.9,
            autoClose: true,
            timeOut: 1500
        });
    };
    // função para atualizar a pagina
    $.fn.Reload_Pagina = function() {
        return setTimeout(function() {
            location.reload();
        }, 1500);
    };
//    // script tabela
//    $(".Tabela").dataTable();

    //script fotos
//    Shadowbox.init({
//        language: "pt",
//        player: ["img", "html", "swf"]
//    });

//        function checa_seguranca(pass, senha1){ 
//		var senha = document.getElementById(pass).value; 
//		var entrada = 0; 
//		var resultado; 
//		
//		if(senha.length < 7){ 
//				entrada = entrada - 1; 
//		} 
//		
//		if(!senha.match(/[a-z_]/i) || !senha.match(/[0-9]/)){ 
//				entrada = entrada - 1; 
//		} 
//		
//		if(!senha.match(/\W/)){ 
//				entrada = entrada - 1; 
//		} 
//		
//		if(entrada === 0){ 
//				resultado = 'A Segurança de sua senha é: <font color=\'#99C55D\'>EXCELENTE</font>'; 
//		} else if(entrada === -1){ 
//				resultado = 'A Segurança de sua senha é: <font color=\'#7F7FFF\'>BOM</font>'; 
//		} else if(entrada === -2){ 
//				resultado = 'A Segurança de sua senha é: <font color=\'#FF5F55\'>BAIXA</font>'; 
//		} else if(entrada === -3){ 
//				resultado = 'A Segurança de sua senha é: <font color=\'#A04040\'>MUITO BAIXA</font>'; 
//		} 
//		
//		document.getElementById(senha1).innerHTML = resultado; 
//		
//		return; 
//}
});