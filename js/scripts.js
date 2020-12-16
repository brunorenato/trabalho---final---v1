function validarForm() {
    var produto = document.forms["meuForm"]["txtProduto"].value;
    var preco = document.forms["meuForm"]["txtPreco"].value;
    if (produto == "" || preco == "") {
        alert("Os campos PRODUTO e PREÇO devem ser preenchidos");
        return false;
    }
} 

$(document).ready(function(){
    $("input").focus(function(){
        $(this).css("background-color", "orange");
    });
    $("input").blur(function(){
        $(this).css("background-color", "yellow");
    });
});

$(document).ready(function(){
  $("p").ready(function(){
    $("#trocar").hide();
  });
  $(".btn1").click(function(){
    $("#trocar").toggle();
  });
});

